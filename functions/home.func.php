<?php
/*
    $error = array
    (
        'value' => '' , // Valeur possible 
        'info' => '' 
        
    );
        
    
    
    /*function connectDatabase (string $dsn , string $username, string $passwd, array $options)
    {
        try
        {
            $bdd = new PDO ($dsn, $username, $passwd, $options);
        } catch (Exception $e) 
        {
             die('Erreur : ' . $e->getMessage());
        }
        return $bdd ;
    }
    
    function protectionForm($var)
    {
        return htmlspecialchars($var) ;
        
        
    }
    
    
    if ( isset($_POST['email']) && isset($_POST['password']))
    {
        
                                                                    
    }
    else
    {
        $error['value'] = "CHAMP_VIDE" ;
        $error['info'] = "Les champs sont vides" ;
        header('Location:index.php?page=loginadmin&amp;errorValue='.$error['value']) ; 
        //On s'assure que le code qui suis ne sera pas exécuté
        exit;
        
    }    
    $emailA = protectionForm($_POST['email']) ;
    $passwordA = protectionForm($_POST['password']) ;
    $passwordHach = password_hash($passwordA,PASSWORD_ARGON2I) ;
    
    try
    {
        $bdd = new PDO('mysql:host=localhost;dbname=messagerie;utf8','messagerieUser','isidore',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)) ;

    } catch (Exception $e)
    {
        dye('Erreur : ' .$e->getMessage()) ;
    }
   
    $req1 = $bdd->prepare('SELECT email , password, nom, prenom FROM admin WHERE email=:mail AND password=:pass') ;
    $req1->execute( array(
    'mail' =>  $emailA ,
    'pass' =>  $passwordHach        
    )) ;
    
    //On verifie que les identifiants sont corrects
    if (!$donnee) // S'ils sont incorrectes
    {
        $error['value'] = "IDENTIFIANTS_INCORRECTS";
        $error['info'] = "Vos identifiants sont incorrets" ;        
        header ('Location: index?page=loginadmin&amp;errorValue='.$error['value']);
        exit;
    } // On initialise les sessions si bon 
    else 
    {
        $_SESSION['email'] = $donnee['email'] ;
        $_SESSION['prenom'] = $donnee['prenom'];
        $_SESSION['nom'] = $donnee['nom'] ;
        $_SESSION['ip'] = $_SERVER['REMOTE_ADDR'] ;      
    }  
    // On signale qu'on a fini
    $donnee = $req1->fetch() ;
    // Maintenant on doit s'assurer que les sessions marchent sinon on redirige vers les  la page de login
    if($_SESSION['email'] = "" && empty($_SESSION['email']) )
    {
        $error['value'] = "INCONNU";
        $error['info'] = "Problème inconnu, contacter l'administrateur" ;        
        header ('Location: index?page=loginadmin&amp;errorValue='.$error['value']);
        exit ;        
    }
    
    $req1->closeCursor() ;
*/
?>

