<?php

namespace App\Http\Controllers;

use App\Models\Funcionario;
use Illuminate\Http\Request;

class FuncionarioController extends Controller
{
    public function list() {
        $funcionarios = Funcionario::all();
        return view('funcionarios', compact('funcionarios'));
    }

    public function registrar(Request $request) {
        Funcionario::create($request->all());
        return redirect()->back();
    }

    public function retornarFuncionario(Request $request) {
        return Funcionario::find($request->input('id'));
    }

    public function atualizar(Request $request) {
        $funcionario = Funcionario::find($request->input('id'));
        $funcionario->update($request->all());
        return redirect()->back()->with('mensagem', 'Funcionário editado!');
    }

    public function apagar($id) {
        $funcionario = Funcionario::find($id);
        $funcionario->delete();
        return redirect()->back();
    }
}
