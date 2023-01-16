<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detalhes_Vendas extends Model
{
    use HasFactory;

    protected $table = 'detalhes_vendas';
    protected $primaryKey = 'id';
    protected $fillable = [
    'preco',
    'quantidade',
    'subtotal',
    'desconto',
    'divida',
    'prazo_entrega',
    'taxa',
    'id_imovel',
    'id_venda',
    ];


    public function venda(){

        return $this->belongsTo(Venda::class,'id_venda','id');

    }





}
