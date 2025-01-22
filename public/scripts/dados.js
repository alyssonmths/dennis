$(document).ready(function() {
    let rota = window.location.pathname;

    let labels = ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro']

    $.ajax({
        url: '/dados/calculos',
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(retorno) {
            let ctx = document.getElementById('grafico1')
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Total de pagamentos (R$)',
                        data: retorno,
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

    if (rota == '/estatisticas') {
        $.ajax({
            url: '/dados/funcionarios',
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(retorno) {
                let arrayDatasets = retorno.map(item => ({
                    label: item.nome,
                    data: item.total,
                    borderWidth: 1
                }))

                let ctx = document.getElementById('grafico2')
                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: arrayDatasets
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
    }
})