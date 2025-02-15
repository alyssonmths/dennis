<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Funcionario extends Model
{
    protected $table = 'funcionarios';
    protected $fillable = [
        'nome',
        'cargo',
        'regime',
        'salario',
        'imagem'
    ];
    use HasFactory;
}
