<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calculo extends Model
{
    use HasFactory;
    protected $table = 'calculos';
    protected $fillable = [
        'id_funcionario', 'itens', 'total'
    ];
}
