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

/**Vide toutes les balises messages alert pour les cacher
 * @author CMO
 * @returns {void}
 */
function hideAllMessage(){
    $('div.message').empty();
}