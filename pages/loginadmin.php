<style>
/*
.loginAdmin{
    background: url("img/asset/eneam.jpeg")  no-repeat;
    opacity: 1 ;
    padding-left: 0px;
}*/
form{
    //background: url("img/asset/eneam.jpeg") fixed repeat;
    background-color: #242943 ;
    border-radius: 4px;
    opacity: 0.95 ; color: white;
    margin-top:50px;
    height: 420px;
    padding-top: 15px ;
    padding-left: 0px;
}
.form-group
{
    padding: 10px;
}
label{
    text-transform: uppercase;
    color: white;
    font-weight: bold;
}
form p a{
    color: white;
}
form p a:hover{
    color: #f6214b ;
    text-decoration:none;
}
#btn_connecter:hover{
    background-color:  #f6214b;
}
</style>

<!-- Ce formulaire s'appelle lui meme ensuite si toutes les verifications sont ok elle redirige à la page d'accueil  OBSOLETE  --> 
<div class="row loginAdmin" > 
    <form method="post" action="index.php?page=loginadmin" class="col-md-5 offset-md-3">
        <legend >Connexion Administrateur</legend>
        <div class="form-group">
            <label for="email">Adresse email</label>            
            <input type="email" name="email" class="form-control"  id="email" required=required>
            <small id="emailHelp" class="form-text  text-danger"></small>                       
        </div>
        <div class="form-group">
		    <label for="password">Mot de passe</label> 
            <input type="password" name="password" id="password" class="form-control" required=required>
            <small id="passwordHelp" class="form-text text-muted"></small>
					
        </div>
        <div class="form-group">    
            <input type="submit" value="se connecter" class="btn btn-warning" id="btn_connecter">
        </div>
        <p><a href="#" id="forgetPassword" data-toggle="modal" data-target="#myModal">Mot de passe oublié ?</a></p>
       
    </form>
</div>
<div class="modal" tabindex="-1" role="dialog" id="myModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Veuillez contacter l'administrateur maitre</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>




<script type="text/javascript">
/*
$(function()
{
    $('')


});

*/
</script> 
<?php
    echo "<script src=\"pages/js/loginadmin.js\"></script>" ;
?>
