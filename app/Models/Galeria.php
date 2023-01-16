<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Galeria extends Model
{
    use HasFactory;

    protected $table  = 'galerias';
    protected $primaryKey = 'id';
    protected $fillable = ['imagem','imovel'];


    public function Categoria(){
        $this->belongsTo(Categoria::class,'categoria','id');
    }
}
