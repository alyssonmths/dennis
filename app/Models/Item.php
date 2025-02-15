<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table = 'itens';
    protected $fillable = [
        'nome',
        'valor',
        'descricao',
        'favoritado'
    ];
    use HasFactory;
}
