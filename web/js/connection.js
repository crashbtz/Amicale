/**
 * initialisation du modal de connection
 * @author CMO
 * @returns {void}
 */
function initConnection(){
    $('body').delegate('.open_modal_connexion', 'click', function(){
        showConnectionModal();
        hideAllMessage();
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

/**
 * show le modal de connection
 * @author CMO
 * @returns {void}
 */
function showConnectionModal(){
    $('#connexion_modal').modal('show');
}

/**
 * requete ajax qui retourne si le user est connecté 
 * @author CMO
 * @returns {Boolean}
 */
function isConnected(){
    var url = $('#is_connected').val();
    var is_connected = false;
    $.ajax({
        url: url,
        async: false,
        success: function(data) {
            if(data === 'true'){
                is_connected = true;
            }
        }
    });
    return is_connected;
}