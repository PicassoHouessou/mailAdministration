<?php
require("constante.php") ;
    
// verifie si les sessions sont valides sinon redirige. Doit ete appelé sur toutes les pages *.func.php
verifierSession() ;
deconnexionAuto() ;

//On verifie si la variable error exise si oui on affiche le message relatif à l'erreur
afficherErreur() ;

// Utile pour la page all_mail car renitialise la pagination
if (!empty ($_SESSION['page']))
    $_SESSION['page'] = NULL ;

if (!empty ($_SESSION['tri']))
    $_SESSION['tri'] = NULL ;

if (!empty ($_SESSION['limite']))
    $_SESSION['limite'] = NULL ;

if (!empty ($_SESSION['indexPage']))
    $_SESSION['indexPage'] = NULL ;
    
    
?>

