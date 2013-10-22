$(document).ready(function() {
    //methode définit dans js principal /web/js/main.js
    //permet de griser le menu choisit dans le menu horizontal
    initMainMenu('produits');
    initMenuCategorie();
    initFiltrer();
    initAjoutPanier();
});

/**
 * permet de griser le menu catégorie sélectionné
 * @returns {void}
 */
function initMenuCategorie(){
    var id = $('#filtrer').attr('data-idcategorie');
    $('#menu_produit li a[data-id="'+id+'"]').closest('li').addClass('active');
}

/**
 * initialisation du bouton filtrer
 * @returns {void}
 */
function initFiltrer(){
    $('#filtrer').unbind('click');
    $('#filtrer').on('click', function(){
        //reset des erreurs éventuelles qui auraient pu être déclenchées sur un 1er clic
        resetErrors('#prix');
        
        //récupere les valeurs
        var multiselect = $('#typeproduit').val();
        var values_typeproduits = '';
        for (var i in multiselect){
            if(values_typeproduits !== ''){
                values_typeproduits += '*'+multiselect[i];
            }
            else{
                values_typeproduits = multiselect[i];
            }
        }
        var min = $('#min').val();
        var max = $('#max').val();
        
        //vérification des valeurs rentrées
        var is_errors = false;
        if(!is_int(min) || min.length < 1){
            $('#prix div.min').addClass('error');
            $('#prix p.min').text('min n\'est un nombre.');
            is_errors = true;
        }
        if(!is_int(max) || max.length < 1){
            $('#prix div.max').addClass('error');
            $('#prix p.max').text('max n\'est un nombre.');
            is_errors = true;
        }
        if(is_int(min) && is_int(max) && parseInt(min) > parseInt(max)){
            $('#prix div.min').addClass('error');
            $('#prix div.max').addClass('error');
            $('#prix p.min').text('min doit être inférieur ou égal à max');
            is_errors = true;
        }
        
        //si il n'y a pas d'erreurs
        if(!is_errors){
            var url = $(this).attr('data-url');
            var id = $(this).attr('data-idcategorie');
            $.post(url,
                { typeproduits: values_typeproduits, min: min, max: max, id: id},
                function(data){
                    if(data.length > 0 && data !== 'error'){
                        $('#content_produit').html(data);
                    }
                    else if(data.length === 0){
                        $('#content_produit').html('Aucun produit ne correspond à ces critères.');
                    }
                    else{
                        $('#content_produit').html('Une erreur est survenue.');
                        $('#prix p.min').text('Une erreur est survenue.');
                    }
                    initAjoutPanier();
                }
            );
        }
        //alert(values_typeproduits+" - "+min+" - "+max);
    });
}

/**
 * retourne si chaine est un nombre
 * @param {type} value
 * @returns {Boolean}
 */
function is_int(value){ 
  if((parseFloat(value) == parseInt(value)) && !isNaN(value)){
      return true;
  } else { 
      return false;
  } 
}

function resetErrors(div){
    $(div+' div.error').removeClass('error');
    $(div+' p.help-inline').text('');
}

function initAjoutPanier(){
    setModal();
    ajouter();
}

function setModal(){
    $('#content_produit img.panier').unbind('click');
    $('#content_produit img.panier').on('click', function(){
        var produit = $(this).closest('span').attr('title');
        id_produit = $(this).attr('data-id_produit');
        resetErrors('#ajout_panier');
        $('#ajout_panier div.modal-body p.message').text('Créer une commade pour le produit '+produit);
        $('#quantite').val('');
        $('#ajout_panier').modal('show');
    });
}

function ajouter(){
    $('#ajouter').unbind('click');
    $('#ajouter').on('click', function(){
        var quantite = $('#quantite').val();
        if(!is_int(quantite) || quantite === '0'){
            $('#ajout_panier div.quantite').addClass('error');
            $('#ajout_panier p.quantite').text('La quantité doit être un nombre supérieur à zéro.');
        }
        else{
            var url = $(this).attr('data-url');
            $.post(url,
                { url: url, id_produit: id_produit, quantite: quantite},
                function(data){
                    $('#ajout_panier').modal('hide');
                }
            );
        }        
    });
}