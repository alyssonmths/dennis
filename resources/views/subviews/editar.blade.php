@extends('layout')
@push('css')
    <link rel="stylesheet" href="/css/editar_item.css">
@endpush

@section('conteudo')
    <section>
        <h3>Editar item</h3>
        <form action="{{route('item.update')}}" method="POST">
            @csrf
            <input type="hidden" name="id" value="{{$item['id']}}">
            <label for="nome">Nome</label>
            <input id="nome" name="nome" value="{{$item['nome']}}" type="text" class="form-control" required>
            <label for="valor">Valor</label>
            <div class="input-group mb-2">
                <span class="input-group-text">R$</span>
                <input id="valor" name="valor" value="{{$item['valor']}}" type="number" min="0" max="100" step="0.01" class="form-control" required>
            </div>
            <label for="descricao">Descrição</label>
            <textarea class="form-control" id="descricao" name="descricao">{{$item['descricao']}}</textarea>
            <label for="checkbox" class="mt-1">Favoritar</label>
            <div>
                <label for="sim">Sim</label>
                <input type="radio" id="sim" name="favoritado" value="1">
                <label for="nao">Não</label>
                <input type="radio" id="nao" name="favoritado" value="0">
            </div>
            <button type="submit" class="btn btn-outline-info w-100 mt-3"><i class="bi bi-send"></i></button>
        </form>
    </section>
@endsection