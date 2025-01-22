@extends('layout')
@push('css')
    <link rel="stylesheet" href="/css/calculos.css">
@endpush
@push('script')
    <script src="/scripts/calculos.js"></script>
@endpush

@section('conteudo')
    <section id="calculos">
        <h4>Novo cálculo</h4>

        <div id="precos" class="row">
            
            @if (session('mensagem'))
                <div class="alert alert-success alert-dismissible" role="alert">
                    {{session('mensagem')}}
                </div>
            @endif

            @if (session('selecionarFuncionario'))
                <div class="alert alert-warning alert-dismissible" role="alert">
                    {{session('selecionarFuncionario')}}
                </div>
            @endif

            <h5 id="adicione">Adicione</h5>

            @foreach ($itens as $item)
                @if ($item['favoritado'] == 1)
                    <div id="{{$item['id']}}" class="card col-sm-6 col-md-4 col-lg-3">
                        <div class="card-body">
                            <h5 class="card-title">{{$item['nome']}} 
                                <span class="badge text-bg-warning text-light"><i class="bi bi-star-fill"></i></span> 
                            </h5>
                            <p class="card-text">{{$item['descricao']}}</p>
                            <h6 class="text-success">R${{number_format($item['valor'], 2, ',', '.')}}</h6>
                        </div>
                    </div>
                @endif
            @endforeach

            <button class="btn btn-info my-3" type="button" data-bs-toggle="offcanvas" data-bs-target="#items" aria-controls="offcanvasExample">
                Ver mais
            </button>
              
            <div class="offcanvas offcanvas-start w-75" tabindex="-1" id="items">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasExampleLabel">Adicionar</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
                </div>
                <div class="offcanvas-body row align-content-start">
                    @foreach ($itens as $item)
                        <div id="{{$item['id']}}" class="card col-sm-6 col-md-4 col-lg-3">
                            <div class="card-body">
                                <h5 class="card-title">{{$item['nome']}}</h5>
                                <p class="card-text">{{$item['descricao']}}</p>
                                <h6 class="text-success">R${{number_format($item['valor'], 2, ',', '.')}}</h6>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            @if (!empty($carrinho))
                <div id="detalhesCalculo">
                    @foreach ($carrinho as $item)
                        <div>
                            <strong>{{$item->name}}</strong>
                            <p>{{$item->descricao}}</p>
                            <p><strong>Quantidade: </strong> 
                                <input type="hidden" id="hash" value="{{$item->getHash()}}">
                                <input type="number" class="form-control w-25 d-inline" id="quantidade" value="{{$item->qty}}">
                            </p>
                            <p><strong>Valor unitário: </strong> R$ {{number_format($item->price, 2, ',', '.')}}</p>
                            <strong class="text-success">Subtotal: R$ {{number_format($item->price * $item->qty, 2, ',', '.')}}</strong>
                        </div>
                    @endforeach
                    <h5 class="mt-3">Total: {{$total}}</h5>

                    <form action="{{route('calculo.registrar')}}" method="POST" class="mt-3">
                        @csrf
                        <select name="funcionario_id" class="form-select">
                            <option value="">Selecione o funcionário</option>
                            @foreach ($funcionarios as $funcionario)
                                <option value="{{$funcionario['id']}}">{{$funcionario['nome']}}</option>
                            @endforeach
                        </select>
                        <button class="btn btn-info mt-3" type="submit">Criar cálculo</button>
                    </form>
                </div>
            @endif

        </div>
    </section>
@endsection