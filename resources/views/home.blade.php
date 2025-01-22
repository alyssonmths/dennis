@push('css')
    <link rel="stylesheet" href="css/home.css">
@endpush

@push('script')
    <script src="/scripts/dados.js"></script>
@endpush

@extends('layout')

@section('conteudo')
    <section id="pagamentos">
        <h3>Últimos cálculos realizados</h3>

        <div class="table-container">
            <table class="styled-table">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Valor</th>
                        <th>Data</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($calculos as $calculo)
                        <tr>
                            <td>{{$calculo->nome}}</td>
                            <td>R${{number_format($calculo->total, 2, ',', '.')}}</td>
                            <td>{{$calculo->created_at->format('d/m/Y H:i')}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <a href="{{route('calculos.listar')}}" class="mt-3 btn btn-outline-info">Ver todos</a>
    </section>

    <section>
        <div class="text-center my-3">
            <h4 class="mb-0">Total de pagamentos</h4>
            <small class="text-secondary">todos os funcionários</small>
        </div>
        <div style="width: 100%; max-width: 700px;">
            <canvas id="grafico1"></canvas>
        </div>
    </section>

    {{-- <section>
        <h3>Despesas fixas</h3>
        <ul id="despesas">
            <li style="border-top: 1px solid #dddddd">
                Energia elétrica <span class="badge text-bg-info">R$300</span>
            </li>
            <li>
                Água <span class="badge text-bg-info">R$100</span>
            </li>
            <li>
                Gás <span class="badge text-bg-info">R$90</span>
            </li>
            <li>
                Mecânico <span class="badge text-bg-info">R$150</span>
            </li>
            <li>
                Total: R$
            </li>
        </ul>
        <button class="btn btn-outline-info">Adicionar despesa</button>
    </section> --}}
@endsection