<?php

/*
if (isset  )
    //$debut = ( $limite==-1 ? -1 : $debut) ;    
    $req = $db->prepare('SELECT SQL_CALC_FOUND_ROWS `virtual_users`.`id` AS id , `email` , `state`, `nom`, `prenom`, `matricule`, `telephone`, `pays`, `date_fin` FROM `virtual_users` INNER JOIN `virtual_users_infos` ON `virtual_users`.`id`= `virtual_users_infos`.`virtual_user_id` ORDER BY :tri DESC LIMIT :limite OFFSET :debut  ');
    $req->bindValue('tri',$tri);
    $req->bindValue('limite',$limite, PDO::PARAM_INT);
    $req->bindValue('debut',$debut, PDO::PARAM_INT) ;
    $req->execute() ;
    //On recupere le nombre total d'elements dans la base de donnée
    $resultFoundRows = $db->query ('SELECT found_rows()');
    $nombreResultat = $resultFoundRows->fetchColumn();
    $nombreTotalPage = ceil($nombreResultat/$limite) ;
    //On s'assure que le numéro de page dépasse le nombre total de page
    </div>

    */
	?>

<div class="row all_email">

    <?php
    if (isset($GLOBALS['afficheRetour'])) 
    {
        echo $GLOBALS['afficheRetour'] ;
        $GLOBALS['afficheRetour'] = NULL ;
    }
    
while ($don= $req->fetch())
{
    ?>    
    <div class="col-md-3 col-sm-5 " style="margin-top: 2%; margin-bottom: 2%;">
            <div class="card col-md-12" style="height: 100%;">
                
                <div class="card-body">
                    <h5 class="card-title"><strong class="text-secondary"><?php echo $don['prenom'].' '.$don['nom'] ;?></strong></h5>
                    <p class="card-text">
						<strong>Mail : </strong><?php echo $don['email'] ; ?> <br>						
                        <strong>Tél : </strong><?php echo $don['telephone'] ; ?><br/>            
					</p>                 
                    <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                        <div class="btn-group mr-2" role="group" aria-label="First group">
                            <a class="adminCheckEmail" href="mailto:<?php echo "{$don['email']}" ; ?>" hidden><?php echo "{$don['email']}" ; ?></a>
                            <a href="index.php?page=adminmanage<?php echo "&email={$don['email']}&type=disable&id={$don['id']}" ;?>"><button type="button" class="btn mail btn-secondary desactiveCompte" <?php if ($don['state']==TRUE) { echo ' title="Cliquer pour désactiver ce compte" ><i class="fas fa-unlock" ></i>' ; } else { echo  " title=\"Cliquer pour activer ce compte \" style=\"background-color: #db5b3b ;\"  \><i class=\"fas fa-lock\" ></i>" ;} ?>  </button> </a>
                            <a class="supprimeAdminCompte" href="index.php?page=adminmanage<?php echo "&email={$don['email']}&type=delete&id={$don['id']}" ;?>"><button type="button" class="btn btn-secondary" id="<?php echo $don['id'];?>" title="Cliquer pour supprimer le compte <?php echo $don['email'] ; ?>" ><i class="fas fa-user-times "></i></button> </a>
                            <button type="button" class="btn btn-secondary editerCompte" title="Cliquer pour éditer le compte <?php echo $don['email'] ; ?>"><i class="fas fa-edit"></i></button>
                            
                        </div>
                    </div>
                </div>                
            </div>            
        </div>
<?php
} 
$req->closeCursor() ;
?>    


<?php
    if(isset($_SESSION['email']) && $_SESSION['email']== 'master@eneam.da') {
    ?>
    <section class="col-md-8 offset-md-2" style="margin-top:20px;">
    <div class="card rounded" style="padding-top: 20px; padding-bottom: 20px;">
        <form method="post" action="index.php?page=adminmanage" class="col-md-12">
            <legend><h4>Création de compte administrateur</h4></legend>
            <div class="col-md-12">
                <div class="form-group">
                    <input type="email" class="form-control" name="Aemail" aria-describedby="emailHelp" placeholder="exemple@eneam.da" required>
                </div>
                <div class="form-group">
                    <input type="password"  name="Apassword" class="form-control" id="exampleInputPassword1" placeholder="********************************************" required>
                    <small id="emailPassword" class="form-text text-muted">Doit contenir au moins 8 caractères, une lettre majuscule, un chiffre et un caractère spécial !@&#$%^*-.</small>
                </div>
                
                <div class="form-group">
                    <input type="password"  name="ApasswordConfirm" class="form-control" id="exampleInputPassword2" placeholder="********************************************" required>
                    <small id="emailPassword2" class="form-text text-muted">
                    Veuillez confirmer le mot de passe</small>
                </div>  
                <input type="hidden" name="typeAdmin" value="CREATE_NEW_ADMIN" /> 
                <?php /*
                <div class="form-row">        
                    <div class="form-group col-md-6">
                        <label for="Anom">Nom </label> 
                        <input type="text" placeholder="Nom Ex: Houessou " class="form-control" id="Anom" name="Anom">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="Aprenom">Prénoms</label>
                        <input type="text" id="Aprenom" name="Aprenom" placeholder="Prénoms Ex: Paul Karl" class="form-control">                    
                    </div>
                    <!--<div class="form-row">    -->                 
                        <div class="form-group col-md-3">
                            <label for="Atelephone">Numéro de téléphone</label>
                            <input type="tel" placeholder="Numero de telephone" class="form-control" id="Atelephone" name="Atelephone">  
                        </div>
                        <div class="form-group col-md-6">
                            <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input" id="facultatif" name="facultatif">
                                <label class="form-check-label" for="facultatif">Changer mot de passe lors de la premiere connexion</label>
                            </div>                            
                        </div>

                   <!-- </div> --> 
                </div> */?>
            </div>
          <button type="submit" class="btn btn-primary">Créer le compte</button>
        </form>
        </div>
    </section>
    <?php
    } 
    ?>
</div>
<!-- Modal -->
<!-- Utile pour modifier le compte d'un utilisateur  -->
<div class="modal" tabindex="-1" role="dialog" id="modifierCompte">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Modification du compte</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form id="modifierAdmin" method="post" action="index.php?page=adminmanage">
                <div class="form-group row">
					<label for="staticEmail" class="col-sm-4 col-form-label">Email</label>
                    <div class="col-sm-8">
                        <input type="email"  name="Aemail" class="form-control-plaintext" id="emailToModify" value="email@example.com" readonly>
                    </div>				
                </div>
                <div class="form-group row">
                    <label for="Apassword2" class="col-sm-4 col-form-label">Mot de passe </label>
                    <div class="col-sm-8">
                        <input type="password" name="Apassword" class="form-control" id="Apassword2" required>
                    </div>
                </div>
				<div class="form-group row">
                    <label for="ApasswordConfirm2" class="col-sm-4 col-form-label">Mot de passe</label>
                    <div class="col-sm-8">
                        <input type="password" name="ApasswordConfirm" class="form-control" id="ApasswordConfirm2" required>
                    </div>
                </div>     
                <input type="hidden" name="adminModifyPassword" value="adminModifyPassword" >  
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" id="buttonAnnuler" data-dismiss="modal">Annuler</button>
                    <button type="submit" id="buttonConfirmCompteModify" class="btn btn-primary standardBouton">Enregistrer</button>
                </div>        
            </form>
        </div>
        
    </div>
  </div>
</div>

<script type="text/javascript"> 
$(function(){

var confirmation = $('.supprimeAdminCompte') ;
confirmation.on('click', function (e){
    e.preventDefault();
    var linkParametre = $(this).attr('href') ;
    if ( confirm ("Etes vous sur de vouloir supprimer le compte administrateur ? ") )
    {
        window.location.href = linkParametre ;    
        
    }
}) ;

//Pour éditer un compte 
var editerCompte = $('.editerCompte') ;
	editerCompte.on('click', function (){
		var paren = $(this).offsetParent() ,  intermediaire =  paren.find('.adminCheckEmail');      
        var compteEmail =  intermediaire.attr('href').split('mailto:') [1]; 
      
		var modifierCompteModal = $('#modifierCompte') ;
		 $('#emailToModify').attr('value', compteEmail) ;
		$('#modifierCompte').modal('show');
		$('#buttonConfirmCompteModify').click( function(e){
        });
        $('#buttonAnnuler').click( function(e){
            $('#modifierAdmin')[0].reset();
            //e.preventDefault();
            //$('#modifierAdmin').submit() ;

            //$('#modifierCompte').modal('hide') ; 
			
		});
		
		//On annule tous les évènements unitiles C'est très important sinon causes des bugs lors de la prochaine requetes
        $('#modifierCompte').on('hidden.bs.modal', function (e){
            $('#modifierAdmin')[0].reset();
            //$('#buttonConfirmCompteModify').off('click');
            //$('#buttonAnnuler').off('click');
            ///$(this).off('hidden.bs.modal');
        });
        
		
	}) ;
});





</script>




<?php
/*
<div class="row" style="margin-bottom: 200px;"> 

<table class="table table-bordered ">
  <thead>
    <tr>
      <th scope="col">Nom</th>
      <th scope="col">Prenom</th>
      <th scope="col">Email</th>
      <th scope="col">Téléphone</th>
      <th scope="col">New Password</th>
      <th scope="col">Valider</th>
    </tr>
  </thead>
  <tbody>
  
<?php
while ($don= $req->fetch())
{
  
    ?>
    <form method="post" action="#">
    <tr>
      <th scope="row"> <input type="text" value="<?php echo"{$don['nom']}" ;?>"/></th>
      <td><input type="text" value="<?php echo"{$don['prenom']}" ;?>"/></td>
      <td><input type="email" value="<?php echo"{$don['email']}" ;?>"/></td>
      <td><input type="telephone" value="<?php echo"{$don['telephone']}" ;?>"/></td>
      <td><input type="text" disabled value="<?php echo"{$don['password']}" ;?>"/> <i class="fas fa-pencil-alt fa-lg editPassword"></i></td>
      <td><button type="submit" class="btn btn-primary">valider</button></td>

    </tr>
    </form>    

<?php
}
?>
</tbody>
</table>

<script type="text/javascript">
var edit = document.querySelector('.editPassword');
edit.addEventListener('click', function(){
  var password = edit.previousSibling ;
  password.value ="jk jhvghfdx" ;
  //alert( password.value) ;
  //password.setAttribute('disabled',"fals!e") ;

});
/*
$(function(){
  var edit = $(".editPassword").on('click', function(){
    var passwword = $(this).prev();
    password.removeAttr('disabled');

  } );

});*/
/*
</script>
</div>
*/
?>