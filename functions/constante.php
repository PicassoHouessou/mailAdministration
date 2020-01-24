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
        case 'MAIL_CREATION_SUCCESS_BUT_DIRECTORY_CREATION_NOT' :
            $retour = "Le nouveau compte a eté créé. Seulement nous n'avons pas pu créer son répertoire de réception des mails. Ce utilisateur peut toujours se connecter à compte et recevoir des mails." ;
            break ;
        case 'SESSION_NOT_EXIST':            
            $retour = "Votre session est désactivé" ;
            break ;
        case 'SESSION_TIME_OVER':            
            $retour = "15 minutes d'inactivités. Vous avez été déconnecté automatiquement" ;
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
            $retour = 'Désolé il a eu un problème inconnu. Réessayez' ;
            break ;            
    }
    return $retour ;
}

//Fonction pour afficher une info d'erreur sur les pages
function afficherErreur ()
{
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
        echo '<script>window.setTimeout(function() {
        $(".alert").fadeTo(500, 0).slideUp(500, function(){
            $(this).remove(); 
        });
        }, 2000);  </script>' ;
    }
}
function verifierSession()
{
    if ( session_status()== PHP_SESSION_DISABLED )
    {
        $error= 'SESSION_NOT_EXIST' ;
        header ('Location: index.php?page=loginadmin&error='.$error);
        exit ;
    }
    if (session_status()== PHP_SESSION_NONE )
    {
        $error= 'SESSION_NOT_EXIST' ;
        session_destroy() ;
        header ('Location: index.php?page=loginadmin&error='.$error);
        exit ;   

    }
    if ( !isset($_SESSION['state']))
    {
        $error= 'SESSION_INCORRECT' ;
        $_SESSION[] = array() ;
        session_destroy() ;
        header ('Location: index.php?page=loginadmin&error='.$error);
        exit ;

    }
    if ( isset($_SESSION['state']) && $_SESSION['state'] != true)
    {
        $error= 'SESSION_INCORRECT' ;
        $_SESSION[] = array() ;
        session_destroy() ;
        header ('Location: index.php?page=loginadmin&error='.$error);
        exit ;
    }  
}
//Fonction à revoir car consomme trop de mémoire
function verifierAuthenticiteSession()
{
    if ( isset ($_COOKIE['nbTimerNotDefPreg']) && isset($_SESSION['nbTimerNotDefPreg']) && $_COOKIE['nbTimerNotDefPreg'] == $_SESSION['nbTimerNotDefPreg'])
    {
        // C'est reparti pour un tour
        $nonce = random_bytes(SODIUM_CRYPTO_SECRETBOX_NONCEBYTES);
        $ticket = (int) session_id() + (int) $nonce ;    
        // on hash pour avoir quelque chose de propre qui aura toujours la même forme
        $ticket = password_hash($ticket, PASSWORD_ARGON2I);
        // On enregistre des deux cotés   
        $_SESSION['nbTimerNotDefPreg'] = $ticket ;
        setcookie('nbTimerNotDefPreg', $ticket, time() + 60 * 20, null, null, false, true);
               
    }
    else
    {
        // On détruit la session
        $_SESSION = array();
        session_destroy();
        header('location:index.php?erreur');
    }

    
}

function deconnexionAuto ()
{
    if (isset($_SESSION['timeOver']))
    {
        if (time() - $_SESSION['timeOver'] >(60*15) )
        {
            $error ='SESSION_TIME_OVER' ;
            // On détruit la session
            $_SESSION = array();
            session_destroy();
            header('location:index.php?page=loginadmin&error='.$error);
            exit ;
        }
        else
        {
            // On ajoutejuste le temps qu'il faut pour prolonger la durée des sessions de 30minutes        
            $_SESSION['timeOver'] =  time() ;
        }
        
    }
}
?>