<?php
 
require("constante.php") ;
// verifie si les sessions sont valides sinon redirige. Doit ete appelé sur toutes les pages *.func.php
verifierSession() ;

function protectionForm($var)
{
    return htmlspecialchars($var) ;       
}



if (isset($_GET['error']))
{
    $erreur = retourneErreur($_GET['error']) ;
    $alert='<div class="alert alert-warning alert-dismissible fade show" role="alert">
   <h4><strong>Attention Information importante</strong></h4>'.$erreur.'
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>' ;         
        echo $alert ;       
    }
?>
