// JavaScript Document
$(function()
{
    (function(){
        var ancienneNotification = sessionStorage.getItem('infoMail') ;
        if (typeof ancienneNotification != "undefined" && ancienneNotification!= null)
        {
            // Récupérer des données depuis sessionStorage
            $('#information').append(ancienneNotification);
            $('.infoMail').toast('show');
            $('#informationToolbox').removeClass('d-none');
            //Supprimer toutes les données de sessionStorage
            sessionStorage.clear();
        }
    })();
    function displayResult(reponse)
    {
        if (reponse.length)
        {
            reponse = reponse.split("|") ;
            var state= reponse[0]; state = state.trim();
            var description = reponse[1] ;  
            var date = new Date() ;
            var mois ="" ; 
            var dateActuelle = 'Le '+date.getDate()+'/'+ (mois = ( date.getMonth()<9 ? '0'+ (date.getMonth()+1) : date.getMonth() + 1)) +'/'+date.getFullYear()+ ' à '+ date.getHours()+'h' +date.getMinutes()+'min'+ date.getSeconds()+'s';
            var toast ='<div class="toast infoSupression" data-autohide="false" role="alert" aria-live="assertive" aria-atomic="true"><div class="toast-header"><strong class="mr-auto">Envoi</strong> <small class="text-muted"><strong>'+dateActuelle+'</strong></small><button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close"><span aria-hidden="true">&times;</span></button> </div> <div class="toast-body">' ;
            var information = $('#information') ;
            if (state==true ||state== false )
            { 
                toast = toast + 'Le compte <strong>' +description +' </strong></div></div> ' ;
                information.append(toast) ;
                information.animate( {scrollTop:1000000},1000 ) ;
                $('#informationToolbox').addClass('d-none'); 
                //Va nous permettre de réafficher les informations précédentes
                var content= "";
                $('.infoSupression').each(function(){
                content += '<div class="toast infoSupression" data-autohide="false" role="alert" aria-live="assertive" aria-atomic="true">'+$(this).html()+'</div> ';
                }) ;
                // Enregistrer des données dans sessionStorage
                sessionStorage.setItem('infoMail', content);                
            }         
        }        
    }    
    $("#formAbout").submit(function(e){ // On sélectionne le formulaire par son identifiant
    e.preventDefault(); // Le navigateur ne peut pas envoyer le formulaire
    var donnees = $(this).serialize(); // On créer une variable content le formulaire sérialisé
    $.ajax({
            url :'pages/traitement.php' ,
            type: 'POST' ,
            data: donnees ,        
            dataType : 'text',
            success: function(data){
                displayResult (data) ;
            }
    });
    var mois ="" , date = new Date();
    var dateActuelle = 'Le '+date.getDate()+'/'+ (mois = ( date.getMonth()<9 ? '0'+ (date.getMonth()+1) : date.getMonth() + 1)) +'/'+date.getFullYear()+ ' à '+ date.getHours()+'h' +date.getMinutes()+'min'+ date.getSeconds()+'s';
    var toast = '<div class="toast infoSupression" data-autohide="false" role="alert" aria-live="assertive" aria-atomic="true"><div class="toast-header"> <strong class="mr-auto">Suppression</strong> <small class="text-muted"><strong>'+dateActuelle+'</strong></small><button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close"><span aria-hidden="true">&times;</span></button> </div> <div class="toast-body"> Envoi du mail en cours</div></div> '  ;
    $('#information').append(toast) ; 
    infoSupression = $('.infoSupression').last() ;
    infoSupression.toast('show');
    $('#informationToolbox').removeClass('d-none');
});
$('#information').draggable(); // Le drag and drop pour les notifications
document.getElementById('enregistrerContenuInformation').addEventListener('click', function(){
//$('#enregistrerContenuInformation').on('click', function(){
    var date = new Date() ;
    var dateActuelle = date.getDate()+'/'+ (mois = ( date.getMonth()<9 ? '0'+ (date.getMonth()+1) : date.getMonth() + 1)) +'/'+date.getFullYear()+ ' à '+ date.getHours()+'h' +date.getMinutes()+'min';
    var dateActuelleName = date.getDate()+'_'+ (mois = ( date.getMonth()<9 ? '0'+ (date.getMonth()+1) : date.getMonth() + 1)) +'_'+date.getFullYear()+ '_'+ date.getHours()+'h' +date.getMinutes()+'min';
    var content =" \
    ***************************************************************************************** \n \
    **      Ce fichier a été autogénéré par la page Administration de ENEAM                ** \n \
    **      Date: "+dateActuelle+"                                                    ** \n \
    **      Contact: +22995718340 , houessoupicasso@yahoo.fr                               **  \n \
    **      AUTEUR                                                                         **  \n \
    ***************************************************************************************** \n \
    *			* \n \
    *			* \n \
    *			* \n \
    *			*		* \n \
    ************				 *********  	 *****       **********    **********  	 	 *******  \n \
    *					*		*				*     *				  *				* 	   **       **  \n \
    *					*		*   		   *       *			  *				*	  **         **  \n \
    *					*		*			  ***********	 **********    **********	 **           ** \n \
    *					*	   	*			 *           *	 *			   *	     	 **           ** \n \
    *					*		*			*			  *	 *             *			  **         ** \n \
    *					*		 *********	***************  **********    **********       ********* \n \
    \n \
    \n \
    **********************************************************************************\n";
    var filename = "Resume_eneam.da_"+dateActuelleName+".txt";
    var contentenuDebut= content ;
    var i=0 ;
    $('.infoSupression').each(function(){
        content += ' Opération '+ (i++)+' : '+ $(this).text()+'\n\n' ;
    }) ;
    var blob = new Blob([content], {
        type: "text/plain;charset=utf-8"
    });
        saveAs(blob, filename);
        content="";
});
    
$('#viderContenuInformation').on('click', function(){
    $('.infoSupression').remove();  
    $('#informationToolbox').addClass('d-none');
});
// A tenir compte pour les filtres    
});

