@push('script')
    <script src="/scripts/dados.js"></script>
@endpush

@extends('layout')

@section('conteudo')
    <section class="d-flex flex-column align-items-center">
        <div class="text-center my-3">
            <h4 class="mb-0">Total de pagamentos</h4>
            <small class="text-secondary">todos os funcionários</small>
        </div>
        <div style="width: 100%; max-width: 700px;">
            <canvas id="grafico1"></canvas>
        </div>

        <div class="text-center my-3">
            <h4 class="mb-0">Total de pagamentos</h4>
            <small class="text-secondary">por funcionário</small>
        </div>
        <div style="width: 100%; max-width: 700px;">
            <canvas id="grafico2"></canvas>
        </div>
    </section>
@endsection