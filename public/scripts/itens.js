$('button#remover').click(function () {
    $('#alert').remove()
    $('section#precos').prepend(`
        <div id="alert" class="alert alert-warning" role="alert">
            <h6>Clique no item que deseja remover</h6>
            <a href="/precos" class="btn btn-outline-warning w-100">Cancelar</a>
        </div>`)

    let tr = '.styled-table tbody tr'

    $(tr).on('mouseenter', function() {
        $(this).addClass('hoverApagar')
    })

    $(tr).on('mouseleave', function() {
        $(this).removeClass('hoverApagar')
    })

    $(tr).click(function () {
        id_item = $(this).attr('id')
        $.ajax({
            url: '/item/apagar',
            type: 'POST',
            data: {
                id_item: id_item
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function() {
                window.location.reload();
            }
        })
    })
})

$('button#editar').click(function () {
    $('#alert').remove()
    $('section#precos').prepend(`
        <div id="alert" class="alert alert-warning" role="alert">
            <h6>Clique no item que deseja editar</h6>
            <a href="/precos" class="btn btn-outline-warning w-100">Cancelar</a>
        </div>`)

    let tr = '.styled-table tbody tr'

    $(tr).on('mouseenter', function() {
        $(this).addClass('hoverEditar')
    })

    $(tr).on('mouseleave', function() {
        $(this).removeClass('hoverEditar')
    })

    $(tr).click(function () {
        id_item = $(this).attr('id')
        window.location.href = `/item/editar/${id_item}`
    })
})

$(document).ready(function () {
    $valor = window.location.pathname.split('/')[2]
    $('#select').val($valor);

    // new gridjs.Grid({
    //     from: document.getElementById('tabelaOriginal'),
    //     sort: true,
    //     search: true,
    // }).render(document.getElementById('tabela'));

    let table = new DataTable('#tableItems', {
        language: {
        "emptyTable":     "Sem dados na tabela",
        "info":           "Mostrando _START_ a _END_ de _TOTAL_ itens",
        "infoEmpty":      "Mostrando 0 a 0 de 0 registros",
        "infoFiltered":   "(Filtrado de _MAX_ total registros)",
        "lengthMenu":     "Mostrar _MENU_ itens",
        "search":         "Pesquisar: ",
        "zeroRecords":    "Sem registros encontrados",
        "aria": {
            "orderable":  "Ordenar essa coluna",
            "orderableReverse": "Reverter a ordem dessa coluna"
        }
        }
    });
})

$('#select').change(function () {
    $valorSelect = $(this).val()
    window.location.href = `/precos/${$valorSelect}`
})