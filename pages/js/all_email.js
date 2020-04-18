/*
$(window).on('beforeunload', function(){
  return "Do you want to exit this page?";
});
*/
$(function()
{
    (function(){
        var ancienneNotification = sessionStorage.getItem('infoSupression') ;
        if (typeof ancienneNotification != "undefined" && ancienneNotification!= null)
        {
            // Récupérer des données depuis sessionStorage
            $('#information').append(ancienneNotification);
            $('.infoSupression').toast('show');
            $('#informationToolbox').removeClass('d-none');
            //Supprimer toutes les données de sessionStorage
            sessionStorage.clear();
        }
    })();
    function displayResult(reponse)
    {
       
        if (reponse.length)
        {
            reponse = reponse.split("|split|") ;
            var email= reponse[0]; email = email.trim();
            var emailState = reponse[1] ;  
            emailState = emailState.toUpperCase().trim() ; //On met en majuscule et supprime les espaces
            var date = new Date() ;
            var mois ="" ; 
            var dateActuelle = 'Le '+date.getDate()+'/'+ (mois = ( date.getMonth()<9 ? '0'+ (date.getMonth()+1) : date.getMonth() + 1)) +'/'+date.getFullYear()+ ' à '+ date.getHours()+'h' +date.getMinutes()+'min'+ date.getSeconds()+'s';
            var toast ='<div class="toast infoSupression" data-autohide="false" role="alert" aria-live="assertive" aria-atomic="true"><div class="toast-header"><strong class="mr-auto">Suppression</strong> <small class="text-muted"><strong>'+dateActuelle+'</strong></small><button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close"><span aria-hidden="true">&times;</span></button> </div> <div class="toast-body">' ;
            var information = $('#information') ;
            if (emailState=='MAIL_TOGGLE_SUCCESS'|| emailState=='MAIL_TOGGLE_ERROR')
            { 
                var message = (emailState=='MAIL_TOGGLE_SUCCESS' ? "a correctement changé d'état" :  "n'a pas correctement changé d'état. Il a eu une erreur."  ) ;
                toast = toast + 'Le compte <strong>' +email +' </strong>' +message +'</div></div> ' ;
                information.append(toast) ;
                //var infoSupression = $('.infoSupression').last() ;
                //infoSupression.toast('show');
                information.animate( {scrollTop:1000000},1000 ) ;
                $('#informationToolbox').addClass('d-none'); 
                //Va nous permettre de réafficher les informations précédentes
                var content= "";
                $('.infoSupression').each(function(){
                content += '<div class="toast infoSupression" data-autohide="false" role="alert" aria-live="assertive" aria-atomic="true">'+$(this).html()+'</div> ';
                }) ;
                // Enregistrer des données dans sessionStorage
                sessionStorage.setItem('infoSupression', content);
                //On recharge la page pour que php puisse enlever le mail déja supprimé
                document.location.reload();
            } 
            //Lors du changement de mot de passe 
            if (emailState=='MAIL_MODIFY_SUCCESS' || emailState=='MAIL_MODIFY_ERROR')
            { 
                var message = ( emailState=='MAIL_MODIFY_SUCCESS' ? "a été correctement changé "  :  "n\'a pas été changé. Il a eu une erreur. Vérifier que le mot de passe contient 8 caractères, une minuscule , une majuscule, un chiffre." );
                toast = toast + 'Le mot de passe du compte <strong>' +email +' </strong>' +message +'</div></div> ' ;
                information.append(toast) ;
                information.animate( {scrollTop:1000000},1000 ) ;
                $('#informationToolbox').addClass('d-none'); 
                //Va nous permettre de réafficher les informations précédentes
                var content= "";
                $('.infoSupression').each(function(){
                content += '<div class="toast infoSupression" data-autohide="false" role="alert" aria-live="assertive" aria-atomic="true">'+$(this).html()+'</div> ';
                }) ;             
                // Enregistrer des données dans sessionStorage
                sessionStorage.setItem('infoSupression', content);
                //On recharge la page pour que php puisse enlever le mail déja supprimé
                document.location.reload();  
            } 
            
            if (emailState=='MAIL_DELETE_SUCCESS')
            { 
                toast = toast + 'Le compte <strong>' +email +' </strong> a été correctement supprimé</div></div> ' ;
                information.append(toast) ;
                //var infoSupression = $('.infoSupression').last() ;
                //infoSupression.toast('show');
                information.animate( {scrollTop:1000000},1000 ) ;
                $('#informationToolbox').addClass('d-none'); 
                //Va nous permettre de réafficher les informations précédentes
                var content= "";
                $('.infoSupression').each(function(){
                content += '<div class="toast infoSupression" data-autohide="false" role="alert" aria-live="assertive" aria-atomic="true">'+$(this).html()+'</div> ';
                }) ;
                // Enregistrer des données dans sessionStorage
                sessionStorage.setItem('infoSupression', content);
                //On recharge la page pour que php puisse enlever le mail déja supprimé
                document.location.reload();
            }
            else if (emailState=='MAIL_DELETE_SUCCESS_BUT_DIRECTORY_DELETE_NOT_SUCESS')
            {
                toast = toast + 'Le compte <strong>' +email +' </strong> a été supprimé. Seulement le répertoire courant du compte n\'a pu etre supprimé du serveur. Procédure à suivre : Ne rien faire sinon m\'envoyer un mail  en cliquant sur <a href="mailto: houessoupicasso@yahoo.fr ?subject=eneam.da: MAIL_DELETE_SUCCESS_BUT_DIRECTORY_DELETE_NOT_SUCESS&body=Le compte ' +email +' a été supprimé. Seulement le répertoire courant du compte n\'a pu etre supprimé du serveur."> Picasso Houessou </a>.</div></div> ' ;
                information.append(toast) ; 
                //var infoSupression = $('.infoSupression').last() ;
                //infoSupression.toast('show');
                information.animate( {scrollTop:1000000},1000 ) ;
                $('#informationToolbox').addClass('d-none'); 
                //Va nous permettre de réafficher les informations précédentes
                var content= "";
                $('.infoSupression').each(function(){
                content += '<div class="toast infoSupression" data-autohide="false" role="alert" aria-live="assertive" aria-atomic="true">'+$(this).html()+'</div> ';
                }) ;
                // Enregistrer des données dans sessionStorage
                sessionStorage.setItem('infoSupression', content);
                //On recharge la page pour que php puisse enlever le mail déja supprimé
                document.location.reload();
            }
            else if(emailState=='MAIL_DELETE_ERROR')
            {
                toast = toast + 'Désolé nous avons rencontré un problème dans la suppresion du compte <strong>'+email+'. </strong> Contactez l\'administrateur ou le programmeur en cliquant sur <a href="mailto: houessoupicasso@yahoo.fr ?subject=eneam.da: MAIL_DELETE_ERROR&body=Le compte ' +email +' n\'a pas pu être supprimé. "> Picasso Houessou </a>.</div> </div> ' ;
                information.append(toast) ;
                var infoSupression = $('.infoSupression').last() ;
                infoSupression.toast('show');
                information.animate({scrollTop:100000},1000) ;
                $('#informationToolbox').removeClass('d-none');
                
            }            
        }        
    }    
	//Pour supprimer un compte
    var supprime= $('.supprime') ;   
    //var mail = $('.mail') ;
    supprime.on('click',function()
    {
        var compteID = $(this).attr('id'), paren = $(this).offsetParent() ,  intermediaire =  paren.find('[href]');
        compteID = encodeURIComponent(compteID) ;  // a ne pas mettre pour le email sinon erreur    
        var compteEmail =  intermediaire.attr('href').split('mailto:') [1]; 
        
        $('#modalConfirmationId').html('<p class="text-justify">Etes vous sur de vouloir supprimer le compte <strong><a href="mailto:'+compteEmail+'">'+compteEmail+'<a>.</strong> Cette opération est irréversible et implique la suppression pure et simple du compte y compris toutes les données qui lui sont associées.</p>' ) ;
        $('#confirmation').modal('show') ;
        $('#buttonConfirm').click( function(e){
            e.preventDefault();
            $('#confirmation').modal('hide') ;            
            $.post(  
                'pages/traitement.php' ,
                {
                    id : compteID,
                    email :  compteEmail                    
                },
                function(data){
                    displayResult (data) ;
                },
                'text'
            );
            var mois ="" , date = new Date();
            var dateActuelle = 'Le '+date.getDate()+'/'+ (mois = ( date.getMonth()<9 ? '0'+ (date.getMonth()+1) : date.getMonth() + 1)) +'/'+date.getFullYear()+ ' à '+ date.getHours()+'h' +date.getMinutes()+'min'+ date.getSeconds()+'s';
            var toast = '<div class="toast infoSupression" data-autohide="false" role="alert" aria-live="assertive" aria-atomic="true"><div class="toast-header"> <strong class="mr-auto">Suppression</strong> <small class="text-muted"><strong>'+dateActuelle+'</strong></small><button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close"><span aria-hidden="true">&times;</span></button> </div> <div class="toast-body">La suppression du compte<strong> ' +compteEmail+' </strong>a commencé. Opération en cours d\'exécution</div></div> '  ;
            $('#information').append(toast) ; 
            infoSupression = $('.infoSupression').last() ;
            infoSupression.toast('show');
            $('#informationToolbox').removeClass('d-none');
            //A la fin on supprime cet evenement
            $(this).off('click');
        }); 
        
        //On annule tous les évènements unitiles C'est très important sinon causes des bugs lors de la prochaine requetes
        $('#confirmation').on('hidden.bs.modal', function (e){
            $('#buttonConfirm').off('click');
            $('#buttonAnnuler').off('click');
            $(this).off('hidden.bs.modal');
        });
        
        /*
            function changerInfoTime()
    {
        setTimeout(function(){
        var champTemps = $(this).find('[class="text-muted"]');
        var tempsPasse = champTemps.text();
        tempsPasse= tempsPasse.split (" ") ;
        if (tempsPasse[0]=="Maintenant")
        {
            var date = new Date () ;
            champTemps.text("Il y'a "+date) ;
        }
        else if (tempsPasse[0] =="Il" && tempsPasse[1 ] == "y'a")
        {
            var date = new Date () ;
            timeEcoule = date - tempsPasse[2] ;
            champTemps.text("Il y'a "+tempsPasse+timeEcoule) ;
        }
    },5000) ;
    }
        */
    });  
	
    // Pour désactiver un compte 
    var desactiveCompte =$('.desactiveCompte');
    desactiveCompte.on('click', function(){
        paren = $(this).offsetParent() ,  intermediaire =  paren.find('[href]');   
        var compteEmail =  intermediaire.attr('href').split('mailto:') [1];  
        $.post(  
            'pages/traitement.php' ,
            {
                
                email :  compteEmail  ,   
                toggleCompteState : 'toggleCompteState'              
            },
            function(data){
                displayResult (data) ;
            },
            'text'
        );

    }) ;
	
	//Pour éditer un compte 
	var editerCompte = $('.editerCompte') ;
	editerCompte.on('click', function (){
		var paren = $(this).offsetParent() ,  intermediaire =  paren.find('[href]');      
        var compteEmail =  intermediaire.attr('href').split('mailto:') [1]; 
              
		var modifierCompteModal = $('#modifierCompte') ;
		$('#emailToModify').attr('value', compteEmail) ;
		$('#modifierCompte').modal('show');
		$('#buttonConfirmCompteModify').click( function(e){
            e.preventDefault();            
            var password = $('#newPasswordUser').val() ; 
            var passwordConfirm = $('#newPasswordUserConfirm').val() ; 	
            $('#modifierCompte').modal('hide') ;		
            $.post(  
                'pages/traitement.php' ,
                {
                    email :  compteEmail , 
                    newPassword :  password,
                    newPasswordConfirm : passwordConfirm
                },
                function(data){
                    displayResult (data) ;
                },
                'text'
            );
			
		});
		
		//On annule tous les évènements unitiles C'est très important sinon causes des bugs lors de la prochaine requetes
        $('#modifierCompte').on('hidden.bs.modal', function (e){
            $('#modifierUser')[0].reset();
            /*
            $('#buttonConfirmCompteModify').off('click');
            //$('#buttonAnnuler').off('click');
            $(this).off('hidden.bs.modal');
            */
        });
        
		
	}) ;
	
	
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
    $('.boutonFiltre').on('click', function(){
        if ($(this).hasClass('bg-success'))
        {
            $(this).removeClass('bg-success') ;
            window.location.replace('index.php?page=all_email&tri=none') ;
            //window.location.replace('index.php?page=home');
        }
    }) ;
    
});

