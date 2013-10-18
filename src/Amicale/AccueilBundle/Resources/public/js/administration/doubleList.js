$(document).ready(function() {
    initFlechesDoubleList();
    initSubmit();
});

function initSubmit(){
    $('#submit').on('click', function(){
        var params = '';
        $('#choisit option').each(function() {
            params += '&commercant'+$(this).val()+'='+$(this).val();
        });
        params = $('form').serialize()+params;
        var url = $(this).attr('data-url');
        if($(this).attr('data-id')){
            params += '&id='+$(this).attr('data-id');
        }

        $.post(url,
            { params: params},
            function(data){
                document.location = data;
            }
        );
    });
}

function initFlechesDoubleList() {
    $('#fleche_droite').on('click', function() {
        $('#achoisir option:selected').each(function() {
            $('#choisit').append($(this));
        });
        $('#choisit option').sort(NASort).appendTo('#choisit')
    });

    $('#fleche_gauche').on('click', function() {
        $('#choisit option:selected').each(function() {
            $('#achoisir').append($(this));
        });
        $('#achoisir option').sort(NASort).appendTo('#achoisir')
    });
}

/**
 * trie les option d'un select par ordre alphabétique
 * @param {option} a
 * @param {option} b
 * @returns {Number}
 */
function NASort(a, b) {
    return (a.innerHTML > b.innerHTML) ? 1 : -1;
}