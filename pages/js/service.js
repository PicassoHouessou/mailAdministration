$(function()
{
    function sendDetail( commande, objet)
    {
        commande =commande.trim();
        objet= objet.trim();
        commande = encodeURIComponent(commande);
        objet = encodeURIComponent(objet);
        $.ajax({
            url :'pages/traitement.php' ,
            type: 'POST' ,
            data: objet+'='+commande ,        
            dataType : 'text',
            success: function(data){
                displayResult (data)
            }
        }); 
        /* Je ne sais pas pourquoi avec post ça ne marche pas    
         $.post(
            'pages/traitement.php' ,
            {
                objet : commande,
                cccc:'ddddd'
            },
            function(data){
                displayResult (data) ;
            },
            'text'
            );
        */        
    }
    function displayResult(reponse)
    {  
        if (reponse.length)
        {
            reponse = reponse.split("|") ;
            var serviceType= reponse[0].trim() ;
            var serviceState = reponse[1] ;
            serviceState = serviceState.toUpperCase() ;
            serviceState = serviceState.trim(); 
            if (serviceType=="all")
            {
                var tableauStatus = {
                    apache2Status : 'apache2Status',
                    phpfpmStatus :'phpfpmStatus', 
                    nginxStatus : 'nginxStatus',
                    postfixStatus : 'postfixStatus' ,
                    dovecotStatus : 'dovecotStatus' /*
                    spamassassin: 'spamassassinStatus',
                    vsftpd       : 'vsftpdStatus'   */
                } ; 
                var information = $('#information');
                var date = new Date() , mois ="" ; 
                var dateActuelle = 'Le '+date.getDate()+'/'+ (mois = ( date.getMonth()<9 ? '0'+ (date.getMonth()+1) : date.getMonth() + 1)) +'/'+date.getFullYear()+ ' à '+ date.getHours()+'h' +date.getMinutes()+'min'+ date.getSeconds()+'s';
                if (serviceState=='RESTART')
                {
                    for ( var i in tableauStatus)
                    {
                        $('#'+i).attr({
                            class:'fas fa-check fa-lg' ,
                            style: 'cursor: pointer; color: blue;',
                            title: 'Actif'                            
                        }) ;
                    }
                    var toast = '<div class="toast infoSupression" data-autohide="false" role="alert" aria-live="assertive" aria-atomic="true"><div class="toast-header"><strong class="mr-auto">Suppression</strong> <small class="text-muted"><strong>'+dateActuelle+'</strong></small><button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close"><span aria-hidden="true">&times;</span></button> </div> <div class="toast-body">Tous les services ont bien redémarrés </div></div> ';
                    information.append(toast) ;
                    infoSupression = $('.infoSupression').last() ;
                    infoSupression.toast('show');
                    $('#informationToolbox').removeClass('d-none');  
                    information.animate({scrollTop:1000000},1000) ;
                }
                else if ( serviceState=='ERREUR')
                {
                    for ( var i in tableauStatus)
                    {
                        $('#'+i).attr({
                            class:'fas fa-exclamation-triangle fa-lg' ,
                            style: 'cursor: pointer; color: red;',
                            title: 'Inconnu ou erreur'                             
                        }) ;
                    }
                    var toast = '<div class="toast infoSupression" data-autohide="false" role="alert" aria-live="assertive" aria-atomic="true"><div class="toast-header"><strong class="mr-auto">Suppression</strong> <small class="text-muted"><strong>'+dateActuelle+'</strong></small><button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close"><span aria-hidden="true">&times;</span></button> </div> <div class="toast-body"><p>Une erreur est survenue.Les services n\'ont pas pu redémarrés. veuillez réessayez. Si le problème persiste contactez l\'administrateur</p><p>Code d\'erreur : <strong>XALL0001</strong></p></div></div> ';
                    information.append(toast) ;  
                    infoSupression = $('.infoSupression').last() ;
                    infoSupression.toast('show');
                    $('#informationToolbox').removeClass('d-none');
                    information.animate({scrollTop:1000000},1000) ;                    
                }                
            } 
            else 
            {
                var serviceUniqueEtat = $('#'+serviceType+'Status');
                if (serviceState=='RESTART')
                {
                    serviceUniqueEtat.attr ({
                        class:'fas fa-check fa-lg' ,
                        style: 'cursor: pointer; color: blue;',
                        title: 'Actif'
                    }) ;
                }
                else if (serviceState=='STOP')
                {
                    serviceUniqueEtat.attr ({
                        class:'fas fa-stop-circle fa-lg' ,
                        style: 'cursor: pointer; color: red;',
                        title: 'Inactif'
                    }) ;                 
                }
                else if(serviceState=='ERREUR')
                {
                    serviceUniqueEtat.attr ({
                        class:'fas fa-exclamation-triangle fa-lg' ,
                        style: 'cursor: pointer; color: red;',
                        title: 'Inconnu ou erreur'
                    })  ;           
                }            
            }            
        }        
    }
    // On définit la fonction qui s'appelle toutes les 20 secondes pour actuliser les infos
    function verifierEtat(tab)
    {
        setTimeout(function(){
            /*
            sendDetail("status", "apache2");
            sendDetail("status", "phpfpm");
            sendDetail("status" , "nginx");
            sendDetail("status" , "postfix");
            sendDetail("status" , "dovecot");
            */
            for (var i in tab )
            {
                sendDetail("status",i ) ;
            }         
            verifierEtat(tab) ;            
        }, 10000) ;       
    }    
    var tableau = {
        apache2 : 'apache2',
        phpfpm :'phpfpm', 
        nginx : 'nginx',
        postfix : 'postfix' ,
        dovecot : 'dovecot' /*
        spamassassin: 'spamassassin',
        vsftpd       : 'vsftpd' */
    } ;
    // On lance la fontion d'actualisation
    verifierEtat(tableau);
    for (var i in tableau) 
    {
        switch (i)
        {
            case 'apache2':
                $('#apache2Start').on('click', function(){sendDetail("restart","apache2");}); 
                break;
            case 'phpfpm':
                $('#phpfpmStart').on('click', function(){sendDetail("restart", "phpfpm");});
                break;                
            case 'nginx':
                $('#nginxStart').on('click', function(){sendDetail("restart", "nginx");});
                break;
            case 'postfix':
                $('#postfixStart').on('click', function(){sendDetail("restart","postfix");});
                $('#postfixStop').on('click', function(){sendDetail("stop","postfix");});
                break;
            case 'dovecot':
                $('#dovecotStart').on('click', function(){sendDetail("restart", "dovecot");});
                $('#dovecotStop').on('click', function(){sendDetail("stop","dovecot");});
                break;/*
            case 'spamassassin':
                $('#spamassassinStart').on('click', function(){sendDetail("restart","spamassassin");});
                $('#spamassassinStop').on('click', function(){sendDetail("stop","spamassassin");});
                break;
            case 'vsftpd':
                $('#vsftpdStart').on('click', function(){sendDetail("restart", "vsftpd");});
                $('#vsftpdStop').on('click', function(){sendDetail("stop","vsftpd");});
                break;*/
            default:
                // On a pas besoin d'un break
        } 
    }
        /* Au départ j'utilisais cette fonction ensuite j'ai préféré celle avec switch
        var element = '#'+i+'Start';
        tabStart[i] = $('#'+i+'Start');   
        //tabStart[i] = $(element);

        tabStart[i].on('click', function(){sendDetail("restart", i);alert(tabStart[i].attr('id'));}); 
        //On ne doit en aucun cas arreter les services web 
        if ( i!= "apache2" && i!= "nginx" && i != "phpfpm" )
        {
            tabStop[i] = $('#'+i+'Stop');
            tabStop[i].on('click', function(){ sendDetail("stop",i, "" ) ; });            
        }                 
    }*/
    $('#information').draggable(); // Le drag and drop pour les notifications
    var demarrerTous = $('#all') ;    
    demarrerTous.on('click',function()
    {
        var date = new Date() , mois ="" ; 
        var dateActuelle = 'Le '+date.getDate()+'/'+ (mois = ( date.getMonth()<9 ? '0'+ (date.getMonth()+1) : date.getMonth() + 1)) +'/'+date.getFullYear()+ ' à '+ date.getHours()+'h' +date.getMinutes()+'min'+ date.getSeconds()+'s';
        var toast = '<div class="toast infoSupression" data-autohide="false" role="alert" aria-live="assertive" aria-atomic="true"><div class="toast-header"><strong class="mr-auto">Suppression</strong> <small class="text-muted"><strong>'+dateActuelle+'</strong></small><button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close"><span aria-hidden="true">&times;</span></button> </div> <div class="toast-body">Tous les services sont en cours de redémarrage. Veuillez patienter pendant l\'exécution de l\'opération</div></div> ';
        $('#confirmation').modal('show') ;
        $('#buttonConfirm').click( function(){ 
            $('#confirmation').modal('hide') ; 
            sendDetail("restart","all");
            $('#information').append(toast) ;
            $('#informationToolbox').removeClass('d-none');
            infoSupression = $('.infoSupression').last() ;
            infoSupression.toast('show');
            $('#information').animate({scrollTop:100000},1000) ;
            //A la fin on supprime cet evenement
            $(this).off('click');
        });
        $('#confirmation').on('hidden.bs.modal', function (e){
            $('#buttonConfirm').off('click');
            $('#buttonAnnuler').off('click');
            $(this).off('hidden.bs.modal');
        });
    }); 
    document.getElementById('enregistrerContenuInformation').addEventListener('click', function(){
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
});
