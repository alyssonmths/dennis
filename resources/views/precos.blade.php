@extends('layout')
@push('css')
    <link rel="stylesheet" href="/css/precos.css">
    <link rel="stylesheet" href="//cdn.datatables.net/2.1.8/css/dataTables.dataTables.min.css">
@endpush
@push('script')
    <script src="/scripts/itens.js"></script>
    <script src="//cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>
@endpush

@section('conteudo')
    <section id="precos">
        <div class="table-container">
            <table id="tableItems" class="styled-table">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Valor</th>
                        <th>Descrição</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($itens as $item)
                        <tr id="{{$item['id']}}">
                            <td>{{$item['nome']}}
                                @if ($item['favoritado'] == 1)
                                    <span class="badge text-bg-warning text-light"><i class="bi bi-star-fill"></i></span> 
                                @endif
                            </td>
                            <td>R$ {{number_format($item['valor'], 2, ',', '.')}}</td>
                            <td>{{$item['descricao']}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>

        <div class="col-6 row">
            <button class="btn btn-outline-info mt-3 col" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvas">Adicionar</button>
            <button id="remover" class="btn btn-outline-info mt-3 col">Remover</button>
        </div>

        <div class="offcanvas offcanvas-top" tabindex="-1" id="offcanvas" aria-labelledby="offcanvasBottomLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasBottomLabel">Adicionar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body small">
                <form action="{{route('item.registrar')}}" method="POST">
                    @csrf
                    <label for="nome">Nome</label>
                    <input id="nome" name="nome" type="text" class="form-control" required>
                    <label for="valor">Valor</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text">R$</span>
                        <input id="valor" name="valor" type="number" min="0" max="100" step="0.01" class="form-control" required>
                    </div>
                    <label for="descricao">Descrição</label>
                    <textarea class="form-control" id="descricao" name="descricao"></textarea>
                    <button type="submit" class="btn btn-outline-info w-100 mt-3"><i class="bi bi-send"></i></button>
                </form>
            </div>
        </div>

        <div class="col-6 row">
            <button id="editar" class="btn btn-outline-info col">Editar</button>
            <a href="{{route('gerar.pdf', ['parametro' => 'itens'])}}" class="btn btn-outline-info col">Exportar itens</a>
        </div>
    </section>
@endsection