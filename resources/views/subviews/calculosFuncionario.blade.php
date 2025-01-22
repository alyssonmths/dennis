@extends('layout')

@push('css')
    <link rel="stylesheet" href="/css/calculosFuncionario.css">
@endpush

@push('script')
    <script src="/scripts/chart_funcionario.js"></script>
@endpush

@section('conteudo')
    <section class="m-3 row justify-content-evenly">
        <div id="detalhes-funcionario" class="mb-3 mb-sm-0 col-sm-4 col-lg-2">
            <img src="/images/{{$funcionario->imagem}}" class="m-3">
            <h6>{{$funcionario->nome}}</h6>
            <small>{{$funcionario->cargo}}</small>
            <p id="media_salarial">Média salarial: R$</p>

            <div id="ultimos_pagamentos" class="my-4">
                <h6>Últimos pagamentos</h6>

                @foreach ($calculos as $index => $calculo)
                    @if ($index >= 3)
                        @break
                    @endif
                    <a href="#">
                        <h6 class="card-title">Data: {{$calculo->created_at->format('d/m/Y')}}</h6>
                        <div class="row justify-content-center">
                            <h6>Total: <span class="text-success">R$ {{number_format($calculo->total, 2, ',', '.')}}</span></h6>
                        </div>
                    </a>
                @endforeach

                <button class="btn btn-outline-info btn-sm mt-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#todos_calculos">
                    Todos os cálculos
                </button>
                  
                <div class="offcanvas offcanvas-start" tabindex="-1" id="todos_calculos">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasExampleLabel">Todos os cálculos</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body row align-content-start">
                        @foreach ($calculos as $calculo)

                            @php
                                $itens = json_decode($calculo->itens);
                            @endphp

                            <div class="card my-2">
                                <div class="card-body">
                                    <h6>{{$calculo->created_at->format('d/m/Y')}}</h6>

                                    @foreach ($itens->itens as $item)
                                        <div>
                                            <h6>{{$item->nome}}</h6>
                                            <p>Quantidade: {{$item->quantidade}}</p>
                                            <p>Valor unitário: R${{number_format($item->valor_unitario, 2, ',', '.')}}</p>
                                            <p>Subtotal: {{$item->quantidade}} x {{number_format($item->valor_unitario, 2, ',', '.')}} = R${{$item->quantidade*$item->valor_unitario}}</p>
                                        </div>
                                    @endforeach

                                    <h6>Total: <span class="text-success">R${{number_format($calculo->total, 2, ',', '.')}}</span></h6>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div id="estatisticas" class="col-sm-7 col-lg-9">
            <h5>Estatísticas de {{$funcionario->nome}}</h5>
            {{-- <div>
                <h6>Evolução salarial</h6>
                <img src="/images/grafico_teste.png">
            </div> --}}
            
            <div class="text-center my-3">
                <h5 class="mb-0">Total de pagamentos</h5>
            </div>
            <div style="width: 100%; max-width: 700px;">
                <canvas id="grafico1"></canvas>
            </div>
        </div>
    </section>
@endsection