$(document).ready(function() {
    initMainMenu();
    initConnection();    
});

/**
 * initialisation du menu
 * @returns {void}
 */
function initMainMenu($class){
    $('#menu ul.nav li').each(function(){
        $(this).removeClass('active');
    });
    $('#menu ul.nav li.'+$class).addClass('active');
}

function initConnection(){
    $('#open_modal_connexion').on('click', function(){
        $('#connexion_modal').modal('show');
    });
    
    $('#connection').on('submit', function(e) {
        e.preventDefault();
    });
    
    $('#submit').on('click', function(){
        var url = $(this).attr('data-url');
        $.ajax({
            url: url,
            data: $('#connection').serialize(),
            type: ($('#connection').attr('method')),
            success: function(data) {
                if(data !== 'success'){
                    $('#connexion_modal div.modal-body').html(data);
                }
                else{
                    $('#username').text('');
                    $('#connexion_modal').modal('hide');
                    var url = $('#submit').attr('data-url_menuconnection');
                    $.post(url,
                        {},
                        function(data){
                            $('#menu ul.right').html(data);
                        }
                    );
                }
            }
        });
    });
}