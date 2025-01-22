<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Calculo;
use App\Models\Funcionario;
use App\Models\Item;
use Barryvdh\DomPDF\Facade\Pdf;

class PdfController extends Controller
{
    public function gerarPdf($parametro = '') {
        switch ($parametro) {
            case 'itens':
                $itens = Item::all();
                $pdf = Pdf::loadView("subviews/pdf/itens_pdf", ['itens' => $itens]);
                break;
            case 'calculos':
                $calculos = Calculo::leftJoin('funcionarios', 'calculos.id_funcionario', '=', 'funcionarios.id')->select('funcionarios.nome', 'calculos.total', 'calculos.created_at', 'calculos.id')->get();
                $pdf = Pdf::loadView("subviews/pdf/calculos_pdf", ['calculos' => $calculos]);
                break;
            case 'funcionarios':
                $funcionarios = Funcionario::all();
                $pdf = Pdf::loadView("subviews/pdf/funcionarios_pdf", ['funcionarios' => $funcionarios]);
                break;
        }
        return $pdf->download("$parametro.pdf");
    }
}
