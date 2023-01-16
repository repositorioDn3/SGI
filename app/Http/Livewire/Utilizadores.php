<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Nette\Utils\Random;

class Utilizadores extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $search,$name,$email,$phone,$position,$photo,$password,$photo_edit,$utilizador_id;
    //Validacoes
    protected $rules = [
        'name'=>'required',
        'email'=>'required|unique:users',
        'phone'=>'required|unique:users',
    ];
    //Validacao a tempo real
    public function updated($field){

        $this->validateOnly($field,$this->rules);
    }
    //metodo para limpar campos
    public function resetInputs(){
        $this->name = '';
        $this->email = '';
        $this->phone = '';
        $this->photo = '';
        $this->position = '';
        $this->password = '';
        $this->utilizador_id = '';
    }
    //Metodo para adicionar utilizador
    public function save(){
        try {

            $defaultPassword = '12345678';

            $this->password = \Hash::make($defaultPassword);

            $utilizador = User::create([
                'name'=>$this->name,
                'email'=>$this->email,
                'photo'=>$this->photo,
                'phone'=>$this->phone,
                'position'=>$this->phone,
                'password'=>$this->password
            ]);
            if($utilizador){

                $this->dispatchBrowserEvent('success',[
                    'message'=>'Utilizador adicionado com sucesso.'
                ]);
                $this->resetInputs();
            }
        } catch (\Exception $ex) {
           $this->dispatchBrowserEvent('error',[
            'message'=>'Falha no servidor: '.$ex->getMessage()
           ]);
        }
    }


    //Metodo para excluir conta de utilizador
    public function delete($id){
        try {
            $utilizadorDeleted  = User::find($id);
            $utilizadorDeleted->esta_desponivel = 'nao';
            $utilizadorDeleted->save();

            if($utilizadorDeleted){
                $this->dispatchBrowserEvent('success',[
                    'message'=>'Conta excluida com sucesso'
                ]);
                $this->emit('deleteRow');
            }else{
                $this->dispatchBrowserEvent('error',[
                    'message'=>'Falha ao excluir conta.'
                ]);
            }
        } catch (\Exception $ex) {
            $this->dispatchBrowserEvent('error',[
                'message'=>'Falha no servidor: '.$ex->getMessage()
            ]);
        }
    }
    //metodo para editar dados
    public function edit($id){
        $utilizadorFinded = User::find($id);

        $this->name = $utilizadorFinded->name;
        $this->email = $utilizadorFinded->email;
        $this->phone = $utilizadorFinded->phone;
        $this->position = $utilizadorFinded->position;
        $this->utilizador_id = $utilizadorFinded->id;
    }



    public function update(){
        try {

            $this->validate($this->rules);
            $utilizadorUpdated = User::find($this->utilizador_id);

                $utilizadorUpdated->name  = $this->name;
                $utilizadorUpdated->email = $this->email;
                $utilizadorUpdated->photo = $this->photo;
                $utilizadorUpdated->phone = $this->phone;
                $utilizadorUpdated->position = $this->position;
                $utilizadorUpdated->save();

                if($utilizadorUpdated){

                    $this->dispatchBrowserEvent('success',[
                        'message'=>'Utilizador actualizado com sucesso.'
                    ]);
                    $this->dispatchBrowserEvent('users_modal_hide');
                    $this->resetInputs();

                }

        } catch (\Exception $ex) {
           $this->dispatchBrowserEvent('error',[
            'message'=>'Falha no servidor: '.$ex->getMessage()
           ]);
        }
    }
    //Metodo para mostrar todos utilizadores
    public function show($search = null){

        if(isset($search)){

            $utilizadores = User::where('name','like','%'.$search.'%')
                            ->where('esta_desponivel','<>','nao')->paginate(5);
            return $utilizadores;
        }else{
            $utilizadores = User::where('esta_desponivel','<>','nao')->paginate(5);
            return $utilizadores;

        }

    }

    public function render()
    {
        return view('livewire.utilizadores',[
            'utilizadores'=>$this->show($this->search)
        ])->layout('modules.admin.app');
    }
}
