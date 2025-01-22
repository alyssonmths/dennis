@extends('layout')

@push('css')
    <link rel="stylesheet" href="css/pagamentos.css">
@endpush

@section('conteudo')
    <section id="pagamentos">
        <div class="table-container">
            <table class="styled-table">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Valor</th>
                        <th>Data</th>
                        <th>Cargo</th>
                        <th>Situação</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>João Silva</td>
                        <td>R$ 900,00</td>
                        <td>21/11/2024</td>
                        <td>Costureiro</td>
                        <td>Realizado <i class="bi bi-check-circle text-success"></i></td>
                    </tr>
                    <tr>
                        <td>Maria Santos</td>
                        <td>R$ 520,00</td>
                        <td>21/11/2024</td>
                        <td>Aprontador</td>
                        <td>Realizado <i class="bi bi-check-circle text-success"></i></td>
                    </tr>
                    <tr>
                        <td>Ana Souza</td>
                        <td>R$ 1400,00</td>
                        <td>22/11/2024</td>
                        <td>Motorista</td>
                        <td>Pendente <i class="bi bi-exclamation-triangle text-warning"></i></td>
                    </tr>
                    <tr>
                        <td>Josélia</td>
                        <td>R$ 900,00</td>
                        <td>23/11/2024</td>
                        <td>Costureiro</td>
                        <td>Realizado <i class="bi bi-check-circle text-success"></i></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <h4 class="mt-3">Aprovar pagamentos pendentes</h4>
        <div id="pendentes">
            <div>
                <div>
                    <p><span>Nome:</span> Ana Souza</p>
                    <p><span>Valor:</span> R$1400,00</p>
                    <p><span>Data:</span> 22/11/2024</p>
                </div>
                <div>
                    <h4><i class="bi bi-check-circle text-success"></i></h4>
                </div>
            </div>
        </div>
    </section>
@endsection