<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{
    use HasFactory;
    protected $table = 'vendas';
    protected $primaryKey = 'id';
    protected $fillable = [
    'id',
    'prestacoes',
    'total',
    'tipo_pagamento',
    'id_pessoa',
    'total_desconto',
    'banco ',
    'taxa',
    'divida',
    'user_id',
    ];


    public function cliente(){

     return   $this->belongsTo(Pessoa::class,'id_pessoa','id');

    }
    public function operador(){

     return   $this->belongsTo(User::class,'user_id','id');

    }

    public function detalhes(){

     return   $this->hasMany(Detalhes_Vendas::class,'id_venda','id');

    }



}
