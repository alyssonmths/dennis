<?php

namespace App\Http\Controllers;

use App\Models\Calculo;
use App\Models\Funcionario;
use App\Models\Item;
use Illuminate\Http\Request;

class GraficoController extends Controller
{
    public function retornarDados($parametro = '', $id = '') {
        if ($parametro == 'calculos') {

            $somasPorMes = [
                'Janeiro' => 0,
                'Fevereiro' => 0,
                'Março' => 0,
                'Abril' => 0,
                'Maio' => 0,
                'Junho' => 0,
                'Julho' => 0,
                'Agosto' => 0,
                'Setembro' => 0,
                'Outubro' => 0,
                'Novembro' => 0,
                'Dezembro' => 0,
            ];

            $resultados = Calculo::select(Calculo::raw('SUM(total) as total, MONTH(created_at) as mes'))
            ->groupBy('mes')
            ->get();

            foreach ($resultados as $resultado) {
                switch ($resultado->mes) {
                    case 1:
                        $somasPorMes['Janeiro'] = $resultado->total;
                        break;
                    case 2:
                        $somasPorMes['Fevereiro'] = $resultado->total;
                        break;
                    case 3:
                        $somasPorMes['Março'] = $resultado->total;
                        break;
                    case 4:
                        $somasPorMes['Abril'] = $resultado->total;
                        break;
                    case 5:
                        $somasPorMes['Maio'] = $resultado->total;
                        break;
                    case 6:
                        $somasPorMes['Junho'] = $resultado->total;
                        break;
                    case 7:
                        $somasPorMes['Julho'] = $resultado->total;
                        break;
                    case 8:
                        $somasPorMes['Agosto'] = $resultado->total;
                        break;
                    case 9:
                        $somasPorMes['Setembro'] = $resultado->total;
                        break;
                    case 10:
                        $somasPorMes['Outubro'] = $resultado->total;
                        break;
                    case 11:
                        $somasPorMes['Novembro'] = $resultado->total;
                        break;
                    case 12:
                        $somasPorMes['Dezembro'] = $resultado->total;
                        break;
                }
            }

            return response()->json($somasPorMes);
        }
        else if ($parametro == 'itens') {
            $itens = Item::all();
            return $itens;
        }
        else if ($parametro == 'funcionarios') {
            $resultados = Funcionario::select(
                'funcionarios.nome',
                Funcionario::raw("DATE_FORMAT(calculos.created_at, '%m') as mes"),
                Funcionario::raw("SUM(calculos.total) as total_calculos")
            )
            ->join('calculos', 'funcionarios.id', '=', 'calculos.id_funcionario')
            ->groupBy('funcionarios.nome', 'mes')
            ->orderBy('funcionarios.nome')
            ->get();

            $calculosPorMes = [
                'Janeiro' => 0,
                'Fevereiro' => 0,
                'Março' => 0,
                'Abril' => 0,
                'Maio' => 0,
                'Junho' => 0,
                'Julho' => 0,
                'Agosto' => 0,
                'Setembro' => 0,
                'Outubro' => 0,
                'Novembro' => 0,
                'Dezembro' => 0,
            ];
            
            $dados = [];

            foreach ($resultados as $resultado) {
                $nome = $resultado->nome;
                $mes = $resultado->mes;
                $total_calculos = $resultado->total_calculos;

                if (!isset($dados[$nome])) {
                    $dados[$nome] = [
                        'nome' => $nome,
                        'total' => array_fill(0, 12, 0)
                    ];
                }

                $dados[$nome]['total'][$mes - 1] = $total_calculos;
            }

            $dados = array_values($dados);
            
            return $dados;
        }
        else if ($parametro == 'funcionario' && $id != '') {
            $somasPorMes = [
                'Janeiro' => 0,
                'Fevereiro' => 0,
                'Março' => 0,
                'Abril' => 0,
                'Maio' => 0,
                'Junho' => 0,
                'Julho' => 0,
                'Agosto' => 0,
                'Setembro' => 0,
                'Outubro' => 0,
                'Novembro' => 0,
                'Dezembro' => 0,
            ];

            $resultados = Funcionario::select(
                'funcionarios.nome', 
                Funcionario::raw("SUM(calculos.total) as total"),
                Funcionario::raw("MONTH(calculos.created_at) as mes")
            )
            ->join('calculos', 'funcionarios.id', '=', 'calculos.id_funcionario')
            ->where('funcionarios.id', $id)
            ->groupBy('funcionarios.nome', 'mes')
            ->get();

            foreach ($resultados as $resultado) {
                switch ($resultado->mes) {
                    case 1:
                        $somasPorMes['Janeiro'] = $resultado->total;
                        break;
                    case 2:
                        $somasPorMes['Fevereiro'] = $resultado->total;
                        break;
                    case 3:
                        $somasPorMes['Março'] = $resultado->total;
                        break;
                    case 4:
                        $somasPorMes['Abril'] = $resultado->total;
                        break;
                    case 5:
                        $somasPorMes['Maio'] = $resultado->total;
                        break;
                    case 6:
                        $somasPorMes['Junho'] = $resultado->total;
                        break;
                    case 7:
                        $somasPorMes['Julho'] = $resultado->total;
                        break;
                    case 8:
                        $somasPorMes['Agosto'] = $resultado->total;
                        break;
                    case 9:
                        $somasPorMes['Setembro'] = $resultado->total;
                        break;
                    case 10:
                        $somasPorMes['Outubro'] = $resultado->total;
                        break;
                    case 11:
                        $somasPorMes['Novembro'] = $resultado->total;
                        break;
                    case 12:
                        $somasPorMes['Dezembro'] = $resultado->total;
                        break;
                }
            }
            return ['nome' => $resultados[0]->nome, 'total' => $somasPorMes];
        }
    }

    public function index() {
        return view('estatistica');
    }
}
