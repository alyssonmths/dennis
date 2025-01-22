@extends('layout')
@push('css')
    <link rel="stylesheet" href="/css/detalhar_calculo.css">
@endpush

@section('conteudo')
    <section id="detalhes">
        <div class="card">
            <div class="title">Detalhes</div>
            <div class="info">
                <div class="row">
                    <div class="col-7">
                        <span id="heading">Funcionário</span><br>
                        <span id="details">{{$calculo['nome']}}</span>
                    </div>
                    <div class="col-5 pull-right">
                        <span id="heading">Data</span><br>
                        <span id="details">{{$calculo['created_at']->format('d/m/Y H:i')}}</span>
                    </div>
                </div>
            </div>      
            <div class="pricing">
                @foreach ($calculo_itens->itens as $item)
                    <div class="row">
                        <div class="col-9">
                            <span id="nome">{{$item->nome}} x {{$item->quantidade}}</span>  
                        </div>
                        <div class="col-3">
                            <span id="subtotal">R${{number_format($item->valor_unitario * $item->quantidade, 2, ',', '.')}}</span>
                        </div>
                    </div>
                    <hr>
                @endforeach
            </div>
            <div class="total">
                <div class="row">
                    <div class="col-9">Total:</div>
                    <div class="col-3"><big>R$ {{number_format($calculo['total'], 2, ',', '.')}}</big></div>
                </div>
            </div>
        </div>

        <a href="/calculos/funcionario/{{$calculo['id']}}" class="btn btn-outline-info w-50 mt-3" style="max-width: 400px">Ver as estatísticas de {{$calculo['nome']}}</a>
    </section>
@endsection