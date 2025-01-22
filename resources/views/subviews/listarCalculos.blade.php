@extends('layout')

@push('css')
    <link rel="stylesheet" href="/css/listar_calculos.css">
    <link rel="stylesheet" href="//cdn.datatables.net/2.1.8/css/dataTables.dataTables.min.css">
@endpush

@push('script')
    <script src="/scripts/detalhar_calculo.js"></script>
    <script src="//cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>
@endpush

@section('conteudo')
    <section>
        <div class="table-container">
            <table id="tableCalculos" class="styled-table">
                <thead>
                    <tr>
                        <th>Funcionário</th>
                        <th>Valor</th>
                        <th>Data</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($calculos as $calculo)
                        <tr title="Exibir detalhes" id="{{$calculo['id']}}">
                            <td>{{$calculo['nome']}}</td>
                            <td>R$ {{number_format($calculo['total'], 2, ',', '.')}}</td>
                            <td>{{$calculo['created_at']->format('d/m/Y H:i')}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <a href="{{route('gerar.pdf', ['parametro' => 'calculos'])}}" class="btn btn-outline-info col col-sm col-lg-3">Exportar cálculos</a>
    </section>
@endsection