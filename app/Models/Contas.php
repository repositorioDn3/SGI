<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contas extends Model
{
    use HasFactory;
    protected $table  = 'contas';
    protected $primaryKey = 'id';
    protected $fillable = ['banco','numero','ibam','empresa'];
}
