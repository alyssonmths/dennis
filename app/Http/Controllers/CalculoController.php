<?php

namespace App\Http\Controllers;

use App\Models\Calculo;
use App\Models\Funcionario;
use Illuminate\Http\Request;
use LukePOLO\LaraCart\Facades\LaraCart;
use LukePOLO\LaraCart\LaraCartServiceProvider;
use App\Models\Item;

class CalculoController extends Controller
{
    public function list() { // lista todos os itens para um novo cálculo
        $carrinho = LaraCart::getItems();
        $total = Laracart::total();
        $funcionarios = Funcionario::select('id', 'nome')->get();
        $itens = Item::orderBy('nome', 'asc')->get();
        return view('calculos', compact('carrinho', 'total', 'itens', 'funcionarios'));
    }

    public function registrarCarrinho(Request $request) {
        $id_item = $request->input('id_item');
        $item = Item::find($id_item);
        $nome = $item['nome'];
        $descricao = $item['descricao'];
        $valor = $item['valor'];
        $quantidade = $request->input('quantidade');
        
        Laracart::add($id_item, $nome, $quantidade, $valor, ['descricao' => $descricao]);

        return back()->with('mensagem', 'Item adicionado!');
    }

    public function registrar(Request $request) {
        $funcionario_id = $request->input('funcionario_id');

        if ($funcionario_id == '') {
            return back()->with('selecionarFuncionario', 'Selecione o funcionário para atribuir ao cálculo!');
        }

        // montar o json

        $items = LaraCart::getItems();
        $itemsArray = [
            'itens' => []
        ];

        foreach ($items as $item) {
            array_push($itemsArray['itens'], [
                'id_item' => $item->id,
                'nome' => $item->name,
                'quantidade' => $item->qty,
                'valor_unitario' => $item->price
            ]);
        }

        $jsonItems = json_encode($itemsArray);
        $total = Laracart::total(false);

        Calculo::create([
            'id_funcionario' => $funcionario_id,
            'itens' => $jsonItems,
            'total' => $total
        ]);

        Laracart::destroyCart();

        return back()->with('mensagem', 'Cálculo criado com sucesso!');
    }

    public function atualizar(Request $request) {
        $hash = $request->input('hash');
        $quantidade = $request->input('quantidade');

        Laracart::updateItem($hash, 'qty', $quantidade);
    }

    public function listar($id = '') { // lista os cálculos
        if ($id == '') {
            $calculos = Calculo::leftJoin('funcionarios', 'calculos.id_funcionario', '=', 'funcionarios.id')->select('funcionarios.nome', 'calculos.total', 'calculos.created_at', 'calculos.id')->get();
            return view('subviews/listarCalculos', compact('calculos'));
        }
        else {
            $calculo = Calculo::leftJoin('funcionarios', 'calculos.id_funcionario', '=', 'funcionarios.id')
            ->where('calculos.id', $id)
            ->select('calculos.itens', 'calculos.total', 'calculos.created_at', 'funcionarios.nome', 'funcionarios.id')
            ->first();

            $calculo_itens = json_decode($calculo['itens']);
            
            return view('subviews/detalhesCalculo', compact('calculo', 'calculo_itens'));
        }
    }

    public function calculosFuncionario($id) {
        $calculos = Calculo::leftJoin('funcionarios', 'calculos.id_funcionario', '=', 'funcionarios.id')->select('calculos.itens', 'calculos.total', 'calculos.created_at')->where('calculos.id_funcionario', $id)->orderBy('calculos.created_at', 'desc')->get();
        $funcionario = Funcionario::select('nome', 'cargo', 'imagem')->findOrFail($id);
        return view('subviews/calculosFuncionario', compact('calculos', 'funcionario'));
    }
}
