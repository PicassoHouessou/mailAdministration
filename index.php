
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
	<meta name="viewport" >
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="dist/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="dist/fontawesome/css/all.css">
	
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
    <style>
        
    </style>
</head>
<body>
<div class="container-fluid" >
<?php
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









   