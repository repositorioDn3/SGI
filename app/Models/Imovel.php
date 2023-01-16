<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Imovel extends Model
{
    use HasFactory;

    protected $table  = 'imoveis';
    protected $primaryKey = 'id';
    protected $fillable = [
        'preco_inicial',
        'preco_final',
        'preco_total',
        'area_total',
        'area_construida',
        'quantidade',
        'descricao',
        'categoria',
        'esta_desponivel',
    ];


    public function categorias(){
       return $this->belongsTo(Categoria::class,'categoria','id');
    }



}
