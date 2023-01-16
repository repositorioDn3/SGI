<?php

namespace App\Http\Livewire\Autenticacao;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

use Livewire\WithFileUploads;

class Perfil extends Component
{
    use WithFileUploads;
    public $name,$email,$phone,$position,$photo,$senha_actual,$nova_senha,$confirmar_senha;

    public function mount(){
        $this->name = auth()->user()->name;
        $this->email = auth()->user()->email;
        $this->phone = auth()->user()->phone;
        $this->position = auth()->user()->position;
        $this->photo = auth()->user()->photo;
    }
   
    //Limpar campos

    public function resetInputs(){
        $this->senha_actual = '';
        $this->nova_senha = '';
        $this->confirmar_senha = '';
    }
        //Metodo para actualizar dados do perfil
        public function update_dados_do_perfil(){
            try{
            $utilizador = User::find(auth()->user()->id);
            $this->validate([
                'name'=>'required|',
                'email'=>'required|unique:users',
                'phone'=>'required|unique:users',
            ]);

            $utilizador->name = $this->name;
            $utilizador->email = $this->email;
            $utilizador->phone = $this->phone;
            $utilizador->save();

            if($utilizador){

                $this->dispatchBrowserEvent('success',[
                    'message'=>'Dados actualizados com sucesso'
                ]);
            }else{
                $this->dispatchBrowserEvent('error',[
                    'message'=>'Falha ao actualizar dados '
                ]);
            }
        }catch(Exception  $ex){
            $this->dispatchBrowserEvent('error',[
                'message'=>'Falha no servidor: '.$ex->getMessage()
            ]);
        }

        }
        //Metodo para actualizar senha do utilizador
        public function update_senha_do_utilizador(){

            try{

            $this->validate([
                'senha_actual'=>'required|min:8',
                'nova_senha'=>'required|min:8',
                'confirmar_senha'=>'required|min:8',
            ],[
                'senha_actual.required'=>'Campo obrigatório',
                'nova_senha.required'=>'Campo obrigatório',
                'confirmar_senha.required'=>'Campo obrigatório',
                'senha_actual.min:8'=>'Campo deve ter 8 caracteres',
                'nova_senha.min:8'=>'Campo deve ter 8 caracteres',
                'confirmar_senha.min:8'=>'Campo deve ter 8 caracteres',
            ]);
            $utilizador = User::find(auth()->user()->id);
            
            if(Hash::check($this->senha_actual, $utilizador->password)){
                if($this->nova_senha === $this->confirmar_senha){
                    $utilizador->password = Hash::make($this->nova_senha);
                    $utilizador->save();

                    if($utilizador){
                        $this->dispatchBrowserEvent('success',[
                            'message'=>'Senha actualizada com sucesso.'
                        ]);

                        $this->resetInputs();
                    }else{
                        $this->dispatchBrowserEvent('error',[
                            'message'=>'Falha ao actualizar senha.'
                        ]);
                    }
                }else{
                        $this->dispatchBrowserEvent('error',[
                            'message'=>'Senhas não correspondem.'
                        ]);
                }
            }else{
                $this->dispatchBrowserEvent('error',[
                    'message'=>'Senha actual não corresponde.'
                ]);
            }
        }catch(Exception $ex){
            $this->dispatchBrowserEvent('error',[
                'message'=>'Falha no servidor: '.$ex->getMessage()
            ]);
        }

        }

        //Metodo para fazer upload da foto de perfil

        public function upload_foto_perfil(){
            try{

            $utilizador = User::find(auth()->user()->id);

            if(!($this->photo === $utilizador->photo)){
             
          
            if(isset($this->photo) && $this->photo != null){
                $originalName = $this->photo->getclientOriginalName();
                $extension = $this->photo->getClientOriginalExtension();
                $nome_foto = md5($originalName).'.'.$extension;

                $utilizador->photo = $nome_foto;
                $utilizador->save();
                $this->photo->storeAs('public/utilizadores/',$nome_foto);


                if($utilizador){
                    $this->dispatchBrowserEvent('success',[
                        'message'=>'Foto Adicionada  com successo'
                    ]);
                    $this->dispatchBrowserEvent('reload');
                    
                }else{
                    
                    $this->dispatchBrowserEvent('error',[
                        'message'=>'Falaha ao Adicionar foto'
                    ]);

                }


            }else{
                $this->dispatchBrowserEvent('warning',[
                    'message'=>'Nenhuma imagem foi selecionada'
                ]);
            }
        }
        }catch(Exception $ex){
            $this->dispatchBrowserEvent('warning',[
                'message'=>'Falha no servidor:'.$ex->getMessage()
            ]);
        }
        }

    public function render()
    {
        return view('livewire.autenticacao.perfil')->layout('modules.admin.app');
    }
}
