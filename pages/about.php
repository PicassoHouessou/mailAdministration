<div class="row">
    <div class="col-md-8 offset-md-2">
        <form method="post" action="index.php?page=ajout_utilisateur" class="col-md-12">
            <legend><h4 id="contacter">Nous contacter</h4></legend>
            <div class="form-row col-md-12">
                <label for="nom" class="col-md-12">VOTRE NOM</label>
                <div class="form-group col-md-6">      
                    <input type="text" id="prenom" name="prenom" placeholder="Prénoms Ex: Paul Karl" class="form-control">
                </div>
                <div class="form-group col-md-6">
                    <input type="text" placeholder="Nom Ex: Houessou " class="form-control" id="nom" name="nom">               
                </div>
            </div>
            <div class="form-group col-md-12">
                <label for="email" class="col-md-12">ADRESSE EMAIL</label>
                <input class="form-control" type="email" id="email" placeholder="exemple@enem.da">        
            </div>
            <div class="form-group col-md-12">
                <label for="telephone">NUMERO DE TELEPHONE</label>
                <input class="form-control" type="tel" name="telephone" id="telephone" placeholder="+2990000000">        
            </div>
            <div class="form-group col-md-12">
                <label for="message">MESSAGE</label>
                <textarea class="form-control" id="message" name="message" placeholder="Entrez votre message ou remarques"></textarea>       
            </div>
            <button type="submit" class="btn btn-primary">Envoyer</button>
        </form>
    </div>
    <!--
    <div class="col-md-12">
        <div>
            <p>Je m'appelle Picasso Houessou</p></div>        
    </div>    
</div>
-->

<?php 
// Utile pour la page all_mail car renitialise la pagination
    if ( !empty ($_SESSION['page']))
        $_SESSION['page'] = NULL ;
    if ( !empty ($_SESSION['tri']))
        $_SESSION['tri'] = NULL ;
    if (!empty ($_SESSION['limite']))
        $_SESSION['limite'] = NULL ;
    if ( !empty ($_SESSION['indexPage']))
        $_SESSION['indexPage'] = NULL ;


?>