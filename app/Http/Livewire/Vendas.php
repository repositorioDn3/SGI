<?php

namespace App\Http\Livewire;

use App\Models\Contas;
use App\Models\Detalhes_Vendas;
use App\Models\Empresa;
use App\Models\Imovel;
use App\Models\Pessoa;
use App\Models\Venda;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use Barryvdh\DomPDF\Facade\Pdf;
use Dompdf\Dompdf;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Vendas extends Component
{

    use WithFileUploads;
    use WithPagination;

    public
    $selecionar_cliente,
    $total,
    $cart_id,
    $search,
    $divida_id,
    $selecionar_imovel,
    $divida,
    $cliente,
    $tipo_pagamento = 'TPA',
    $imovel,
    $banco_associado,
    $preco = 0,
    $taxa = 0,
    $quantidade = 1,
    $prazo_entrega = '',
    $id_venda,
    $desconto = 0,
    $estoque = 0,
    $pagar_por  = 'valor por parcela',
    $tipo_fatura;

    //Validacoes
    protected $rules = [
        'cliente'=>'required',
        'tipo_pagamento'=>'required',
        'banco_associado'=>'required',
        'imovel'=>'required',
        'quantidade'=>'required',
        'desconto'=>'numeric',
    ];
    //Validacao a tempo real
    public function updated($field){
        $this->validateOnly($field,$this->rules);
    }
    //verificar valor a ser pago
    public function informacoes_do_produto_selecionado(){

            if($this->pagar_por === 'valor por parcela'){
                $imovel = Imovel::find($this->imovel);

                if($imovel){

                    $this->preco = $imovel->preco_inicial;
                    $this->estoque = $imovel->quantidade;
                    $this->quantidade = 1;
                }else{
                    $this->preco = 0;
                    $this->estoque = 0;
                    $this->quantidade = 1;
                }

            }elseif($this->pagar_por === 'valor total'){
                $imovel = Imovel::find($this->imovel);
                if($imovel){
                $this->preco = $imovel->preco_total;
                $this->estoque = $imovel->quantidade;
                $this->quantidade = 1;
                }else{
                    $this->preco = 0;
                    $this->estoque = 0;
                    $this->quantidade = 1;
                }
            }


    }

    // Limpar campos depois de adicionar imovel no carrinho
    public function resetData(){
        $this->quantidade = 0;
        $this->desconto = 0;
        $this->preco = 0;
    }
    // Limpar campos depois de adicionar imovel no carrinho
    public function resetAllInputes(){
        $this->imovel = '';
        $this->estoque = 0;
        $this->preco = 0;
        $this->quantidade = 0;
        $this->desconto = 0;
        $this->cliente = '';
    }

    //adicionar imovel no carrinho de compras
    public function adicionar_imovel_no_carrinho(){
         $this->validate($this->rules);
            // Buscar produtos por id
        $imovel = Imovel::find($this->imovel);

        if($imovel){
            if(empty($this->desconto)){
                $this->desconto = 0;
            }
            if(empty($this->quantidade)){
                $this->quantidade = 1;
            }
            if($imovel->quantidade < $this->quantidade){
                $this->dispatchBrowserEvent('error',[
                    'message'=>'Quantidade desejada superior ao estoque'
                ]);
            }else{
                    //Verificar regime de iva
                    $empresa = Empresa::find(1);
                    if($empresa->regime === 'Geral'){

                        $this->taxa = ($this->preco * 14) / 100;
                        $this->preco = $this->preco +  $this->taxa;

                    }elseif($empresa->regime === 'Simplificado'){

                        $this->taxa = ($this->preco * 7) / 100;
                        $this->preco = $this->preco + $this->taxa;

                    }

                     Cart::add(array(
                     'id'=>$imovel->id,
                     'name'=>$imovel->categorias->nome,
                     'price'=>($this->preco - $this->desconto),
                     'quantity'=>$this->quantidade,
                     'attributes' => array(
                         'desconto'=>$this->desconto,
                         'iva'=>$this->taxa
                     )
                 ));

                 //Limpar campos
                 $this->resetData();
            }

        }

    }

    // Ver produtos adicionados no carrinho
    public function cart(){
        $data = Cart::getContent();
        $this->total  = Cart::getTotal();
        return  $data;
    }
    //confirmar remocao de imovel no carrinho
    public function confirm($id){
        $this->cart_id = $id;
        $this->id_venda = $id;
        $this->dispatchBrowserEvent('confirm');
    }
    // Ver produtos adicionados no carrinho
    public function delete(){
        $data = Cart::remove($this->cart_id);
        if($data){
            $this->dispatchBrowserEvent('success',[
                'message'=>'Imóvel removido'
            ]);

        }else{

            $this->dispatchBrowserEvent('error',[
                'message'=>'Falha ao remover Imóvel'
            ]);
        }
    }

    //Finalizar venda
    public function faturar($tipo_fatura){
        try {
            $cart = Cart::getContent();
            if(isset($cart) && count($cart) > 0){

                $imovel_vendido  = Cart::get($this->imovel);

                $venda = new Venda(); //Instaciar a classe venda

                $venda->imovel = $imovel_vendido->name;
                $venda->total = $this->total;
                $venda->banco = $this->banco_associado;
                $venda->id_pessoa = $this->cliente;
                $venda->tipo_pagamento = $this->tipo_pagamento;
                $venda->user_id = auth()->user()->id;// Pegar o utilizador que esta a vender
                $venda->save();//salvar venda

                if($venda){

                    foreach(Cart::getContent() as $item){
                        $imovel_vendido = Imovel::find($item->id);

                        //Verificar como o cliente quer pagar / Parcela ou valor completo
                        if($this->pagar_por === 'valor por parcela'){
                            $this->divida = $imovel_vendido->preco_final;
                            $this->prazo_entrega = now()->addDays(30);
                        }else{
                            $this->divida = 0;
                            $this->prazo_entrega = null;
                        }
                        //Verificar como o cliente quer pagar / Parcela ou valor completo

                        //Diminuir quantidade em estoque depois de finalizar a venda

                            $imovel_vendido->quantidade = ($imovel_vendido->quantidade -  $item->quantity);
                            $imovel_vendido->save();

                        //Diminuir quantidade em estoque depois de finalizar a venda

                        $detalhes = new Detalhes_Vendas();
                        $detalhes->preco = $item->price;
                        $detalhes->quantidade = $item->quantity;
                        $detalhes->subtotal = ($item->price * $item->quantity);
                        $detalhes->desconto = $item->attributes['desconto'];
                        $detalhes->divida = $this->divida ;
                        $detalhes->prazo_entrega = $this->prazo_entrega ;
                        $detalhes->taxa = $this->taxa;
                        $detalhes->id_imovel = $item->id;
                        $detalhes->id_venda = $venda->id;
                        $detalhes->taxa =$item->attributes['iva'];
                        $detalhes->save();

                    }


                }

            }
            if( $detalhes){

                if($tipo_fatura === 'ticket'){
                    //Buscar venda realizada
                    $data = DB::table('vendas as v')->join('detalhes_vendas as dv','v.id','=','dv.id_venda')
                    ->select('v.id','v.imovel','v.total','v.banco','v.tipo_pagamento','v.id_pessoa','dv.preco','dv.quantidade','dv.taxa','dv.subtotal','dv.desconto')
                    ->where('v.id','=',$venda->id)->get();
                    //buscar cliente comprador
                    $cliente = Pessoa::find($this->cliente);
                    $bancos = Contas::get();
                    $empresa = Empresa::find(1);
                    $pdfContent = new Dompdf();
                    $pdfContent = PDF::loadView('invoices.ticket',[
                        'data'=>$data,
                        'cliente'=>$cliente,
                        'contas'=>$bancos,
                        'empresa'=>$empresa
                    ])->setPaper(array(0, 0, 323.15, 900.21), 'portrait')->output();

                    Cart::Clear();
                    $this->total = 0;
                    $this->resetAllInputes();

                    return response()->streamDownload(
                        fn () => print($pdfContent),
                        "fatura_recibo.pdf"
                    );




            }elseif($tipo_fatura === 'a4'){

                $data = DB::table('vendas as v')->join('detalhes_vendas as dv','v.id','=','dv.id_venda')
                ->select('v.id','v.imovel','v.total','v.banco','v.tipo_pagamento','v.id_pessoa','dv.taxa','dv.preco','dv.quantidade','dv.subtotal','dv.desconto')
                ->where('v.id','=',$venda->id)->get();

                    //buscar cliente comprador
                    $cliente = Pessoa::find($this->cliente);
                    $bancos = Contas::get();
                    $empresa = Empresa::find(1);
                    $pdfContent = PDF::loadView('invoices.a4',[
                    'data'=>$data,
                    'cliente'=>$cliente,
                    'contas'=>$bancos,
                    'empresa'=>$empresa
                    ])->output();

                        Cart::Clear();
                        $this->total = 0;
                        $this->resetAllInputes();
                    return response()->streamDownload(
                        fn () => print($pdfContent),
                        "fatura_a4.pdf"
                    );


            }else{


                DB::update('update detalhes_vendas set tipo_fatura = ? where id_venda = ?',
                ['FP',$venda->id]); // Informar o tipo de fatura gerada


                $data = DB::table('vendas as v')->join('detalhes_vendas as dv','v.id','=','dv.id_venda')
                ->select('v.id','v.imovel','v.total','v.banco','v.tipo_pagamento','v.id_pessoa','dv.taxa','dv.preco','dv.quantidade','dv.subtotal','dv.desconto')
                ->where('v.id','=',$venda->id)->get();
                //buscar cliente comprador
                $cliente = Pessoa::find($this->cliente);
                $bancos = Contas::get();
                $empresa = Empresa::find(1);
                    $pdfContent = PDF::loadView('invoices.proforma',[
                        'data'=>$data,
                        'cliente'=>$cliente,
                        'contas'=>$bancos,
                        'empresa'=>$empresa
                    ])->output();

                    Cart::Clear();
                    $this->total = 0;
                    $this->resetAllInputes();
                    return response()->streamDownload(
                        fn () => print($pdfContent),
                        "fatura_proforma.pdf"
                    );
            }
        }
        } catch (\Exception $ex) {
             $this->dispatchBrowserEvent('error',[
                 'message'=>'Falha no servidor: '.$ex->getMessage()
             ]);
            dd($ex->getMessage());
        }


    }



    //selecionar cliente para venda
    public function showCliente($selecionar_cliente = null){

        if(isset($selecionar_cliente)){
            $cliente_selecionado = Pessoa::where('nome','like','%'.$selecionar_cliente.'%')
                                ->where('esta_desponivel','=','sim')
                                ->get();
            return $cliente_selecionado;
        }else{

            $cliente_selecionado = Pessoa::where('esta_desponivel','=','sim')->get();
            return $cliente_selecionado;
        }
    }
    //selecionar cliente para venda
    public function showImovel($selecionar_imovel =null){

        if(isset($selecionar_imovel)){
            $imovel_selecionado = Pessoa::where('nome','like','%'.$selecionar_imovel.'%')->get();
            return $imovel_selecionado;
        }else{
            $imovel_selecionado = Imovel::get();
            return $imovel_selecionado;
        }
    }

    //metodo para listar as vendas
    public function showVendas($search = null){
        if(isset($search)){
            $vendas = Venda::where('imovel','like','%'.$search.'%')
                            ->where('anular','=','nao')->paginate(10);
            return $vendas;
        }else{

            $vendas = Venda::where('anular','=','nao')->paginate(10);
            return $vendas;
        }
    }

    //anular venda
    public function anular(){
        $anular_venda  = Venda::find($this->id_venda);

        if($anular_venda){
            $anular_venda->anular = 'sim';
            $anular_venda->save();

            $this->dispatchBrowserEvent('success',[
                'message'=>'Venda anulada com sucesso'
            ]);
            $this->dispatchBrowserEvent('close-modal');
        }
    }
    //anular venda
    public function detalhes($id){

        $this->id_venda = $id;
        if(isset($id)){
            $detalhes = Detalhes_Vendas::where('id_venda','=',$id)->get();
            return $detalhes;
        }
    }

    //Encontrar divida
    public function encontrar($id){
        $this->divida_id = $id;
    }
    //Pagar divida
    public function liquidar_divida(){
        try {

            //Encontrar venda e detalhes da venda
            $detalhe = Detalhes_Vendas::find($this->divida_id);
            $venda = Venda::find($detalhe->id_venda);

            if($venda){

                $venda->total += $detalhe->divida;
                $is_true =  $venda->save();

                if($is_true){

                    $detalhe->divida -= $detalhe->divida;
                    $detalhe->save();

                    $this->dispatchBrowserEvent('success',[
                        'message'=>'Divida liquidada com successo.'
                    ]);

                }else{

                    $this->dispatchBrowserEvent('error',[
                        'message'=>'Falha ao liquidar divida'
                    ]);
                    
                }
            }



        } catch (\Exception $ex) {
            dd($ex->getMessage());
            $this->dispatchBrowserEvent('error',[
                'message'=>'Falha no servidor : '.$ex->getMessage()
            ]);
        }
    }
    public function render()
    {
        return view('livewire.vendas',[
          'clientes'=>$this->showCliente($this->selecionar_cliente),
          'imoveis'=>$this->showImovel($this->selecionar_imovel),
          'vendas'=>$this->showVendas($this->search),
          'carts'=>$this->cart(),
          'detalhes'=>$this->detalhes($this->id_venda),
          'contas_bancaris'=>Contas::get(),
        ])->layout('modules.admin.app');
    }
}
