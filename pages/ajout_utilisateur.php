<?php
//Connexion à la base de donnée
function connectDatabase ()
{
	try
	{
		$db = new PDO('mysql:host=localhost', dbname='messagerie', 'messagerieUser','isidore') ;
	}
	catch (Exception $e)
	{
		die ('Erreur: '.$e->getMessage()) ;
	}
	return $db ;

}
// Verifier les champs
function verifier($req,$par)
{
	return preg_match($req, $par) ;
}

$regMail= "#^[a-z0-9_-]*@.eneam.da$#" ;
$regPassword = "#[a-z]+[A-Z]+[0-9]+[\#!^$()[\]{}?+*.\-#" ;
$error =
{
	'email' = 'NOT_OK';
	'password'= 'NOT_OK' ;
	'emailExist' = 'NOT_OK' ;
	'idExist' = 'NOT_OK';
}
function verifierComposant()
{
	$etat = 0;
	if (verifier (regMail, post['email']) ==false)
	{
		$error.email ='NOT_OK';
		etat +=;
	}
	else
	{
		$error.email ='OK';
	}
	if (verifier (regMail, post['password']) == false )
	{
		$error.password ='NOT_OK';
		etat += ;		
	}
	else
	{
		$error.password ='OK';
	}
	return etat ;

}
if (verifierComposant()!=0)
{
	header('Location:../index.php?email=$error.email&password=$error.password') ;
}

$db = connectDatabase() ;
$debutMail = explode('@', $_POST['email'])[0];
$req = $db.exec ('SELECT email as $mail FROM virtual_users WHERE email=$debutMail') ;
if ($mail)
{
	$error.emailExist = OK ;
}





?>