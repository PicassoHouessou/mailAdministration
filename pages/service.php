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
                <td><i id="apache2Status" class="fas fa-check" style="color: blue;" title="Actif"></i></td>
                <td style=" text-align: center;" data-toggle="tooltip" title="cliquer pour redemarrer" ><i  id="apache2Start" class="fas fa-sync-alt fa-lg" style="cursor: pointer; color: blue;"></i></td>
                <td data-toggle="tooltip" title="Vous ne pouvez pas arreter ce service" style=" text-align: center;"><i  id="apache2Stop" class="fas fa-stop-circle fa-lg" style=" color: red;"></i></td>                
            </tr>
            <tr id="nginx" class="text-center">
                <td class="font-weight-bold">Nginx</td>
                <td>Reverse proxy</td>
                <td><i id="nginxStatus" class="fas fa-check" style="color: blue;"></i></td>
                <td style=" text-align: center;" data-toggle="tooltip" title="cliquer pour redemarrer"><i id="nginxStart" class="fas fa-sync-alt fa-lg" style="cursor: pointer; color: blue;"></i></td>
                <td style="text-align: center;" data-toggle="tooltip" title="Vous ne pouvez pas arreter ce service"><i id="nginxStop" class="fas fa-stop-circle fa-lg" style="color: red;"></i></td>                
            </tr>
            <tr id="phpfpm" class="text-center">
                <td class="font-weight-bold">PHP7.2-FPM</td>
                <td>Daemon qui s'occupe de l'exécution de php</td>
                <td><i id="phpfpmStatus" class="fas fa-exclamation-triangle" style="color: red;"></i></td>
                <td style=" text-align: center;" data-toggle="tooltip" title="cliquer pour redemarrer"><i id="phpfpmStart" class="fas fa-sync-alt fa-lg" style="cursor: pointer; color: blue;"></i></td>
                <td style="text-align: center;"  data-toggle="tooltip" title="Vous ne pouvez pas arreter ce service"><i  id="phpfpmStop" class="fas fa-stop-circle fa-lg" style="  color: red;"></i></td>          
            </tr>
            <tr id="postfix" class="text-center">
                <td class="font-weight-bold">Postfix</td>
                <td>Serveur SMTP qui sert à l'envoi des mails</td>
                <td><i id="postfixStatus" class="fa fa-power-off fa-lg" style="color: red;"></i></td>
                <td style=" text-align: center;" data-toggle="tooltip" title="cliquer pour redemarrer"><i id="postfixStart" class="fas fa-sync-alt fa-lg" style="cursor: pointer; color: blue;"></i></td>
                <td style="text-align: center;"  data-toggle="tooltip" title="cliquer pour arreter"><i id="postfixStop" class="fas fa-stop-circle fa-lg" style="cursor: pointer; color: red;"></i></td> 
            </tr>            
            <tr id="dovecot" class="text-center">
                <td class="font-weight-bold">Dovecot </td>
                <td>Serveur de reception et de lecture des mails</td>
                <td><i id="dovecotStatus" class="fas fa-check" style="color: blue;"></i></td>
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
<div aria-live="polite" id="information" aria-atomic="true" style="position:fixed; bottom: 5px; right:5px; min-height: 200px; ">
  <!-- Position it -->  
</div>
<?php
    echo "<script src=\"pages/js/service.js\"></script>" ;
    echo "<br>";
?>