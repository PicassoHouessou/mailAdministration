
<div class="row">
    
    <form method="post" action="index.php?page=adminbord" class="col-md-6 offset-md-3">
        <legend >Connexion Administrateur</legend>
        <div class="form-group">
            <label for="mailAdmin">Adresse email :</label>
            <input type="email" name="mailAdmin" class="form-control" required>
        </div>
        <div class="form-group">
		    <label for="password">Mot de passe :</label> 
            <input type="password" name="password" id="password" class="form-control" required>
					
        </div>
        <div class="form-group">    
            <input type="submit" value="se connecter" class="btn btn-primary">
        </div>
        <p><a href="#">Mot de passe oublié ?</a></p>
       
    </form>
</div>

<?php
    echo "<script src=\"pages/js/home.js\"></script>" ;
echo "Bonjour" ;
?>
