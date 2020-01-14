<?php
    //Initialisation des sessions
    session_start() ;
    /* $_SESSION['state'] = false ;
    $_SESSION['email'] = NULL;
    $_SESSION['prenom'] = NULL;
    $_SESSION['nom'] = NULL ;
    $_SESSION['ip'] = $_SERVER['REMOTE_ADDR'] ;
    */
?>
<?php
	$pages = scandir('pages/');
	if (isset($_GET['page']) && !empty($_GET['page'])) {
		if (in_array($_GET['page'].'.php', $pages)) {
			$page = $_GET['page'];
		}else{
			$page = "error";
		}
	}else{
		$page = "loginadmin";
	}
    $pages_functions = scandir('functions/');
	if (in_array($page.'.func.php', $pages_functions)) {
		include 'functions/'.$page.'.func.php';
	}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8" name="viewport">
	<link rel="stylesheet" type="text/css" href="dist/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="dist/fontawesome/css/all.css">
	<script src="dist/js/jquery.min.js"></script>
    <script src="dist/js/popper.min.js"></script>
    <script src="dist/js/bootstrap.min.js"></script>
    
	<title>Page d'aministration eneam.da</title>
	<!--<style>
        footer
        {
            margin-top: 400px; 
            background-color: aquamarine;
        }
        .container-fuilder
        {
            margin-left: 30px;
            margin-right: 30px;
        }
    </style>
-->
</head>
<body>
<div class="container-fluid" >
<?php
    //Fonction pour afficher une info d'erreur sur les pages
    //Doit etre revue pour placer ça dans les fichiers spécifiques des pages
    if (isset($_GET['error']))
    {
        $erreur = retourneErreur($_GET['error']) ;
        $alert='<div class="alert alertErrorss alert-warning alert-dismissible fade show" role="alert">
       <h4><strong>Attention Information importante</strong></h4>'.$erreur.'
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>' ;
        
        echo $alert ; 
        echo '<script>window.setTimeout(function() {
        $(".alertError").fadeTo(500, 0).slideUp(500, function(){
            $(this).remove(); 
        });
        }, 10000);  </script>' ;
    }
    include "body/topbar.php";
    
    
?>
<!-- Quand le javasriot est désactivé
-->
<noscript> <p class="bg-info text-center" style="font-size: 2rem;">Vous avez désactivé le javascript.  <br/>Activer le si vous voulez une meilleure expérience utilisateur <i class="fas fa-spinner fa-spin"></i></p></noscript>
<?php
    include 'pages/'.$page.'.php';
?>
<?php
	include "body/footer.php";
?>
</div>
</body>

    


</html>









   