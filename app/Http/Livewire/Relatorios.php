<?php

namespace App\Http\Livewire;

use App\Models\Empresa;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Barryvdh\DomPDF\Facade\Pdf;
use Dompdf\Dompdf;

class Relatorios extends Component
{
    public $dt_inicio,$utilizador,$dt_fim;

    public function filtrarDados( $utilizador = null,$dt_inicio_format = null,  $dt_fim_format = null){

        if(isset($utilizador) && isset($dt_inicio_format) && isset($dt_fim_format)){
            //Formatar as datas que estão a vir do fronte
            $dt_inicio_format = Carbon::parse($this->dt_inicio)->format('Y-m-d') .' 00:00:00';
            $dt_fim_format   = Carbon::parse($this->dt_fim )->format('Y-m-d') .' 23:59:59';

            //Filtrar os dados
            $dados = DB::table('vendas as v')
                    ->join('detalhes_vendas as dt','dt.id_venda','=','v.id')
                    ->join('pessoas as p','p.id','=','v.id_pessoa')
                    ->join('users as u','u.id','=','v.user_id')
                    ->select('v.created_at as data','u.name as usuario','v.imovel',
                    'dt.preco','dt.quantidade','v.total','v.tipo_pagamento','v.banco as conta','p.nome')
                    ->whereBetween('v.created_at',[$dt_inicio_format,$dt_fim_format])
                    ->where('u.id',$utilizador)
                    ->get();
        //Verificar se algum dado foi encontrado
        if($dados){
            return $dados;

        }else{
            return;
        }


        }
    }

    //Gerar Pdf
    public function imprimir(){
        $dados = $this->filtrarDados($this->utilizador,$this->dt_inicio,$this->dt_fim);

        if($dados->count() > 0){
            $empresa = Empresa::find(1);
            $pdfContent = new Dompdf();
            $pdfContent = PDF::loadView('invoices.relatorio',[
                'dados'=>$dados,
                'empresa'=>$empresa
            ])->setPaper('a4', 'portrait')->output();
            return response()->streamDownload(
                fn () => print($pdfContent),
                "Relatorio_Vendas.pdf"
            );
        }
    }



    public function render()
    {
        return view('livewire.relatorios',[
            'utilizadores'=>User::get(),
            'dados'=>$this->filtrarDados($this->utilizador,$this->dt_inicio,$this->dt_fim),
        ])->layout('modules.admin.app');
    }
}
