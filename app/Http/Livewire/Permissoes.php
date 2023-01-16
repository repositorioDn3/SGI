<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class Permissoes extends Component
{
    public $search_user, $utilizador;

    public function show($search_user = null){
        if(isset($search_user )){
            $utilizador = User::where('esta_desponivel','<>',$search_user)
                            ->where('name','like','%'.$search_user.'%')->get();
            return $utilizador;
        }else{
            $utilizador = User::where('esta_desponivel','<>',$search_user)->get();
            return $utilizador;
        }
    }
    public function render()
    {
        return view('livewire.permissoes',[
            'utilizadores'=>$this->show($this->search_user)
        ])->layout('modules.admin.app');
    }
}
