<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        body {
            text-align: center;
        }

        .styled-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 18px;
            text-align: left;
        }

        .styled-table th, .styled-table td {
            padding: 12px 15px;
        }

        .styled-table thead tr {
            background-color: #2b95eb;
            color: #ffffff;
            text-align: center;
        }

        .styled-table tbody tr {
            border-bottom: 1px solid #dddddd;
            text-align: center;
            user-select: none;
        }

        .styled-table tbody tr:hover {
            background-color: #2b95eb4d !important;
            cursor: pointer;
        }

        .styled-table tbody tr:nth-of-type(even) {
            background-color: #f3f3f3;
        }

        .styled-table tbody tr:last-of-type {
            border-bottom: 2px solid #2b95eb;
        }
    </style>
</head>
<body>
    <h3>Relação de funcionários</h3>
    <table id="tableFuncionarios" class="styled-table">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Cargo</th>
                <th>Regime</th>
                <th>Salário</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($funcionarios as $funcionario)
                <tr>
                    <td>{{$funcionario->nome}}</td>
                    <td>{{$funcionario->cargo}}</td>
                    <td>{{$funcionario->regime}}</td>
                    @if ($funcionario->salario != null)
                        <td>R$ {{number_format($funcionario->salario, 2, ',', '.')}}</td>
                    @else
                        <td>Trabalha na produção.</td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>

    <p>Relatório gerado em {{now()->format('d/m/Y H:i:s')}}</p>
</body>
</html>