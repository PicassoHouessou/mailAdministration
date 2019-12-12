<!-- Ce formulaire s'appelle elle meme ensuite si toutes les verifications sont ok elle redirige à la page d'accueil  OBSOLETE  --> 
<div class="row">
    
    <form method="post" action="index.php?page=home" class="col-md-6 offset-md-3">
        <legend >Connexion Administrateur</legend>
        <div class="form-group">
            
            <label for="email">Adresse email</label>            
            <input type="email" name="email" class="form-control" required name="email" id="email">
            <small id="emailHelp" class="form-text text-muted d-none">Votre email.</small>
        </div>
        <div class="form-group">
		    <label for="password">Mot de passe</label> 
            <input type="password" name="password" id="password" class="form-control" required>
					
        </div>
        <div class="form-group">    
            <input type="submit" value="se connecter" class="btn btn-primary">
        </div>
        <p><a href="#">Mot de passe oublié ?</a></p>
       
    </form>
</div>

<?php
    echo "<script src=\"pages/js/loginadmin.js\"></script>" ;
?>
