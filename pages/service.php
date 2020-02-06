<style>

#all, tr th{
    background-color : #084561 ;
}
#all:hover{
    background-color : #48a200 ;
}
/*
th{
    background-color : #04091e; 
}*/
</style>
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
                <td><i id="apache2Status" class="fas fa-check fa-lg" style="color: blue;" title="Actif"></i></td>
                <td style=" text-align: center;" data-toggle="tooltip" title="cliquer pour redemarrer" ><i  id="apache2Start" class="fas fa-sync-alt fa-lg" style="cursor: pointer; color: blue;"></i></td>
                <td data-toggle="tooltip" title="Vous ne pouvez pas arreter ce service" style=" text-align: center;"><i  id="apache2Stop" class="fas fa-stop-circle fa-lg" style=" color: red;"></i></td>                
            </tr>
            <tr id="nginx" class="text-center">
                <td class="font-weight-bold">Nginx</td>
                <td>Reverse proxy</td>
                <td><i id="nginxStatus" class="fas fa-check fa-lg" style="color: blue;" title="Actif"></i></td>
                <td style=" text-align: center;" data-toggle="tooltip" title="cliquer pour redemarrer"><i id="nginxStart" class="fas fa-sync-alt fa-lg" style="cursor: pointer; color: blue;"></i></td>
                <td style="text-align: center;" data-toggle="tooltip" title="Vous ne pouvez pas arreter ce service"><i id="nginxStop" class="fas fa-stop-circle fa-lg" style="color: red;"></i></td>                
            </tr>
            <tr id="phpfpm" class="text-center">
                <td class="font-weight-bold">PHP7.2-FPM</td>
                <td>Daemon qui s'occupe de l'exécution de php</td>
                <td><i id="phpfpmStatus" class="fas fa-check fa-lg" style="color: blue" title="Actif"></i></td>
                <td style=" text-align: center;" data-toggle="tooltip" title="cliquer pour redemarrer"><i id="phpfpmStart" class="fas fa-sync-alt fa-lg" style="cursor: pointer; color: blue;"></i></td>
                <td style="text-align: center;"  data-toggle="tooltip" title="Vous ne pouvez pas arreter ce service"><i  id="phpfpmStop" class="fas fa-stop-circle fa-lg" style="  color: red;"></i></td>          
            </tr>
            <tr id="postfix" class="text-center">
                <td class="font-weight-bold">Postfix</td>
                <td>Serveur SMTP qui sert à l'envoi des mails</td>
                <td><i id="postfixStatus" class="fa fa-check fa-lg" style="color: blue;" title="Actif"></i></td>
                <td style=" text-align: center;" data-toggle="tooltip" title="cliquer pour redemarrer"><i id="postfixStart" class="fas fa-sync-alt fa-lg" style="cursor: pointer; color: blue;"></i></td>
                <td style="text-align: center;"  data-toggle="tooltip" title="cliquer pour arreter"><i id="postfixStop" class="fas fa-stop-circle fa-lg" style="cursor: pointer; color: red;"></i></td> 
            </tr>            
            <tr id="dovecot" class="text-center">
                <td class="font-weight-bold">Dovecot </td>
                <td>Serveur de réception et de lecture des mails</td>
                <td><i id="dovecotStatus" class="fas fa-check fa-lg" style="color: blue;" title="Actif"></i></td>
                <td style=" text-align: center;" data-toggle="tooltip" title="cliquer pour redemarrer"><i id="dovecotStart" class="fas fa-sync-alt fa-lg" style="cursor: pointer; color: blue;"></i></td>
                <td style="text-align: center; " data-toggle="tooltip" title="cliquer pour arreter"><i id="dovecotStop" class="fas fa-stop-circle fa-lg" style="cursor: pointer; color: red;"></i></td>               
            </tr><!--
            <tr id="spamassassin" class="text-center">
                <td class="font-weight-bold">Spamassassin</td>
                <td>Service  anti spams</td>
                <td><i id="spamassassinStatus" class="fas fa-check fa-lg" style="color: blue;" title="Actif"></i></td>
                <td style=" text-align: center;" data-toggle="tooltip" title="cliquer pour redemarrer"><i id="spamassassinStart" class="fas fa-sync-alt fa-lg" style="cursor: pointer; color: blue;"></i></td>
                <td style="text-align: center; " data-toggle="tooltip" title="cliquer pour arreter"><i id="spamassassinStop" class="fas fa-stop-circle fa-lg" style="cursor: pointer; color: red;"></i></td>               
            </tr>
            <tr id="vsftpd" class="text-center">
                <td class="font-weight-bold">VSFTPD </td>
                <td>Serveur FTP </td>
                <td><i id="vsftpdStatus" class="fas fa-check fa-lg" style="color: blue;" title="Actif"></i></td>
                <td style=" text-align: center;" data-toggle="tooltip" title="cliquer pour redemarrer"><i id="vsftpdStart" class="fas fa-sync-alt fa-lg" style="cursor: pointer; color: blue;"></i></td>
                <td style="text-align: center; " data-toggle="tooltip" title="cliquer pour arreter"><i id="vsftpdStop" class="fas fa-stop-circle fa-lg" style="cursor: pointer; color: red;"></i></td>               
            </tr>        -->    
        </tbody>            
    </table>
    <div class="col-md-12"><button id="all" type="button" class="col-md-4 offset-md-4 btn btn-secondary btn-lg text-center">Redémarrer tous les services</button></div>
</div>
<div class="modal" tabindex="-1" role="dialog" id="confirmation">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Redémarrage Serveur</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <p>Etes vous sur de vouloir redémarrer tous les services ?</p>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal" id="buttonAnnuler">Non, annuler</button>
            <button type="button" class="btn btn-primary" id="buttonConfirm">Redémarrer</button>
        </div>
    </div>
  </div>
</div>
<div aria-live="polite" id="information"  class="overflow-auto" aria-atomic="true" style="position:fixed; bottom: 5px; right:5px; min-height: 200px; max-height:83% ; ">
  <!-- Va contenir les notifications sous la forme de toast -->  
    <div class="text-primary row d-none" id="informationToolbox" style="position: fixed ; bottom:5px;" >
        <div id="viderContenuInformation" title="cliquer pour vider le contenu"><i class="fas fa-trash fa-lg col-md-6"  style="cursor:pointer;"></i></div>
        <div id="enregistrerContenuInformation" title="cliquer pour enregistrer le contenu"><i class="fas fa-save fa-lg col-md-6"  style="cursor:pointer;"></i></div>
    </div>
</div>
<?php
    echo "<script src=\"pages/js/jquery-ui.min.js\"></script> <br>" ;
    echo "<script src=\"pages/js/FileSaver.min.js\"></script> <br>" ;
    echo "<script src=\"pages/js/service.js\"></script>" ;
    echo "<br>";
?>