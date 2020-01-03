<?php

$ERREUR = 'OK' ;
//Fonction connection à la base de donnée
function connectDatabase ()
{
	try
	{
		$db = new PDO('mysql:host=localhost;dbname=messagerie;charset=utf8', 'messagerieUser','isidore',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)) ;
	}
	catch (Exception $e)
	{
		die ('Erreur: '.$e->getMessage()) ;
	}
	return $db ;
}
// Fonction qui gère les erreurs et retourne le type d'erreur
function retourneErreur ($var)
{
    $retour = '' ;
    switch ($var)
    {
        case 'OK' :
            $retour = "OK" ;
            break ;
        case 'IDENTIFIANTS_INCORRECTS' :
            $retour = "Les identifiants sont incorrectes " ;
            break ;
        case 'CHAMPS_VIDES':
            $retour = "Les champs sont vides" ;
            break ;
        case 'PASSWORD_INCORRECT' :
            $retour = "Les deux mots de passes ne sont pas identiques" ;
            break ;
        case 'PASSWORD_FAIBLE' :
            $retour = "Le mot de passe est faible doit contenir une minuscule , une majuscule, un métacaractere EX:[\#!|^$;:%~-&\"'`()[]{}?+*.]) et un chiffre" ;
            break ;
        
        case 'PASSWORD_HASH_ERROR' :
            $retour = "Impossible de hascher le mot de passe. Veuillez  réessayer et si le problème persiste, veuillez contacter les dévéloppeurs" ;
            break ;
        case 'MAIL_INCORRECT' :
            $retour = "Le mail entrez est incorect ou invalide" ;
            break ;
        case 'TELEPHONE_INVALIDE' :
            $retour = "Le numéro de téléphone rentré est invalide. Doit respecté certaines spécifications" ;
            break ;
        case 'MATRICULE_INVALIDE' :
            $retour = "Le numéro de matricule rentré est invalide. Doit respecté certaines spécifications" ;
            break ;
        case 'DATE_INVALIDE' :
            $retour = "La date d'expiration est invalide. Doit respecté certaines spécifications" ;
            break ;
        case 'DATE_TROP_GRAND' :
            $retour = "La date d'expiration est trop grande. Doit pas dépassé 5 ans" ;
            break ;
        case 'NOM_TROP_LONG' :
            $retour = "Le nom rentré est trop long. Doit respecté certaines spécifications." ;
            break ;
        case 'PRENOM_TROP_LONG' :
            $retour = "Le ou les prenoms rentré(s) est(sont) trop long(s). Doit respecté certaines spécifications." ;
            break ;
        case 'PAYS_TROP_LONG' :
            $retour = "Arreter de vous amusez à modifier le formulaire petit hacker, nous vous observons." ;
            break ;        
        case 'MAIL_EXIST' :
            $retour = "Le mail que vous essayez de creer existe déja" ;
            break ;
        case 'MAIL_CREATION_SUCCESS' :
            $retour = "Le nouveau compte a eté bien créé" ;
            break ;        
        case 'SESSION_NOT_EXIST':            
            $retour = "Votre session est désactivé" ;
            break ;
        case 'SESSION_INCORRECT':            
            $retour = "Problème dans les sessions veuillez vous reconnecter" ;
            break ;
        case 'INSERTION_ERREUR' :
            $retour = "Problème d'insertion dans la base de données. Veuillez bien renseigner les champs s'il vous plait" ;
            break ;         
        case 'INCONNU' :
            $retour = "Problème inconnu" ;
            break ;          
            
        default:            
            $retour = 'Désolé il a eu un problème inconnu réessayez' ;
            break ;
            
    }
    return $retour ;
}

function verifierSession()
{
    if ( session_status()== PHP_SESSION_DISABLED )
    {
        $error= 'SESSION_NOT_EXIST' ;
        header ('Location: index?page=loginadmin&error='.$error);
        exit ;
    }
    if (session_status()== PHP_SESSION_NONE )
    {
        $error= 'SESSION_NOT_EXIST' ;
        session_destroy() ;
        header ('Location: index?page=loginadmin&error='.$error);
        exit ;   

    }
    if ( !isset($_SESSION['state']))
    {
        $error= 'SESSION_INCORRECT' ;
        $_SESSION[] = array() ;
        session_destroy() ;
        header ('Location: index?page=loginadmin&error='.$error);
        exit ;

    }
    if ( isset($_SESSION['state']) && $_SESSION['state'] != true)
    {
        $error= 'SESSION_INCORRECT' ;
        $_SESSION[] = array() ;
        session_destroy() ;
        header ('Location: index?page=loginadmin&error='.$error);
        exit ;
    }  
}


?>