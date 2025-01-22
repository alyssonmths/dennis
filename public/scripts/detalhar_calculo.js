$(document).ready(function () {
    $('tbody tr').click(function () {
        let id_calculo = $(this).attr('id')
        window.location.href = `/calculos/listar/${id_calculo}`
    })

    let table = new DataTable('#tableCalculos', {
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
    })
})