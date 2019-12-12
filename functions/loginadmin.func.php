<?php
    //On verifie s'il a une erreur lors d'une precedente connexion et on affiche l'erreur
    if(isset($_GET['errorValue']))
    {
        if ($_GET['errorValue']== "IDENTIFIANTS_INCORRECTS")
        {
            echo "<script>alert('Identifiants incorrects') ; <script>" ; 
            
            
        }
        else if ( $_GET['errorValue']=="CHAMPS_VIDES")
        {
            echo "<script> alert('Les champs sont vides');<script>" ;
          
        }
    }



?>