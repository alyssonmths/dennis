@extends('layout')
@push('css')
    <link rel="stylesheet" href="css/funcionarios.css">
@endpush
@push('script')
    <script src="/scripts/funcionarios.js"></script>
@endpush

@section('conteudo')
    
    @if (session('mensagem'))
        <div class="alert alert-success text-center w-25 mt-3 mx-auto" role="alert">
            {{session('mensagem')}}
            <button type="button" class="btn-close ms-2" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <section id="funcionarios" class="m-3 row justify-content-center gap-3">

        @foreach ($funcionarios as $funcionario)
            <div id="{{$funcionario['id']}}" class="card p-3 d-flex justify-content-center col-10 col-sm-5">
                <div class="row align-items-center g-0">
                    <div class="d-flex justify-content-center col-md-6">
                        <img src="images/{{$funcionario['imagem']}}">
                    </div>
                    <div class="col-md-6">
                        <div class="card-body text-center">
                            <h5 id="nome" class="card-title">{{$funcionario['nome']}}</h5>
                            <p class="card-text"><strong><i class="bi bi-file-earmark-person"></i> Cargo:</strong> {{$funcionario['cargo']}}</p>
                            <p id="regime" class="card-text"><strong>Regime:</strong> {{$funcionario['regime']}}</p>
                            @if ($funcionario['salario'] != null)
                                <p class="card-text"><strong>Diária: </strong>R$ {{$funcionario['salario']/20}}</p>
                                <p class="card-text">
                                    <strong><i class="bi bi-cash"></i> Salário: </strong>R$ {{$funcionario['salario']}} <small>(mensal)</small>
                                </p>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- <a id="apagarFuncionario" href="{{route('funcionario.apagar', ['id' => $funcionario['id']])}}" title="Apagar" class="btn btn-outline-danger me-2"><i class="bi bi-person-x"></i></a> --}}

                <button id="apagarFuncionario" title="Apagar" class="btn btn-outline-danger me-2"><i class="bi bi-person-x"></i></button>
            </div>
        @endforeach

        <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmModalLabel">Confirmar ação</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Tem certeza que deseja apagar este funcionário?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-danger" id="confirmDelete">Apagar</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center gap-3">
            <button class="btn btn-outline-info col-6 col-sm col-lg-3" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasAdicionar">Adicionar funcionário</button>
            <button id="editar" class="btn btn-outline-info col-6 col-sm col-lg-3" type="button">Editar funcionário</button>
            {{-- <button id="editar" class="btn btn-outline-info col-6 col-sm col-lg-3" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasEditar">Editar funcionário</button> --}}
            <a href="{{route('gerar.pdf', ['parametro' => 'funcionarios'])}}" class="btn btn-outline-info col col-sm col-lg-3">Exportar funcionários</a>
        </div>

        {{-- Offcanvas adicionar --}}

        <div class="offcanvas offcanvas-top" tabindex="-1" id="offcanvasAdicionar" aria-labelledby="offcanvasBottomLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasBottomLabel">Adicionar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body small">
                <form action="{{route('funcionario.registrar')}}" method="POST">
                    @csrf
                    <label for="nome">Nome</label>
                    <input id="nome" name="nome" type="text" class="form-control" required>
                    <label for="cargo">Cargo</label>
                    <input id="cargo" name="cargo" type="text" class="form-control" required>
                    <label for="regime">Regime</label>
                    <select name="regime" id="regime" class="form-select">
                        <option value="Diarista">Diarista</option>
                        <option value="Produção">Produção</option>
                    </select>
                    {{-- <label for="salario">Salário</label>
                    <div class="input-group">
                        <span class="input-group-text">R$</span>
                        <input id="salario" name="salario" type="number" class="form-control">
                    </div> --}}
                    <label for="imagem">Imagem</label>
                    <input type="file" name="imagem" id="imagem" class="form-control">
                    <button type="submit" class="btn btn-outline-info w-100 mt-3"><i class="bi bi-send"></i></button>
                </form>
            </div>
        </div>

        {{-- Offcanvas editar --}}

        <div class="offcanvas offcanvas-top" tabindex="-1" id="offcanvasEditar" aria-labelledby="offcanvasBottomLabel">
            <div class="offcanvas-header d-flex justify-content-between">
                <h5 class="offcanvas-title" id="offcanvasBottomLabel">Editar</h5>
                <div>
                    {{-- <a href="{{route('funcionario.apagar')}}" title="Apagar" class="btn btn-outline-danger me-2"><i class="bi bi-person-x"></i></a> --}}
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
            </div>
            <div class="offcanvas-body small">
                <form action="{{route('funcionario.atualizar')}}" method="POST">
                    @csrf
                    <input type="hidden" name="id">
                    <label for="nome">Nome</label>
                    <input id="nome" name="nome" type="text" class="form-control" required>
                    <label for="cargo">Cargo</label>
                    <input id="cargo" name="cargo" type="text" class="form-control" required>
                    <label for="regime">Regime</label>
                    <select name="regime" id="regime" class="form-select">
                        <option value="Diarista">Diarista</option>
                        <option value="Produção">Produção</option>
                    </select>
                    {{-- <label for="salario">Salário</label>
                    <div class="input-group">
                        <span class="input-group-text">R$</span>
                        <input id="salario" name="salario" type="number" class="form-control">
                    </div> --}}
                    <label for="imagem">Imagem</label>
                    <input type="file" name="imagem" id="imagem" class="form-control">
                    <button type="submit" class="btn btn-outline-info w-100 mt-3"><i class="bi bi-send"></i></button>
                </form>
            </div>
        </div>
    </section>
@endsection