<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FaturasController;
use App\Http\Livewire\Autenticacao\Acessar;
use App\Http\Livewire\Autenticacao\Perfil;
use App\Http\Livewire\Categorias;
use App\Http\Livewire\ContasBancaria;
use App\Http\Livewire\Empresas;
use App\Http\Livewire\Imoveis;
use App\Http\Livewire\Permissoes;
use App\Http\Livewire\Pessoas;
use App\Http\Livewire\Relatorios;
use App\Http\Livewire\Utilizadores;
use App\Http\Livewire\Vendas;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Welcome;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

//Utilizador Root
Route::get('/root',function(){
    $user = User::where('position','=','ADMIN')->first();
    if($user){
        $user->update([
            'name'=>'ADMIN',
            'position'=>'ADMIN',
            'email'=>'admin@gmail.com',
            'password'=> Hash::make('rootuser01'),
        ]);
    }else{

        User::create([
            'name'=>'ADMIN',
            'position'=>'ADMIN',
            'email'=>'admin@gmail.com',
            'password'=> Hash::make('rootuser01'),
        ]);
    }

    return back();
});

//Rotas para autenticacao
Route::get('/',[AuthController::class,'tela_login'])->name('login'); // controller da view de login
Route::post('/acessar',[AuthController::class,'acessar'])->name('acessar'); // controller da view de login
Route::get('/sair',[AuthController::class,'sair'])->name('sair'); // controller da view de login
//Rotas para autenticacao
//Rotas de faturas
Route::get('/fatura',function(){
    $data = DB::table('vendas as v')->join('detalhes_vendas as dv','v.id','=','dv.id_venda')
                ->select('v.imovel','v.total','v.banco','v.tipo_pagamento','v.id_pessoa','dv.preco','dv.quantidade','dv.subtotal','dv.desconto')
                ->where('v.id','=',1)->get();

    dd($data);
});
//Rotas de faturas
//Utilizador logado
Route::get('/minha/conta',Perfil::class)->name('perfil')->middleware(['auth']); // componente principal
//Rotas de componentes
Route::get('/dashboard',Welcome::class)->name('dashboard')->middleware(['auth']); // componente principal
Route::get('/imoveis',Imoveis::class)->name('admin.imoveis')->middleware(['auth']); // componente imoveis
Route::get('/categorias',Categorias::class)->name('admin.categorias')->middleware(['auth']); // componente Categorias
Route::get('/clientes',Pessoas::class)->name('admin.clientes')->middleware(['auth']); // componente Categorias
Route::get('/vendas',Vendas::class)->name('admin.vendas')->middleware(['auth']); // componente Vendas
Route::get('/utilizadores',Utilizadores::class)->name('admin.utilizadores')->middleware(['auth']); // componente Vendas
Route::get('/permissoes',Permissoes::class)->name('utilizador.permissao')->middleware(['auth']); // componente Vendas
Route::get('/empresa',Empresas::class)->name('empresa')->middleware(['auth']); // componente Vendas
Route::get('/contas/bancarias',ContasBancaria::class)->name('contas.bancaria')->middleware(['auth']); // componente Vendas
Route::get('/relatorios',Relatorios::class)->name('relatorios')->middleware(['auth']); // componente Vendas


