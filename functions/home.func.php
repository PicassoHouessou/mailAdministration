<?php
 
require("constante.php") ;
// verifie si les sessions sont valides sinon redirige. Doit ete appelé sur toutes les pages *.func.php
verifierSession() ;
deconnexionAuto() ;
// Utile pour la page all_mail car renitialise la pagination
    if (!empty ($_SESSION['page']))
        $_SESSION['page'] = NULL ;
    if (!empty ($_SESSION['tri']))
        $_SESSION['tri'] = NULL ;
    if (!empty ($_SESSION['limite']))
        $_SESSION['limite'] = NULL ;
    if (!empty ($_SESSION['indexPage']))
        $_SESSION['indexPage'] = NULL ;

function protectionForm($var)
{
    return htmlspecialchars($var) ;       
}
?>
