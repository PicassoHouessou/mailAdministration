 
<div class="row all_email">
    
    <?php
    $page = (!empty($_SESSION['page']) ? $_SESSION['page'] : 1) ;
    $tri = (!empty($_SESSION['tri']) ? $_SESSION['tri'] : NULL) ;
    $limite = ( !empty($_SESSION['limite'] ) ? $_SESSION['limite'] : 20) ;
    
    if (isset($_GET['indexPage']) && empty($_GET['indexPage']) == false )
    {        
        $page =  htmlspecialchars($_GET['indexPage']) ;
        $page = (int) $page ;  
        //On s'assure qu'il n'y est pas de page négatif
        $page = ($page < 1 ? 1: $page );
        $_SESSION['page'] = $page ;
        
    }
    if (isset($_GET['tri']) && empty($_GET['tri']) == false )
    {
        $tri = htmlspecialchars($_GET['tri']) ;
        $tri = (string) $tri ;
        switch($tri)
        {
            case 'nom':
                $tri = "`virtual_users_infos`.`nom`" ;
                $_SESSION['tri'] = $tri ;
                break ;
            case 'prenom':
                $tri = "`virtual_users_infos`.`prenom`";
                $_SESSION['tri'] = $tri ;
                break;
            case 'matricule':
                $tri = "`virtual_users_infos`.`matricule`";
                $_SESSION['tri'] = $tri ;
                break;
            case 'email':
                $tri = "`virtual_users`.`email`" ;
                $_SESSION['tri'] = $tri ;
                break;
            default:
                $tri = NULL ;
                $_SESSION['tri'] = $tri ;
                break;            
        }
    }     
    if (isset($_GET['limite']) && empty($_GET['limite']) == false )
    {        
        $limite= htmlspecialchars($_GET['limite']) ;
        $limite = (int) $limite ;
        switch($limite)
        {
            /*
            case -1:
                //echo $limite ;
                $limite = -1; // -1 represente la valeur afficher tout
                // Dans ce cas il faut aussi ramener l'index de la page à la page 0
                $page = 1 ;
                $_SESSION['page'] = $page ;
                $_SESSION['limite'] = $limite ;
                break ;
                */
            case 2:
                $limite = 2 ;
                $_SESSION['limite'] = $limite ;                
                break ;
            case 5:
                $limite= 5;
                $_SESSION['limite'] = $limite ;
                break;
            case 10:
                $limite = 10;
                $_SESSION['limite'] = $limite ;
                break;
            case 20:
                $limite = 20;
                $_SESSION['limite'] = $limite ;
                break;
            case 50:
                $limite = 50;
                $_SESSION['limite'] = $limite ;
                break;
            case 100:
                $limite = 100;
                $_SESSION['limite'] = $limite ;
                break;
            default:
                $limite= 20 ;
                $_SESSION['limite'] = $limite ;
                break;            
        }
    }
    continuer:
    $debut = ($page - 1)* $limite ;
    //$debut = ( $limite==-1 ? -1 : $debut) ;    
    $req = $db->prepare('SELECT SQL_CALC_FOUND_ROWS `virtual_users`.`id` AS id , `email` , `nom`, `prenom`, `matricule`, `telephone`, `pays`, `date_fin` FROM `virtual_users` INNER JOIN `virtual_users_infos` ON `virtual_users`.`id`= `virtual_users_infos`.`virtual_user_id` ORDER BY :tri DESC LIMIT :limite OFFSET :debut  ');
    $req->bindValue('tri',$tri);
    $req->bindValue('limite',$limite, PDO::PARAM_INT);
    $req->bindValue('debut',$debut, PDO::PARAM_INT) ;
    $req->execute() ;
    //On recupere le nombre total d'elements dans la base de donnée
    $resultFoundRows = $db->query ('SELECT found_rows()');
    $nombreResultat = $resultFoundRows->fetchColumn();
    $nombreTotalPage = ceil($nombreResultat/$limite) ;
    //On s'assure que le numéro de page dépasse le nombre total de page
    while($page > $nombreTotalPage )
    {
        $page = $page -1 ;
        $_SESSION['page'] = $_SESSION['page'] - 1  ;
        $req->closeCursor() ;
        goto continuer ;  
    }    
    ?>
    <div class="col-md-12"> 
        <h2 class="d-inline-flex col-md-3">Trier par</h2>
        <div class="col-md-8 btn-group boutonTri" role="group" aria-label="Basic example">
            <button type="button" class="btn btn-secondary boutonFiltre <?php if ($tri=="`virtual_users_infos`.`nom`") echo ' bg-success';?>" id="triNom"><a href="index.php?page=all_email&amp;tri=nom" class="text-light">Nom</a></button>
            <button type="button" class="btn btn-secondary boutonFiltre <?php if ($tri=="`virtual_users_infos`.`prenom`") echo ' bg-success';?>" id="triPrenom"><a href="index.php?page=all_email&amp;tri=prenom" class="text-light">Prenoms</a></button>
            <button type="button" class="btn btn-secondary boutonFiltre <?php if ($tri=="`virtual_users_infos`.`matricule`") echo ' bg-success';?>" id="triMatricule"><a href="index.php?page=all_email&amp;tri=matricule" class="text-light">Matricule</a></button>
            <button type="button" class="btn btn-secondary boutonFiltre <?php if ($tri=="`virtual_users`.`email`") echo ' bg-success';?>" id="triEmail"><a href="index.php?page=all_email&amp;tri=email" class="text-light">Adresse mail</a></button>
            <div class="btn-group" role="group">
                <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Nombre d'occurences
                </button>
                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                    <a class="dropdown-item" href="index.php?page=all_email&amp;limite=2">2</a>
                    <a class="dropdown-item" href="index.php?page=all_email&amp;limite=5">5</a>
                    <a class="dropdown-item" href="index.php?page=all_email&amp;limite=10">10</a>
                    <a class="dropdown-item" href="index.php?page=all_email&amp;limite=20">20</a>
                    <a class="dropdown-item" href="index.php?page=all_email&amp;limite=50">50</a>
                    <a class="dropdown-item" href="index.php?page=all_email&amp;limite=100">100</a>
                <!--    <a class="dropdown-item" href="index.php?page=all_email&amp;limite=-1">Tout</a>-->        
                </div>
          </div>
    </div>
    </div>
    <?php
while ($don= $req->fetch())
{
    ?>    
    <div class="col-md-3 col-sm-5 " style="margin-top: 2%; margin-bottom: 2%;">
            <div class="card col-md-12" style="height: 100%;">
                <img src="..." class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title"><strong class="text-secondary"><?php echo $don['prenom'].' '.$don['nom'] ;?></strong></h5>
                    <p class="card-text"><strong>Matricule : </strong><?php echo $don['matricule'] ; ?><br>
                        <strong>Tél : </strong><?php echo $don['telephone'] ; ?><br/>
                        <strong>Expire : </strong><?php echo $don['date_fin'] ; ?><br></p>                 
                    <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                        <div class="btn-group mr-2" role="group" aria-label="First group">
                            <button type="button" class="btn btn-secondary supprime" id="<?php echo $don['id'];?>" title="Cliquer pour supprimer le compte <?php echo $don['email'] ; ?>"  ><i class="fas fa-user-times "></i></button>
                            <button type="button" class="btn btn-secondary" title="Cliquer pour éditer le compte <?php echo $don['email'] ; ?>"><i class="fas fa-edit"></i></button>
                            <button type="button" class="btn mail btn-secondary" title="Cliquer pour joindre le compte <?php echo $don['email'] ; ?>"><a href="mailto:<?php echo $don['email'] ; ?>" class="text-light"><i class="fas fa-mail-bulk" ></i></a></button>                            
                        </div>
                    </div>
                </div>                
            </div>            
        </div>
<?php
}
$req->closeCursor() ;
if ($erreurSuppression="MAIL_DELETE")
{?>
    <div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header">
    <img src="..." class="rounded mr-2" alt="...">
    <strong class="mr-auto">Info</strong>
    <small>A <?php echo date('H').'h'.date('i').'m' ;?></small>
    <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
     </div>
    <div class="toast-body"> Le compte email a été correctement supprimé</div>
    </div>

<?php
 $erreurSuppression="";
} ?> 
    <div class="col-md-8 offset-md-4 col-sm-6 offst-sm-6" style=" margin-top: 20px; ">
        <ul class="pagination">
            <?php 
            if ($page >1){ ?>
            <li class="page-item"><a class="page-link" href="index.php?page=all_email&amp;indexPage=<?php echo $page- 1 ;?>" aria-label="Previous"><span aria-hidden="true">&laquo;</span>
              </a>
            </li><?php  } ?>  <!--  A revoir pour la pagination multiple les liens    
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item"><a class="page-link" href="#">4</a></li> -->
            <?php 
            if ($page <$nombreTotalPage){ ?>
            <li class="page-item"><a class="page-link" href="index.php?page=all_email&amp;indexPage=<?php echo $page+1; ?>" aria-label="Next"><span aria-hidden="true">&raquo;</span> </a>
            </li>
            <?php } ?>
        </ul>
    </div>
</div>

<!-- Utile pour le js alert qui s'affiche lors de la supprrssion de compte  -->
<div class="modal" tabindex="-1" role="dialog" id="confirmation">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Suppresion de compte</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modalConfirmationId">
                <p>Etes vous sur de vouloir supprimer ce compte ?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" style="background-color : #084561 ;">Non, annuler</button>
                <button type="button" class="btn btn-danger" id="buttonConfirm">Oui, supprimer</button>
            </div>
        </div>
    </div>
</div> 
<div aria-live="polite" id="information" class="overflow-auto" aria-atomic="true" style="position:fixed; bottom: 5px; right:5px; min-height: 200px; max-height:83%; ">
  <!-- Position it -->  
    <div class="text-primary row d-none" id="informationToolbox" style="position: fixed ; bottom:5px;" >
        <div id="viderContenuInformation" title="cliquer pour vider le contenu"><i class="fas fa-trash fa-lg col-md-6"  style="cursor:pointer;"></i></div>
        <div id="enregistrerContenuInformation" title="cliquer pour enregistrer le contenu"><i class="fas fa-save fa-lg col-md-6"  style="cursor:pointer;"></i></div>
    </div>
</div>
<?php
    echo "<script src=\"pages/js/jquery-ui.min.js\"></script> <br>" ;
    echo "<script src=\"pages/js/FileSaver.min.js\"></script> <br>" ;
    echo "<script src=\"pages/js/all_email.js\"></script>" ;
    echo "<br/>";
?>