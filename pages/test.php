<?php
    
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
    */
    function protectionForm($var)
    {
        return htmlspecialchars($var) ;
        
        
    }
    echo $_POST['email'] ."\n".$_POST['password'] ;
    
    if ( isset($_POST['email']) && isset($_POST['password']))
    {
        //header('Location:index.php?page=loginadmin')   ;
    }
    else
    {
        //header('Location:index.php?page=loginadmin')   ;      
        
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
    $donnee = $req1->fetch() ;
    // On verifie que les identifiants sont corrects
    if ( empty($donnee))
    {
        // header ('Location: index?page=loginadmin');
        echo "Identifiant incorrect" ;
    } // On initialise les sessions 
    else 
    {
        $_SESSION['email'] = $donnee['email'] ;
        $_SESSION['prenom'] = $donnee['prenom'];
        $_SESSION['nom'] = $donnee['nom'] ;
        $_SESSION['ip'] = $_SERVER['HTTP_HOST'] ;      
    }        
    /*
    if ( donnee['email'] !=$emailA || $donnee['password'] != $passwordHach)
    {
         echo "Mot ded passe incorrect" ;
        //header('Location: index.php?page=loginadmin') ;
        
    } */
    $req1->closeCursor() ;
?>