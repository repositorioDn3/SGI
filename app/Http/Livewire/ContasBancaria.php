<?php

namespace App\Http\Livewire;

use App\Models\Contas;
use App\Models\Empresa;
use Exception;
use Illuminate\Foundation\Testing\WithoutEvents;
use Livewire\Component;
use Livewire\WithPagination;
class ContasBancaria extends Component
{
    use WithoutEvents;
    public $search,$banco,$numero,$ibam,$conta_id,$confirm_id;

    protected $rules = [
        'banco'=>'required',
        'ibam'=>'required',
        'numero'=>'required',
    ];

    public function updated($field){
        $this->validateOnly($field,$this->rules);
    }
    public function resetInputs(){
        $this->search = '';
        $this->banco = '';
        $this->numero = '';
        $this->ibam = '';
        $this->conta_id = '';
        $this->confirm_id = '';
    }
    public function save(){
        try {
            $this->validate($this->rules);

            dd($this->ibam);
            $empresa = Empresa::find(1);
            if($empresa){

                $contas = Contas::create([
                    'banco'=>$this->banco,
                    'numero'=>$this->numero,
                    'ibam'=>$this->ibam,
                    'empresa'=>$empresa->id,
                ]);
                if($contas){
                    $this->dispatchBrowserEvent('success',[
                        'message'=>'Conta bancaria adicionada com successo'
                    ]);
                    $this->resetInputs();
                }else{

                    $this->dispatchBrowserEvent('error',[
                        'message'=>'Falha ao adicionar conta bancaria'
                    ]);
                }
            }else{
                $this->dispatchBrowserEvent('error',[
                    'message'=>'Definir as informações da empresa'
                ]);
            }
        } catch (\Exception $ex) {
            dd($ex->getMessage());
            $this->dispatchBrowserEvent('error',[
                'message'=>'Falha no servidor : '.$ex->getMessage()
            ]);
        }
    }

    public function edit($id){
        $conta = Contas::find($id);

        $this->banco = $conta->banco;
        $this->numero = $conta->numero;
        $this->ibam = $conta->ibam;
        $this->conta_id = $conta->id;
    }

    public function update(){

        try {
            $this->validate($this->rules);
            $conta = Contas::find($this->conta_id);

                $conta->banco  =  $this->banco;
                $conta->numero =  $this->numero;
                $conta->ibam   =  $this->ibam;

                $conta->save();

            if($conta){
                $this->dispatchBrowserEvent('success',[
                    'message'=>'Conta bancaria actualizada com successo'
                ]);
                $this->dispatchBrowserEvent('close-modal');
                $this->resetInputs();

            }else{

                $this->dispatchBrowserEvent('error',[
                    'message'=>'Falha ao actualizar conta bancaria'
                ]);
            }
        } catch (\Exception $ex) {
            dd($ex->getMessage());
            $this->dispatchBrowserEvent('error',[
                'message'=>'Falha no servidor : '.$ex->getMessage()
            ]);
        }
    }

     //confirmar exclusao de dados
   public function confirm($id){
    $this->confirm_id = $id;
   }

   public function delete(){
        try{
            $conta  = Contas::destroy($this->confirm_id);
            if($conta){

                $this->dispatchBrowserEvent('success',[
                    'message'=>'Conta bancaria adicionada com sucesso'
                ]);
                $this->dispatchBrowserEvent('close-modal');
            }else{
                $this->dispatchBrowserEvent('error',[
                    'message'=>'Falha ao excluir conta bancaria'
                ]);
            }


        }catch(Exception $ex){
            $this->dispatchBrowserEvent('error',[
                'message'=>'Falha no servidor : '.$ex->getMessage()
            ]);
        }
   }
    public function ShowContas($search = null){
        if(isset($search)){
            $contas = Contas::where('banco','like','%'.$search.'%')->paginate(5);
            return $contas;
        }else{
            $contas = Contas::paginate(5);
            return $contas;

        }
    }
    public function render()
    {
        return view('livewire.contas-bancaria',[
            'contas'=>$this->ShowContas($this->search)
        ])->layout('modules.admin.app');

    }
}
