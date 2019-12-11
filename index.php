<?php
    // Pour generer les sessions
session_start() ;
$_SESSION['email'] = "houessoupicasso@eneam.da" ;
$_SESSION['ip'] = "0.0.0.0" ;


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
<html>
<head>
	<meta name="viewport" >
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="dist/css/bootstrap.css">
	
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

<?php
    include 'pages/'.$page.'.php';
?>

<?php
	include "body/footer.php";
?>
</div>
</body>


</html>









   