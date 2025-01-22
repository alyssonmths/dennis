$(document).ready(function () {
    
    $('select#regime').after(`
        <label for="salario">Salário</label>
        <div class="input-group">
            <span class="input-group-text">R$</span>
            <input id="salario" name="salario" type="number" class="form-control">
        </div>
    `)

    $('select#regime').change(function () {
        $(this).siblings('label[for="salario"]').remove()
        $(this).siblings('div.input-group').remove()
        if ($(this).val() == 'Diarista') {
            $(this).after(`
                    <label for="salario">Salário</label>
                    <div class="input-group">
                        <span class="input-group-text">R$</span>
                        <input id="salario" name="salario" type="number" class="form-control">
                    </div>
                `)
        }
    })

    $('button#editar').click(function () {
        $('#alert').remove()
        $('section#funcionarios').before(`
            <div id="alert" class="alert alert-warning mx-auto mt-3" role="alert">
                <h6>Clique no funcionário que deseja editar</h6>
                <a href="/funcionarios" class="btn btn-outline-warning w-100">Cancelar</a>
            </div>`)
    
        $('.card').on('mouseenter', function() {
            $(this).addClass('hoverEditar')
        })
    
        $('.card').on('mouseleave', function() {
            $(this).removeClass('hoverEditar')
        })
    
        $('.card').click(function () {
            let id_funcionario = $(this).attr('id')
            $.ajax({
                url: '/funcionario/retornar',
                type: 'POST',
                data: {
                    id: id_funcionario
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (funcionario) {
                    let offcanvasEditar = new bootstrap.Offcanvas($('#offcanvasEditar'))
                    offcanvasEditar.show();

                    console.log(funcionario)

                    let offcanvas = $('#offcanvasEditar')

                    offcanvas.find('input[name="id"]').val(funcionario['id'])
                    offcanvas.find('input#nome').val(funcionario['nome'])
                    offcanvas.find('input#cargo').val(funcionario['cargo'])
                    offcanvas.find('select#regime').val(funcionario['regime'])
                    if (funcionario['salario']) {
                        offcanvas.find('input#salario').val(funcionario['salario'])
                    }
                }
            })
        })
    })

    let idToDelete;

    $('button#apagarFuncionario').click(function(event) {
        event.stopPropagation()
        idToDelete = $(this).closest('.card').attr('id');

        $('#confirmModal').modal('show')
    })

    $('#confirmDelete').click(function() {
        if (idToDelete) {
            window.location.href = `/funcionario/apagar/${idToDelete}`
        }
    })

    $('.card').click(function () {
        let id = $(this).attr('id')
        window.location.href = `/calculos/funcionario/${id}`
    })
})