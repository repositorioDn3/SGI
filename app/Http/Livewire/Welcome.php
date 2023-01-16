<?php

namespace App\Http\Livewire;

use App\Models\Imovel;
use App\Models\Pessoa;
use App\Models\User;
use App\Models\Venda;
use Livewire\Component;

class Welcome extends Component
{
    



    public function render()
    {
        return view('livewire.welcome',[
            'clientes'=>Pessoa::count(),
            'imoveis'=>Imovel::count(),
            'utilizadores'=>User::count(),
            'vendas'=>Venda::count(),
        ])->layout('modules.admin.app');
    }
}
