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
                <td style=" text-align: center;" data-toggle="tooltip" title="cliquer pour redemarrer" ><i class="fas fa-sync-alt fa-lg" style="cursor: pointer; color: blue;"></i></td>
                <td data-toggle="tooltip" title="cliquer pour arreter" style=" text-align: center; "><i class="fas fa-stop-circle fa-lg" style=" cursor: pointer; color: red;"></i></td>                
            </tr>
            <tr id="nginx" class="text-center">
                <td class="font-weight-bold">Nginx</td>
                <td>Reverse proxy</td>
                <td><i class="fas fa-check" style="color: blue;"></i></td>
                <td style=" text-align: center;" data-toggle="tooltip" title="cliquer pour redemarrer"><i class="fas fa-sync-alt fa-lg" style="cursor: pointer; color: blue;"></i></td>
                <td style="text-align: center; cursor: pointer;" data-toggle="tooltip" title="cliquer pour arreter"><i class="fas fa-stop-circle fa-lg" style="color: red;"></i></td>                
            </tr>
            <tr id="phpfpm" class="text-center">
                <td class="font-weight-bold">PHP7.2-FPM</td>
                <td>Daemon qui s'occupe de l'exécution de php</td>
                <td><i class="fa fa-exclamation-triangle" style="color: red;"></i></td>
                <td style=" text-align: center;" data-toggle="tooltip" title="cliquer pour redemarrer"><i class="fas fa-sync-alt fa-lg" style="cursor: pointer; color: blue;"></i></td>
                <td style="text-align: center;"  data-toggle="tooltip" title="cliquer pour arreter"><i class="fas fa-stop-circle fa-lg" style=" cursor: pointer;color: red;"></i></td>          
            </tr>
            <tr id="postfix" class="text-center">
                <td class="font-weight-bold">Postfix</td>
                <td>Serveur SMTP qui sert à l'envoi des mails</td>
                <td><i class="fa fa-power-off fa-lg" style="color: red;"></i></td>
                <td style=" text-align: center;" data-toggle="tooltip" title="cliquer pour redemarrer"><i class="fas fa-sync-alt fa-lg" style="cursor: pointer; color: blue;"></i></td>
                <td style="text-align: center;"  data-toggle="tooltip" title="cliquer pour arreter"><i class="fas fa-stop-circle fa-lg" style="cursor: pointer; color: red;"></i></td> 
            </tr>            
            <tr id="dovecot" class="text-center">
                <td class="font-weight-bold">Dovecot </td>
                <td>Serveur de reception et de lecture des mails</td>
                <td><i class="fas fa-check" style="color: blue;"></i></td>
                <td style=" text-align: center;" data-toggle="tooltip" title="cliquer pour redemarrer"><i class="fas fa-sync-alt fa-lg" style="cursor: pointer; color: blue;"></i></td>
                <td style="text-align: center; " data-toggle="tooltip" title="cliquer pour arreter"><i class="fas fa-stop-circle fa-lg" style="cursor: pointer; color: red;"></i></td>               
            </tr>            
        </tbody>            
    </table>
    <div class="col-md-12"><button id="demarrerTous" type="button" class="col-md-4 offset-md-4 btn btn-secondary text-center">Rédémarrer tous les services</button></div>
</div>
<script>
(function (){
    function sendDetail(var objet, var commande)
    {
        var xhr = new XMLHttpRequest() ;
        var value1= encodeURIComponent(commande);
        xhr.open('POST', 'http:index?page=traitement.php');
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.send(objet + value1);
        objet.innerHTML ='<i class="fas fa-sync fa-spin " style"color: blue;"></i>' ;
        xhr.addEventListener('readystatechange', function() {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
            displayResult(xhr.responseText) ;      
    }
        xhr.send();
});        
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
    }
    function remplirTableau(statut)
    {
        for (var i in tableau.length)
        {
            tableau[i] = 'statut' ;
        }        
    } 
    for (var i in tableau) 
    {
        var tabDemarrer[i]= document.getElementById(i).childNodes[3] ;
        tab[i].addEventListener('click', sendDetail(i, "start"));
        var tabArreter [i]=   document.getElementById(i).childNodes[4] ;
        tab[i].addEventListener('click', sendDetail(i,"stop"));        
    }
    var demarrerTous = document.getElementById('demarrerTous') ;    
    demarrerTous.addEventListener('click', sendDetail("demarrerTous", "start"));
})();
</script>