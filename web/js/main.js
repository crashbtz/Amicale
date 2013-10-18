$(document).ready(function() {
    initMainMenu();
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