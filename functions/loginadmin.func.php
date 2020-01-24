<?php
require ("constante.php") ;

$error = "" ;
function protectionForm($var)
{
    return htmlspecialchars($var) ;       
}
if ( session_status()== PHP_SESSION_ACTIVE && isset($_SESSION['state']) && $_SESSION['state']== true )
{
    
    header('Location: index.php?page=home') ;
}
if ( isset($_POST['email']) && isset($_POST['password']))
{
    sleep(1) ; // On met en pause une seconde ralentir les attaques par brute force
    $emailAdmin = protectionForm($_POST['email']) ;
    //On supprime les retour à la ligne
    $emailAdmin = str_replace(array("\n","\r",PHP_EOL),'',$emailAdmin);
    $passwordAdmin = protectionForm($_POST['password']) ;
    try
    {
        $bdd = new PDO('mysql:host=localhost;dbname=messagerie;charset=utf8','messagerieUser','isidore',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)) ;

    } catch (Exception $e)
    {
 
        dye('Erreur : ' .$e->getMessage()) ;
    }
    //On recupere le login et mot de passe dans la base de donnée
    $req1 = $bdd->prepare('SELECT * FROM admin WHERE email=:mail') ;
    $req1->execute( array(
    'mail' =>  $emailAdmin        
    )) ;
    $donnee = $req1->fetch() ;
    
    if (!$donnee) // S'ils sont incorrectes
    {  
        $error = "IDENTIFIANTS_INCORRECTS";            
        header ('Location: index.php?page=loginadmin&error='.$error);
        exit;

    } // On initialise les sessions si bon 
    else 
    {
        //On verifie que les identifiants sont corrects
        $isPaswwordCorrect = password_verify($passwordAdmin,$donnee['password']) ;
        if ($isPaswwordCorrect)
        {               
            $_SESSION['state'] = true ;
            $_SESSION['ip'] = $_SERVER['REMOTE_ADDR'] ;
            $_SESSION['email'] = $donnee['email'] ;
            $_SESSION['prenom'] = $donnee['prenom'];
            $_SESSION['nom'] = $donnee['nom'] ;
            $_SESSION['ip'] = $_SERVER['REMOTE_ADDR'] ; 
            //Temps de déconnexion automatique du serveur
            $_SESSION['timeOver'] = time() ;
            $req1->closeCursor() ;
            header('Location: index.php?page=home') ;
            exit;      
        }
        else if (!$isPaswwordCorrect)
        {
            $error = "IDENTIFIANTS_INCORRECTS";            
            header ('Location: index.php?page=loginadmin&error='.$error) ;
            exit;  
        }
    }  
        // On signale qu'on a fini
        $req1->closeCursor() ;
}   

?>