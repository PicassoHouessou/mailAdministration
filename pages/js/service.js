$(function()
{
    function sendDetail( commande, objet , supplement )
    {
        $.post()
        {
            'pages/traitement.php' ,
            {
                objet : commande
            },
            function(data){
                displayResult (data)
            },
            'text'
        }
    }
    function displayResult(reponse)
    {
        if (reponse.length)
        {
            reponse = reponse.split("|") ;
            var serviceType= reponse[1] ;
            var serviceState = reponse[2] ;
            var serviceX = $('#'+serviceType+'Status');
            if (serviceType=="all")
            {
                var tableauStatus = {
                    apache2Status : 'apache2Status',
                    phpfpmStatus :'phpfpmStatus', 
                    nginxStatus : 'nginxStatus',
                    postfixStatus : 'postfixStatus' ,
                    dovecotStatus : 'dovecotStatus'    
                } ;
                if (serviceState=='restart')
                {
                    for ( var i in tableauStatus)
                    {
                        $('#'+i).attr({
                            class:'fas fa-check fa-lg' ,
                            style: 'cursor: pointer; color: blue;',
                            title: 'Actif'                            
                        })
                    }
                    var toast = '<div id="infoSupression" class="toast" data-autohide="false" role="alert" aria-live="assertive" aria-atomic="true"><div class="toast-header"> <img src="..." class="rounded mr-2" alt="..."> <strong class="mr-auto">Suppression</strong> <small class="text-muted">Maintenant</small><button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close"><span aria-hidden="true">&times;</span></button> </div> <div class="toast-body">Tous les services ont bien rédémarré </div></div> ';
                    $('#information').html(toast) ;
                    $('#infoSupression').toast('show');
                }
                else if ( serviceState=='erreur')
                {
                    for ( var i in tableauStatus)
                    {
                        $('#'+i).attr({
                            class:'fas fa-check fa-lg' ,
                            style: 'cursor: pointer; color: red;',
                            title: 'Inconnu ou erreur'                            
                        })
                    }
                    var toast = '<div id="infoSupression" class="toast" data-autohide="false" role="alert" aria-live="assertive" aria-atomic="true"><div class="toast-header"> <img src="..." class="rounded mr-2" alt="..."> <strong class="mr-auto">Suppression</strong> <small class="text-muted">Maintenant</small><button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close"><span aria-hidden="true">&times;</span></button> </div> <div class="toast-body"><p>Une erreur est survenir.Les services n\'ont pas pu rédémarré. veuillez reessayez. Si le problème persiste contactez l\'administrateur</p><p>Code d\'erreur :<strong>XALL0001</strong></p></div></div> ';
                    $('#information').html(toast) ;
                    $('#infoSupression').toast('show');
                    
                }
                
            } else 
            {
                if (serviceState=='restart')
                {
                    serviceX.attr ({
                        class:'fas fa-check fa-lg' ,
                        style: 'cursor: pointer; color: blue;',
                        title: 'Actif'
                    }) ;
                }
                else if (serviceState=='stop')
                {
                    serviceX.attr ({
                        class:'fas fa-stop-circle fa-lg' ,
                        style: 'cursor: pointer; color: red;',
                        title: 'Inactif'
                    }) ;                 
                }
                else if(serviceState=='erreur')
                {
                    serviceX.attr ({
                        class:'fas fa-check fa-lg' ,
                        style: 'cursor: pointer; color: red;',
                        title: 'Inconnu ou erreur'
                    })  ;           
                }
                else //if(serviceState=='unknown')
                {
                    serviceX.attr ({
                        class:'fas fa-check fa-lg' ,
                        style: 'cursor: pointer; color: red;',
                        title: 'Inconnu'
                    })  ;           
                }
            }
            
        }        
    }
    // On définit la fonction qui s'appelle toutes les 20 secondes pour actuliser les infos
    function verifierEtat(tab)
    {
        setTimeout(function(){
            for (var i in tab )
            {
                sendDetail("status", i ) ;
            }            
             verifierEtat(tab) ;            
        }, 150000) ;       
    }    
    var tableau = {
        apache2 : 'apache2',
        phpfpm :'phpfpm', 
        nginx : 'nginx',
        postfix : 'postfix' ,
        dovecot : 'dovecot'    
    } ;
    verifierEtat(tableau);
    var tabStart= new Array(5), tabStop = new Array(5);
    for (var i in tableau) 
    {
        tabStart[i] = $('#'+i+'Start');        
        tabStart[i].on('click', function(){sendDetail("restart", i, i+'Start') ;}); 
        //On ne doit en aucun cas arreter les services web 
        if ( i!= "apache2" && i!= "nginx" && i != "phpfpm" )
        {
            tabStop[i] = $('#'+i+'Stop');
            tabStop[i].on('click', function(){ sendDetail("stop",i, "" ) ; });            
        }                
    }
    
    var demarrerTous = $('#all') ;    
    demarrerTous.on('click',function()
    {
        var toast = '<!-- <div style="position: absolute; top: 0; right: 0; min-width:200px;"> --><div id="infoSupression" class="toast" data-autohide="false" role="alert" aria-live="assertive" aria-atomic="true"><div class="toast-header"> <img src="..." class="rounded mr-2" alt="..."> <strong class="mr-auto">Suppression</strong> <small class="text-muted">Maintenant</small><button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close"><span aria-hidden="true">&times;</span></button> </div> <div class="toast-body">Tous les services sont en cours de rédémarrage. Veuillez patienter pendant l\'exécution de l\'opération</div><!--</div>--></div> ';
        $('#confirmation').modal('show') ;
        $('#buttonConfirm').click( function(){ $('#confirmation').modal('hide') ; sendDetail("restart", "all"); $('#information').html(toast) ; $('#infoSupression').toast('show');});
    });   
});
