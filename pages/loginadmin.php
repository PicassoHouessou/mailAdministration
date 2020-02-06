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

<!-- Ce formulaire s'appelle elle meme ensuite si toutes les verifications sont ok elle redirige à la page d'accueil  OBSOLETE  --> 
<div class="row loginAdmin"> 
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
        <p><a href="#">Mot de passe oublié ?</a></p>
       
    </form>
</div>
<?php
    echo "<script src=\"pages/js/loginadmin.js\"></script>" ;
?>
