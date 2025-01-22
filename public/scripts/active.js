$(document).ready(function() {
    let id = window.location.pathname
    idArray = id.split('/')
    if (idArray[1] == '') {
        idArray[1] = 'index'
    }
    $(`#${idArray[1]}`).addClass('active')

    if (idArray[1] == 'calculos') {
        subId = idArray[2]
        $(`#${subId}`).addClass('active')
    }
})