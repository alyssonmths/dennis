$(document).ready(function () {
    $('#precos .card-body').click(function () {
        $('#detalhes').not($(this).find('#detalhes')).remove()
        
        let id_item = $(this).closest('div.card').attr('id')
        let csrfToken = $('meta[name="csrf-token"]').attr('content')

        if ($(this).find('#detalhes').length == 0) {
            $(this).append(
                `<div id="detalhes" class="d-flex flex-column align-items-center">
                    <form action="/calculos/registrarCarrinho" method="POST">
                        <input type="hidden" name="_token" value="${csrfToken}">
                        <input type="hidden" name="id_item" value="${id_item}">
                        <label for="quantidade"><strong>Quantidade:</strong> </label>
                        <input id="quantidade" name="quantidade" type="number" class="form-control w-50">
                        <button type="submit" id="adicionar" class="mt-3 btn btn-outline-info">Adicionar</button>
                    </form>
                </div>`
            )
        }
    })

    setTimeout(() => {
        $('div.alert.alert-success').remove()
    }, 3000);

    $('input#quantidade').change(function () {
        $.ajax({
            url: '/calculos/atualizar',
            type: 'POST',
            data: {
                hash: $(this).siblings('input#hash').val(),
                quantidade: $(this).val()
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function () {
                window.location.reload();
            }
        })
    })
})