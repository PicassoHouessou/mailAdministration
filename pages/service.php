<div class="row">    
    <table class="table table-bordered col-md-12">
        <caption style="caption-side:top; font-size: 2em; ">Tous les services </caption>
        <thead class="table-dark">
            <tr>
                <th>Intitulés</th>
                <th>Descriptions</th>
                <th>Statut</th>
                <th>Démarrer/Redemarrer</th>
                <th>Arreter</th>                
            </tr>
        </thead>
        <tbody>
            <tr id="apache2" class="text-center">
                <td class="font-weight-bold">Apache</td>
                <td>Serveur Web qui héberge les sites</td>
                <td><i class="fas fa-check" style="color: blue;"></i></td>
                <td style=" text-align: center;" data-toggle="tooltip" title="cliquer pour redemarrer" ><i id="apache2Start" class="fas fa-sync-alt fa-lg" style="cursor: pointer; color: blue;"></i></td>
                <td data-toggle="tooltip" title="cliquer pour arreter" style=" text-align: center; "><i  id="apache2Stop" class="fas fa-stop-circle fa-lg" style=" cursor: pointer; color: red;"></i></td>                
            </tr>
            <tr id="nginx" class="text-center">
                <td class="font-weight-bold">Nginx</td>
                <td>Reverse proxy</td>
                <td><i class="fas fa-check" style="color: blue;"></i></td>
                <td style=" text-align: center;" data-toggle="tooltip" title="cliquer pour redemarrer"><i id="nginxStart" class="fas fa-sync-alt fa-lg" style="cursor: pointer; color: blue;"></i></td>
                <td style="text-align: center; cursor: pointer;" data-toggle="tooltip" title="cliquer pour arreter"><i id="nginxStop" class="fas fa-stop-circle fa-lg" style="color: red;"></i></td>                
            </tr>
            <tr id="phpfpm" class="text-center">
                <td class="font-weight-bold">PHP7.2-FPM</td>
                <td>Daemon qui s'occupe de l'exécution de php</td>
                <td><i class="fas fa-exclamation-triangle" style="color: red;"></i></td>
                <td style=" text-align: center;" data-toggle="tooltip" title="cliquer pour redemarrer"><i id="phpfpmStart" class="fas fa-sync-alt fa-lg" style="cursor: pointer; color: blue;"></i></td>
                <td style="text-align: center;"  data-toggle="tooltip" title="cliquer pour arreter"><i  id="phpfpmStop" class="fas fa-stop-circle fa-lg" style=" cursor: pointer; color: red;"></i></td>          
            </tr>
            <tr id="postfix" class="text-center">
                <td class="font-weight-bold">Postfix</td>
                <td>Serveur SMTP qui sert à l'envoi des mails</td>
                <td><i class="fa fa-power-off fa-lg" style="color: red;"></i></td>
                <td style=" text-align: center;" data-toggle="tooltip" title="cliquer pour redemarrer"><i id="postfixStart" class="fas fa-sync-alt fa-lg" style="cursor: pointer; color: blue;"></i></td>
                <td style="text-align: center;"  data-toggle="tooltip" title="cliquer pour arreter"><i id="postfixStop" class="fas fa-stop-circle fa-lg" style="cursor: pointer; color: red;"></i></td> 
            </tr>            
            <tr id="dovecot" class="text-center">
                <td class="font-weight-bold">Dovecot </td>
                <td>Serveur de reception et de lecture des mails</td>
                <td><i class="fas fa-check" style="color: blue;"></i></td>
                <td style=" text-align: center;" data-toggle="tooltip" title="cliquer pour redemarrer"><i id="dovecotStart" class="fas fa-sync-alt fa-lg" style="cursor: pointer; color: blue;"></i></td>
                <td style="text-align: center; " data-toggle="tooltip" title="cliquer pour arreter"><i id="dovecotStop" class="fas fa-stop-circle fa-lg" style="cursor: pointer; color: red;"></i></td>               
            </tr>            
        </tbody>            
    </table>
    <div class="col-md-12"><button id="all" type="button" class="col-md-4 offset-md-4 btn btn-secondary btn-lg text-center">Rédémarrer tous les services</button></div>
</div>

<div class="modal" tabindex="-1" role="dialog" id="confirmation">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Rédémarrage Serveur</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <p>Etes vous sur de vouloir redémarrer tous les services ?</p>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Non, annuler</button>
            <button type="button" class="btn btn-primary" id="buttonConfirm">Rédémarrer</button>
        </div>
    </div>
  </div>
</div>
<?php
    echo "<script src=\"pages/js/service.js\"></script>" ;

?>

<!--
/*
(function (){
    function sendDetail( commande, objet )
    {
        var xhr = new XMLHttpRequest() ;
        var value1= encodeURIComponent(commande);
        var value2= encodeURIComponent(objet) ;
        xhr.open('POST', 'http:index?page=traitement.php');
        //xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        var form = new FormData();
        form.append(objet , commande);
        objet.innerHTML ='<i class="fas fa-sync fa-spin " style"color: blue;"></i>' ;
        xhr.addEventListener('readystatechange', function() {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200)
        {
            displayResult(xhr.responseText) ;      
        }
        
        });   
        xhr.send(form);
    }
    function displayResult(reponse)
    {
        if (reponse.length)
        {
        response = response.split("|") ;
            var serviceType= response[1] ;
            var serviceState = response[2] ;
            var serviceX = document.getElementById(serviceType ).childNodes[2] ;
            if (serviceState=='start')
            {
                serviceX.innerHTML = '<i class="fas fa-check fa-lg" style="cursor: pointer; color: blue;"></i>'; 
            }
            else if (serviceState=='stop')
            {
                serviceX.innerHTML = '<i class="fas fa-stop-circle fa-lg" style="cursor: pointer; color: blue;"></i>';                     
            }
            else if(serviceState=='unknown')
            {
                serviceX.innerHTML = '<i class="fas fa-check" style="cursor: pointer; color: blue;"></i>';               
            }            
        }        
    }
    var tableau = {
        apache2 : 'apache2',
        phpfpm :'phpfpm', 
        nginx : 'nginx',
        postfix : 'postfix' ,
        dovecot : 'dovecot'    
    } ;
    function remplirTableau(statut)
    {
        for (var i in tableau.length)
        {
            tableau[i] = 'statut' ;
        }        
    }
    var tabStart= new Array(5), tabStop = new Array(5);pos
    for (var i in tableau) 
    {
        tabStart[i]= document.getElementById(i).childNodes[3] ;
        tabStart[i].addEventListener('click', sendDetail("restart", i));
        tabStop[i] = document.getElementById(i).childNodes[4] ;
        tabStop[i].addEventListener('click', sendDetail("stop" ,i));        
    }
    var demarrerTous = document.getElementById('all') ;    
    demarrerTous.addEventListener('click',function()
    {
        $(function() {
        $('#confirmation').modal('show') ;
        $('#buttonConfirm').click( function(){ $('#confirmation').modal('hide') ; sendDetail("restart", "all")});
        });
   
    });       
                       
})();
    -->