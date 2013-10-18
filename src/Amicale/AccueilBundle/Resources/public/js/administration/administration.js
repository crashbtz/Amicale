$(document).ready(function() {
    initRetourListe();
    initEdit();
    initModalSuppression();
    initMainMenu('administration');
});

function initRetourListe() {
    $('div.well form input.retour').unbind('click');
    $('div.well form input.retour').on('click', function() {
        url = $(this).attr('data-url');
        if (url !== '') {
            document.location = url;
        }
    });
}

function initEdit() {
    var url = '';
    $('table tbody td a.edit').unbind('click');
    $('table tbody td a.edit').on('click', function(e) {
        e.preventDefault();
        url = $(this).attr('data-url');
        document.location = url;
    });
}

function initModalSuppression() {
    var url = '';
    $('table tbody td a.delete').unbind('click');
    $('table tbody td a.delete').on('click', function(e) {
        e.preventDefault();
        url = $(this).attr('data-url');
        $('#modal-confirm').modal('show');
    });

    $('#modal-confirm #delete').unbind('click');
    $('#modal-confirm #delete').on('click', function() {
        if (url !== '') {
            document.location = url;
        }
        else {
            $('#modal-confirm').modal('hide');
        }
    });
}
