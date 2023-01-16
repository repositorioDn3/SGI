<?php

namespace App\Models;

use App\Http\Livewire\Vendas;
use App\Models\Detalhes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pessoa extends Model
{
    use HasFactory;

    protected $table = 'pessoas';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nome',
        'tipo_pessoa',
        'email',
        'endereco',
        'telefone',
        'esta_desponivel',
        'nif'
    ];

    public function Vendas(){

       return $this->hasMany(Venda::class,'id_pessoa','id');
       
    }

}
