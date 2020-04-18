<?php

require("constante.php") ;

// verifie si les sessions sont valides sinon redirige. Doit ete appelé sur toutes les pages *.func.php
verifierSession() ;
deconnexionAuto() ;
function afficheRetour($var)
{
    return  "<script type=\"text/javascript\">alert(\"{$var}\");</script>" ; 
}
$GLOBALS['afficheRetour'] = NULL ;

if (  isset ($_GET['email']) && isset ($_GET['type']) && isset($_GET['id']) )
{    
    $email = (string)  htmlspecialchars ($_GET['email']) ;
    $id= (int) htmlspecialchars ($_GET['id']) ;
    $type = (string)  htmlspecialchars ($_GET['type']) ;
    $type = strtoupper ($type) ;
    
    if ($type =='DELETE')
    {
        $db = connectDatabase();
        try {
            $db->beginTransaction() ;
            $req = $db->prepare ( 'DELETE FROM `admin` WHERE `id`=:id AND `email`= :email ') ;
            $req->execute (array ("id" =>$id , "email" => $email ));
            if ($db->commit())
            {
                $GLOBALS['afficheRetour'] = afficheRetour("Le compte administrateur a été supprimé avec success ") ;
                $db = NULL ;
                goto sortie;
            }
        } catch (Exception $e)
        {
            $GLOBALS['afficheRetour']  = afficheRetour("Impossible de supprimer le compte administrateur ") ;
            $db = NULL ;
            goto sortie;
        }

    } else if ($type == 'DISABLE')
    {
        
        $db = connectDatabase();
        try {
            $db->beginTransaction() ;
            $req = $db->prepare ( 'UPDATE `admin` SET `state` = NOT `state` WHERE id=:id AND email=:email  ') ;
            $req->execute (array ("id" =>$id , "email" => $email ));
            if ($db->commit())
            {
                $GLOBALS['afficheRetour']  = afficheRetour("L'état du compte administrateur a correctement changé") ;
                $db = NULL ;
                goto sortie;
            }
        } catch (Exception $e)
        {
            $GLOBALS['afficheRetour'] = afficheRetour("On n'a pas pu changer l'etat du compte administrateur ") ;
            $db = NULL ;
            goto sortie;
        }

    }


}

if (
    isset ($_POST['Aemail']) && !empty($_POST['Aemail']) &&
    isset ($_POST['Apassword']) && !empty($_POST['Apassword']) &&
    isset ($_POST['ApasswordConfirm']) && !empty($_POST['ApasswordConfirm']) 

)
{   
    $email =  htmlspecialchars( $_POST['Aemail'] ) ; 
    $email = (string) $email ;
    if ( filter_var($email, FILTER_VALIDATE_EMAIL) == FALSE || strlen($email) >200 || preg_match('#^(.+)(@eneam\.da)$#', $email) == false   )
    {
        $GLOBALS['afficheRetour'] = afficheRetour("L'adresse email entrée est invalide") ;   
        $db = NULL ;         
        goto sortie;
    }

    $password =  $_POST['Apassword'] ;
    $passwordConfirm = $_POST['ApasswordConfirm'] ;

    $regPassword = '#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W)#';   
    //$regDate = "/^([2-3][0-9]{3})(-)((0[1-9])|(1[012]))(-)((0[1-9])|([1-2][0-9])|(3[01]))$/" ;    

    if ($password != $passwordConfirm) 
    {
        
        $GLOBALS['afficheRetour'] = afficheRetour("Les mots de passe ne correspondent pas") ;        
        goto sortie;
    }// si les mot de passes sont les meme ont vérifie leur entropies
    if (preg_match($regPassword, $password) == false )
    {
        $GLOBALS['afficheRetour'] = afficheRetour("Le mot de passe doit avoir une forte entropie") ;  
        $db = NULL ;          
        goto sortie;             	
    }   
    else{
        // On hash le mot de passe
        $password = password_hash($password, PASSWORD_ARGON2I ) ;
        if ($password==false)
        {
            $GLOBALS['afficheRetour'] = afficheRetour("Erreur liée au hashage du mot de passe" ) ;  
            $db = NULL ;    
            goto sortie;
        }
    }
    $db = connectDatabase();

   
    // Dans le cas ou il s'agit d'une modification de mot de passe 
    if (isset ($_POST['adminModifyPassword'])  )
    {
        //&& strtolower( $_POST['adminModifyPassword']) == 'adminModifyPassword'
        echo "jdhdhdhd" ; exit ;
        try {
            $req = $db->prepare ('UPDATE TABLE `admin` SET `password` =:pass ') ;
            $req->execute(array ('pass' => $passwordConfirm)) ;

            if ($db->commit()) 
            {
                $GLOBALS['afficheRetour'] = afficheRetour("Le mot de passe a été modifié avec success" ) ;  
                $db = NULL ;    
                goto sortie;
            }

        } catch (Exception $e)
        {
            $db->rollBack() ; 
            $GLOBALS['afficheRetour'] = afficheRetour("Un problème est survenu, nous n'avons pas pu changer le mot de passe." ) ;  
            $db = NULL ;    
            goto sortie;

        }
        

    }

    $req0 = $db->query ('SELECT COUNT(*) FROM `admin`') ;
    $nombreCompte = (int) $req0->fetch();
    $req0->closeCursor() ;
    
    if ($nombreCompte>=11)
    {
        $GLOBALS['afficheRetour'] = afficheRetour("Vous ne pouvez pas créer au dela de  dix comptes administrateurs" ) ;    
        $db = NULL ;    
        goto sortie;
    }
    try 
    {
        $db->beginTransaction(); 
        $req1= $db->prepare('INSERT INTO `admin` (`email`,`password`) VALUES (:email, :pass)') ;
        $req1->execute(array(
            'email' => $email ,
            'pass'      => $password 
        )) ;
        $req1->closeCursor() ;    
    
        if($db->commit() )
        {
            $GLOBALS['afficheRetour'] = afficheRetour("Le compte a été créé" ) ;        
            goto sortie;                
        }   
    }  catch (Exception $e)
    {
        $db->rollBack() ; 
        $GLOBALS['afficheRetour'] = afficheRetour("Le compte n'a pas pu etre créé" ) ;        
        goto sortie;                       
    }

}


sortie:
$db = connectDatabase();

$req = $db->prepare('SELECT * FROM `admin` WHERE `email` !=:email');
$req->execute(array('email'=>'master@eneam.da')) ;
//$don = $req->fetchAll();

?>