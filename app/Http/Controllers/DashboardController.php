<?php

namespace App\Http\Controllers;

use App\Models\Calculo;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        $calculos = Calculo::leftJoin('funcionarios', 'calculos.id_funcionario', '=', 'funcionarios.id')->select('funcionarios.nome', 'calculos.total', 'calculos.created_at', 'calculos.id')->orderBy('calculos.created_at', 'DESC')->limit(5)->get();
        return view('home', compact('calculos'));
    }
}
