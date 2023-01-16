<?php

namespace App\Http\Livewire;

use App\Models\Categoria;
use App\Models\Galeria;
use App\Models\Imovel;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;


use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Imoveis extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $search,
           $quantidade,
           $descricao,
           $categoria,
           $preco_inicial,
           $preco_final,
           $preco_total,
           $area_total,
           $area_construida,
           $id_imovel,
           $addfoto;
    //Metodo para limpar os campos
    public function resetInputs(){
        $this->quantidade = '';
        $this->search = '';
        $this->descricao = '';
        $this->categoria = '';
        $this->addfoto = '';
        $this->preco_inicial = '';
        $this->preco_final = '';
        $this->area_total = '';
        $this->area_construida = '';
    }
    //Validacao dos campos
    protected $rules = [
        'categoria'=>'required',
        'quantidade'=>'required|numeric',
        'preco_inicial'=>'required|numeric',
        'preco_final'=>'required|numeric',
        'preco_total'=>'required|numeric',
        'area_total'=>'required',
        'area_construida'=>'required',
    ];
    //Validacao dos campos
    protected $messages = [
        'categoria.required'=>'Campo obrigatório',
        'quantidade.required'=>'Campo obrigatório',
        'preco_inicial.required'=>'Campo obrigatório',
        'preco_final.required'=>'Campo obrigatório',
        'preco_total.required'=>'Campo obrigatório',

        'preco_inicial.numeric'=>'Valor inválido',
        'preco_final.numeric'=>'Valor inválido',
        'preco_total.numeric'=>'Valor inválido',

        'area_total.required'=>'Campo obrigatório',
        'area_construida.required'=>'Campo obrigatório',
    ];
    //Validacao a tempo real
    public function updated($field){
        $this->validateOnly($field,$this->rules);
    }
    //Metodo para salvar dados
    public function save(){
        try{
            $this->validate($this->rules);

            $imovel = Imovel::create([
                'categoria'=> $this->categoria,
                'quantidade'=> $this->quantidade,
                'descricao'=> $this->descricao,
                'preco_inicial'=> $this->preco_inicial,
                'preco_final'=> $this->preco_final,
                'preco_total'=> $this->preco_total,
                'area_total'=> $this->area_total,
                'area_construida'=> $this->area_construida,
            ]);

           
             if($imovel){
                 $this->dispatchBrowserEvent('success',[
                     'message'=>'Imóvel adicionado com sucesso.'
                 ]);
                 $this->resetInputs();
             }else{
                 $this->dispatchBrowserEvent('error',[
                     'message'=>'Falha ao adicionar imóvel.'
                 ]);
             
             }

        }catch(Exception $ex){

             $this->dispatchBrowserEvent('serverError',[
                 'message'=>'Falha no servidor: '.$ex->getMessage()
             ]);
        }
    }
    //Metodo para excluir dados / Para visualizacao
    public function delete($id){
      
        try {
            $imovelDeleted = Imovel::find($id);
            $imovelDeleted->esta_desponivel = 'nao';
            $imovelDeleted->save();
            
            if($imovelDeleted){
                $this->dispatchBrowserEvent('success',[
                    'message'=>'Imóvel excluido com sucesso.'
                ]);
            $this->resetInputs();
            }else{
                $this->dispatchBrowserEvent('error',[
                    'message'=>'Falha ao excluir imóvel.'
                ]);
            
            }
            $this->resetInputs();

        } catch (\Exception $ex) {
            $this->dispatchBrowserEvent('serverError',[
                'message'=>'Falha no servidor: '.$ex->getMessage()
            ]);
        }
    }

    
    //Metodo para mostrar os dados 
    public function show($search = null){
        if(isset($search)){
            $allImovel = DB::table('imoveis')->join('categorias','imoveis.categoria','=','categorias.id')
            ->select('imoveis.id','imoveis.descricao','imoveis.preco_inicial','imoveis.area_total','imoveis.area_construida','imoveis.preco_final','imoveis.preco_total','imoveis.quantidade','categorias.nome as categoria')
            ->where('categorias.nome','like','%'.$search.'%')
            ->where('imoveis.esta_desponivel','<>','nao')->paginate(5);
            return $allImovel;
        }else{
           $allImovel = DB::table('imoveis')->join('categorias','imoveis.categoria','=','categorias.id')
           ->select('imoveis.id','imoveis.descricao','imoveis.preco_inicial','imoveis.area_total','imoveis.area_construida','imoveis.preco_final','imoveis.preco_total','imoveis.quantidade','categorias.nome as categoria')
           ->where('imoveis.esta_desponivel','<>','nao')->paginate(5);

            return $allImovel;
            
        }
    }

    //Metodo para editar dados do imovel
    public function edit($id){
        $imovel = Imovel::find($id);

        $this->quantidade = $imovel->quantidade;
        $this->descricao  = $imovel->descricao;
        $this->categoria  = $imovel->categoria;
        $this->preco_inicial = $imovel->preco_inicial;
        $this->preco_final = $imovel->preco_final;
        $this->preco_total = $imovel->preco_total;
        $this->area_total  = $imovel->area_total;
        $this->area_construida = $imovel->area_construida;
        $this->id_imovel = $imovel->id;

       
    }
    //Metodo para actualizar dados do imovel
    public  function update()
    {
        try{
            $this->validate($this->rules);

            $imovelUpdated = Imovel::find($this->id_imovel)->update([
                'categoria'=> $this->categoria,
                'quantidade'=> $this->quantidade,
                'descricao'=> $this->descricao,
                'preco_inicial'=> $this->preco_inicial,
                'preco_final'=> $this->preco_final,
                'preco_total'=> $this->preco_total,
                'area_total'=> $this->area_total,
                'area_construida'=> $this->area_construida,
            ]);

             if($imovelUpdated){
                 $this->dispatchBrowserEvent('success',[
                     'message'=>'Imóvel actualizado com sucesso.'
                 ]);
                 $this->dispatchBrowserEvent('close-modal');
             
             }else{
                 $this->dispatchBrowserEvent('error',[
                     'message'=>'Falha ao actualizar imóvel.'
                 ]);
             
             }

             $this->resetInputs();
        }catch(Exception $ex){

             $this->dispatchBrowserEvent('serverError',[
                 'message'=>'Falha no servidor: '.$ex->getMessage()
             ]);
        }
    }
    
    //Metodo para mostrar as fotos do imoveis
    public function galeria($imovel){
        $this->id_imovel = $imovel;
        $fotos = Galeria::where('imovel','=',$imovel)->get();
        return $fotos;
    }
    //metodo para excluir foto da galeria de um imovel especifico
    public function excluirFoto($id){
        try{

            $fotoDeleted = Galeria::destroy($id);
            if($fotoDeleted){
                $this->dispatchBrowserEvent('success',[
                    'message'=>'Imagen excluida com sucesso'
                ]);
                $this->resetInputs();

            }

        }catch(Exception $ex){
            $this->dispatchBrowserEvent('error',[
                'message'=>'Falha ao excluir imóvel.'
            ]);
        }
    }
    //metodo para adicionar foto na galeria de um imovel especifico
    public function adicionarFotoNaGaleria(){
        try{

            $this->validate([
                'addfoto'=>'required'
            ],[
                'addfoto.required'=>'Nenhuma Imagem selecionada ou ficheiro selecionado é invalido (selecione apenas imagens)'
            ]);
           
            foreach($this->addfoto as $imagem){
                $extensao = $imagem->getclientOriginalExtension();
                $naoPermitidas = array('pdf','docx','pptx','txt');
                if(!array_key_exists($extensao,$naoPermitidas)){

                    $nome_imagems = md5($imagem->getclientOriginalName()).'.'.
                    $extensao;
                    $imagem->storeAs('/public/imagens/',$nome_imagems);
    
                    $fotoAdded = Galeria::create([
                        'imagem'=>$nome_imagems,
                        'imovel'=>$this->id_imovel,
                    ]);
                }
            }
            if($fotoAdded){
                $this->dispatchBrowserEvent('success',[
                    'message'=>'Imagen adicionada com sucesso'
                ]);
                $this->resetInputs();

            }else{
                $this->dispatchBrowserEvent('error',[
                    'message'=>'Falha ao adicionar imagem'
                ]);
            }
        }catch(Exception $ex){
            $this->dispatchBrowserEvent('error',[
                'message'=>$ex->getMessage()
            ]);
        }
    }
    //Metod principal do compponente que renderiza a view
    public function render()
    {
        return view('livewire.imoveis',[
            'imoveis'=>$this->show($this->search),
            'categorias'=>Categoria::get(),
            'fotos'=>$this->galeria($this->id_imovel),
        ])->layout('modules.admin.app');
    }
}
