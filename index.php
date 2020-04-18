<?php
    //Initialisation des sessions
    session_start() ;
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
	<meta charset="utf-8" />
    <meta name="description" content="C'est la page d'administration su serveur SMTP et IMAP du domaine eneam.da. Cette page est destinée aux administrateurs du domaines"/>
    <meta name="keywords" content="Administration, ENEAM, SMTP , IMAP, Bénin, UAC" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="stylesheet" type="text/css" href="dist/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="dist/fontawesome/css/all.min.css" />
    <link rel="stylesheet" type="text/css" href="css/index.css" />
    <link rel="icon" href="img/asset/favicon.ico" type="image/x-icon" />
	<script src="dist/js/jquery.min.js"></script>
    <script src="dist/js/popper.min.js"></script>
    <script src="dist/js/bootstrap.min.js"></script>
	<title>Page d'aministration su serveur d'envoi et de réception de mails eneam.da</title>
</head>
<body>
<div class="container-fluid" style="background-color: #ebedef !important;">
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
<noscript> <p class="bg-info text-center rounded-pill" style="font-size: 2rem;">Vous avez désactivé le javascript.<br/>Activez-le si vous voulez une meilleure expérience utilisateur <i class="fas fa-spinner fa-spin"></i></p></nosscript>-->
<?php
    include 'pages/'.$page.'.php';
?>
<?php
	include "body/footer.php";
?>
</div>
</body>

    


</html>









   