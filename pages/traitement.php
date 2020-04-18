<?php
session_start();
require_once("../functions/constante.php") ;
/** verifie si les sessions sont valides sinon redirige. On ne doit en aucun cas travaillé sur cette page si les sessions sont pas actives
* Sinon un etranger risque de planter le serveur
* @details Traite les données (ajax) envoyées par les pages ajout_utilsateur.php et all_email.php
*/
verifierSession() ;
$cheminScript = "/externe/www/html/www.admin.eneam.da/public_html/scripts/" ;
$service = array(
    'apache2'   =>'apache2' ,
    'phpfpm'   => 'php7.2-fpm' ,
    'nginx'   =>    'nginx',
    'postfix'    => 'postfix' ,
    'dovecot'   =>  'dovecot' , /* ,
    'spamassassin' => 'spamassassin' ,
    'vsftpd'         => 'vsftpd' , */
    'all'       =>  'all'   
    ) ;  
foreach ( $service as $cle=>$element)
{
    if (isset($_POST[$cle]) &&  ( $_POST[$cle]=='restart' || $_POST[$cle]=='stop' ) )
    {
        $result= 1;
        $_POST[$cle] = escapeshellcmd($_POST[$cle] ); // en realité inutile mais on fait ça qu'en meme l'ecces de sécurité tue pas
        exec('sudo '.$cheminScript.'restartOrStopService.sh '.$_POST[$cle].' '.$element , $ligne, $result);
        //echo 'sudo '.$cheminScript.'restartOrStopService.sh ' .$_POST[$cle].' '.$element ;
        //Sil'operation a réussie 
        if ($result == 0)
        {
            echo $cle.'|'.$_POST[$cle];  
            exit ;
        }
        else
        {
            echo $cle.'|erreur|'.$_POST[$cle]; 
            exit ;
        } 
    }
    //Si on n'a demandé le statut d'un service, un et un seul service à la fois 
    //Alors on execute le script qui renvoie l'etat d'un service
    if (isset($_POST[$cle]) && ( $_POST[$cle]=='status' && $cle != 'all' && $_POST[$cle] != 'all') )
    {
        $resultStatus = 1 ;
        //passthru ('sudo '.$cheminScript.'statusService.sh'.' '.$element, $resultStatus) ;
        //exec ('sudo '.$cheminScript.'statusService.sh '.$element, $ligne2, $resultStatus) ;
        exec('sudo '.$cheminScript.'statusService.sh '.$_POST[$cle].' '.$element , $ligne2, $resultStatus);
        if ( $resultStatus == 0 )
        {
            echo $cle.'|restart' ;
            $resultStatus = 1 ;
            exit ;
        }
        else 
        {
            echo $cle.'|stop' ;
            $resultStatus = 1 ;
            exit ;
        } 
    } 
}
//Pour supprimer un compte 
if (isset($_POST['id']) && isset($_POST['email']) )
{
	
    $db = connectDatabase();
    $id =  htmlspecialchars( $_POST['id'] );
    $id = (int) $id ;
    $email = htmlspecialchars( $_POST['email'] );
    $email = str_replace(array("\n","\r",PHP_EOL),'',$email);
    $email = (string) $email ;    
    try
    {        
        $db->beginTransaction();        
        $req = $db->prepare('SELECT maildir FROM `virtual_users` WHERE id=:id AND email=:email') ;
        $req->execute (
            array(
                'id'=>$id,
                'email'=> $email
            )) ;
        $don = $req->fetch() ; 
		
        //Si le compte email existe on supprime les tables associés
        if ($don)
        {
			
			
            $req->closeCursor() ; 
            //NB: Nous utilisons ON DELETE CASCADE pour la clé etrangere dans MYSQL donc la ligne suivante est inutile
            $req = $db->prepare('DELETE FROM `virtual_users_infos` WHERE `virtual_user_id`=:id') ;
            $req->execute(array(
                'id'       => $id            
            )) ; 
            $req->closeCursor() ;
            
            $req = $db->prepare('DELETE FROM `virtual_users` WHERE `id` =:id AND `email`=:email ') ;
            $req->execute(array(
                'id'       => $id, 
                'email'    => $email         
            )) ;
            $req->closeCursor() ;
			
            // Si tout est ok on lance le script qui doit supprimer le repertoire de l'utilisateur
            if($db->commit() )
            {
                //Ici on recupere le nom du repertoire à supprimer 
                // C'est le script de supression qui s'occupe de supprimer ce repertoire dans le bon chemin
                $nomRepertoire = explode('/',$don['maildir'])[1] ;
                $retour = 1 ;
                exec('sudo '.$cheminScript.'deleteUserDirectory.sh ' .$nomRepertoire, $ligne, $retour);
                if ($retour == 0)
                {
                    echo $email.'|split|MAIL_DELETE_SUCCESS' ;  
                    exit ;                  
                }
                else 
                {
                    echo $email.'|split|MAIL_DELETE_SUCCESS_BUT_DIRECTORY_DELETE_NOT_SUCESS' ;
                    exit ;                    
                }                              
            }
        }
    }
    catch (Exception $e)
    {
		
        $db->rollBack() ;  echo $_POST['email'] ; exit ;
        echo $email.'|split|MAIL_DELETE_ERROR' ;
        exit ;
    }
	exit ;
}

// Pour activer ou desactiver un compte
if ( isset($_POST['email']) &&  isset($_POST['toggleCompteState']))
{
    $db = connectDatabase();    
    $email = htmlspecialchars( $_POST['email'] );
    $email = str_replace(array("\n","\r",PHP_EOL),'',$email);
    $email = (string) $email ;  
    try 
    {
        $db->beginTransaction(); 
        $req = $db->prepare('UPDATE `virtual_users` SET `state` = NOT  `state` WHERE email=:email') ;
        $req->execute (
            array(
                'email'=> $email
            )) ;
        $req->closeCursor() ;
            // Si tout est ok on lance le script qui doit supprimer le repertoire de l'utilisateur
            if($db->commit() )
            {
                echo $email.'|split|MAIL_TOGGLE_SUCCESS' ; exit ;                  
            }   
    }  catch (Exception $e)
    {
        $db->rollBack() ; 
        echo $email.'|split|MAIL_TOGGLE_ERROR' ;  
        exit ;                  
    }

}
       
// Pour modifier le mot de passe 
if ( isset($_POST['email']) &&  isset($_POST['newPassword']) && isset ($_POST['newPasswordConfirm']))
{
    $db = connectDatabase();    
    $email = htmlspecialchars( $_POST['email'] );
    $email = str_replace(array("\n","\r",PHP_EOL),'',$email);
    $email = (string) $email ; 
    sleep(1) ; // On met en pause une seconde ralentir les attaques par brute force
    $password = $_POST['newPassword'] ;
    $passwordConfirm = $_POST['newPasswordConfirm'] ;     
    $regPassword = '#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W)#';       
    if ($password != $passwordConfirm) 
    {
        echo $email.'|split|MAIL_MODIFY_ERROR' ;   exit ;
    }// si les mot de passes sont les meme ont vérifie leur entropies
    if (preg_match($regPassword, $password) == false )
    {
        echo "passerrordiffrent" ; exit;
        echo $email.'|split|MAIL_MODIFY_ERROR' ; exit ;       	
    }   
    else{
        // On hash le mot de passe
        $password = password_hash($password, PASSWORD_ARGON2I ) ;
        if ($password==false)
        {
            echo $email.'|split|MAIL_MODIFY_ERROR' ;   exit ;
        }
    }
    try 
    {
        $db->beginTransaction(); 
        $req1= $db->prepare(' UPDATE  `virtual_users` SET `password` = :pass WHERE email=:email ') ;
        $req1->execute(array(
            'email' => $email ,
            'pass'      => $password 
        )) ;
        $req1->closeCursor() ;    
    
        if($db->commit() )
        {  
            echo $email.'|split|MAIL_MODIFY_SUCCESS' ;  exit ;                  
        }   
    }  catch (Exception $e)
    {
        $db->rollBack() ; 
        echo $email.'|split|MAIL_MODIFY_ERROR' ;  
        exit ;                  
    }
    exit;
	
}



if (
    isset ($_POST['nom']) && empty($_POST['nom']) != true &&
    isset ($_POST['prenom']) && empty($_POST['prenom']) != true &&
    isset ($_POST['email']) && empty($_POST['email']) != true &&
    isset ($_POST['telephone']) && empty($_POST['telephone']) != true &&
    isset ($_POST['message']) && empty($_POST['message']) != true
)
{
    function protectionForm($var)
    {
        $var = htmlspecialchars($var) ;
        $var =  str_replace(array("\n","\r",PHP_EOL),'',$var);
        $var = (string) $var ;
        return $var ;     
    } 
    $nom = protectionForm($_POST['nom'] );
    $prenom = protectionForm($_POST['prenom'] );
    $email = protectionForm($_POST['email'] );
    $telephone = protectionForm($_POST['telephone'] );
    $nom = protectionForm($_POST['message'] );
    $message = protectionForm($_POST['message']) ;
    if ( filter_var($email , FILTER_VALIDATE_EMAIL) ==false )
    {
        echo false.'|Email non valide'; 
        exit ;
    }
    //Envoi du premier mail
        $to      = 'admin@eneam.da' ;
        $subject = 'Nous contacter ';
        // Dans le cas où nos lignes comportent plus de 70 caractères, nous les coupons en utilisant wordwrap()
        $message = wordwrap($message, 70, "\r\n");
        $headers = 'From:'.$email . "\r\n" .
        'Reply-To: admin@eneam.da' . "\r\n" .
        'X-Mailer: PHP/' . phpversion();
        if( mail($to, $subject, $message) )
        {
            echo true.'|Votre envoi a été effectué';
            exit ;
            
        }
        else 
        {
            echo false.'|Envoi non réussie' ;
            exit ;
        }
    
}

?>

