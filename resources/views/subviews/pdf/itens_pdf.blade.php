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
    <h3>Relação de itens</h3>
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
    <p>Relatório gerado em {{now()->format('d/m/Y H:i:s')}}</p>
</body>
</html>