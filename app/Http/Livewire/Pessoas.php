<?php

namespace App\Http\Livewire;

use App\Models\Pessoa;
use Livewire\Component;

class Pessoas extends Component
{
    public $search,
    $nome,
    $telefone,
    $tipo_pessoa,
    $email,
    $nif,
    $endereco,
    $pessoa_id;
    public function resetInputs()
    {
            $this->nome = '';
            $this->telefone = '';
            $this->tipo_pessoa = '';
            $this->email = '';
            $this->nif = '';
            $this->endereco = '';
            $this->pessoa_id = '';
    }

    protected $rules = [
        'nome'=>'required',
        'telefone'=>'required',
        'email'=>'required',
        'nif'=>'required',
        'endereco'=>'required',
    ];

    public function updated($field){
        $this->validateOnly($field,$this->rules);
    }

        public function save(){
            try {
                $this->validate($this->rules);
                 $pessoaAdded = new Pessoa();
                 $pessoaAdded->nome = $this->nome;
                 $pessoaAdded->telefone = $this->telefone;
                 $pessoaAdded->email = $this->email;
                 $pessoaAdded->nif = $this->nif;
                 $pessoaAdded->tipo_pessoa = $this->tipo_pessoa;
                 $pessoaAdded->endereco = $this->endereco;
                 $pessoaAdded->save();
     
     
                 if($pessoaAdded){
                     $this->dispatchBrowserEvent('success',[
                         'message'=>'Cliente adicionado com sucesso.'
                     ]);
                 }else{
                     $this->dispatchBrowserEvent('success',[
                         'message'=>'Falha ao adicionar Cliente.'
                     ]);
                 }
     
                 $this->resetInputs();
             }catch(\Exception $ex) {
                 $this->dispatchBrowserEvent('serverError',[
                     'message'=>'Falha no servidor: '.$ex->getMessage()
                 ]);
             }
        }
        public function edit($id){

            $pessoafinded = Pessoa::find($id);
            $this->nome = $pessoafinded->nome;
            $this->telefone = $pessoafinded->telefone;
            $this->tipo_pessoa = $pessoafinded->tipo_pessoa;
            $this->email = $pessoafinded->email;
            $this->nif = $pessoafinded->nif;
            $this->endereco = $pessoafinded->endereco;
            $this->pessoa_id= $pessoafinded->id;

        }
        public function update(){
            try {
                $this->validate($this->rules);
                 $pessoaUpdated = Pessoa::find($this->pessoa_id);
                 $pessoaUpdated->nome = $this->nome;
                 $pessoaUpdated->telefone = $this->telefone;
                 $pessoaUpdated->email = $this->email;
                 $pessoaUpdated->nif = $this->nif;
                 $pessoaUpdated->tipo_pessoa = $this->tipo_pessoa;
                 $pessoaUpdated->endereco = $this->endereco;
                 $pessoaUpdated->save();
     
     
                 if($pessoaUpdated){
                     $this->dispatchBrowserEvent('success',[
                         'message'=>'Cliente actalizado com sucesso.'
                     ]);
                     $this->dispatchBrowserEvent('close-modal');
                 }else{
                     $this->dispatchBrowserEvent('success',[
                         'message'=>'Falha ao actualizar Cliente.'
                     ]);
                 }
     
                 $this->resetInputs();
             }catch(\Exception $ex) {
                 $this->dispatchBrowserEvent('serverError',[
                     'message'=>'Falha no servidor: '.$ex->getMessage()
                 ]);
             }
        }
        public function delete($id){
            try {
                 $pessoaDeleted = Pessoa::find($id);
                 $pessoaDeleted->esta_desponivel = 'nao';
                 $pessoaDeleted->save();
     
     
                 if($pessoaDeleted){
                     $this->dispatchBrowserEvent('success',[
                         'message'=>'Cliente excluido com sucesso.'
                     ]);
                 }else{
                     $this->dispatchBrowserEvent('success',[
                         'message'=>'Falha ao excluir Cliente.'
                     ]);
                 }
     
                 $this->resetInputs();
             }catch(\Exception $ex) {
                 $this->dispatchBrowserEvent('serverError',[
                     'message'=>'Falha no servidor: '.$ex->getMessage()
                 ]);
             }
        }
        public function show($search){
        if(isset($search)){
            $pessoas = Pessoa::where('nome','like','%'.$search.'%')
                                ->where('esta_desponivel','<>','nao')->paginate(5);
            return $pessoas;
        }else{
            $pessoas = Pessoa::where('esta_desponivel','<>','nao')->paginate(5);
            return $pessoas;
        }
    }
    public function render()
    {
        return view('livewire.pessoas',[
            'pessoas'=>$this->show($this->search)
        ])->layout('modules.admin.app');
    }
}
