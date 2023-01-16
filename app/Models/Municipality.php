<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Municipality extends Model
{
    use HasFactory;
    protected $table = 'municipalities';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'province_id',
    ];


    public function privince(){
        $this->belongsTo(Province::class,'province_id','id');
    }
}
