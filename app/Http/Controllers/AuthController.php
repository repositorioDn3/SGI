<?php

namespace App\Http\Controllers;

use App\Http\Requests\AcessoRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function tela_login(){
        return view('modules.login');
    }

    public function acessar(AcessoRequest $request){
        try{
           

            $acesso = User::where('email','=',$request->email)
                            ->where('esta_desponivel','<>','nao')->first();

          if($acesso){

            $credentials = [
                'email'=>$request->email,
                'password'=>$request->senha,
            ]; 

            if(Auth::attempt($credentials)){
              
                return redirect()->route('dashboard');
                
            }else{

               return redirect()->back()->with('error','E-mail / Senha invalida.');
            }
        }else{
            
            return redirect()->back()->with('error','A conta que tentas acessar foi excluida!');
        }
        
    }catch(Exception $ex){
            return redirect()->back()->with('error','Falha no servidor: '.$ex->getMessage());
    }

    }

    public function sair(){
        if(Auth::check()){
            Auth::logout();
            Session()->invalidate();

            return redirect()->route('login');
        }
    }
}
