$(document).ready(function() {
    let soma_pagamentos = 0
    let id = window.location.pathname.split('/')[3]
    let labels = ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro']

    $.ajax({
        url: `/dados/funcionario/${id}`,
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(retorno) {
            
            Object.values(retorno.total).forEach(valor => {
                soma_pagamentos += valor
            })
            const valoresDiferentesDeZero = Object.values(retorno.total).filter(valor => valor !== 0);
            const quantidadeDiferentesDeZero = valoresDiferentesDeZero.length;
            let media_salarial = soma_pagamentos/quantidadeDiferentesDeZero
            $('#media_salarial').append(media_salarial.toFixed(2).replace('.', ','))

            let ctx = document.getElementById('grafico1')
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Total de pagamentos (R$)',
                        data: retorno.total,
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: value => `R$${value}`
                            }
                        }
                    }
                }
            });
        }
    })
})