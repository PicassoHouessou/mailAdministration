<?php
//require_once("../functions/constante.php") ;
// verifie si les sessions sont valides sinon redirige. Doit ete appelé sur toutes les pages *.func.php
verifierSession() ;
$cheminScript = "/externe/www/html/www.admin.eneam.da/scripts/" ;
$service = array(
    'apache2'   =>'apache2' ,
    'phpfpm'   => 'php7.2-fpm' ,
    'nginx'   =>    'nginx',
    'postfix'    => 'postfix' ,
    'dovecot'   =>  'dovecot' ,
    'all'       =>  'all'
    
    ) ;    
foreach ( $service as $cle=>$element)
{
    if (isset($_POST[$cle])&& ($_POST[$cle]=='restart'||$_POST[$cle]=='stop'))
    {
        $result= 1;
        $_POST[$cle] = escapeshellcmd($_POST[$cle] ); // en realité inutile mais on fait ça qu'en meme l'ecces de sécurité tue pas
        exec('sudo '.$cheminScript.'restartOrStopService.sh' .$_POST[$cle].' '.$element , $ligne, $result);
        //Sil'operation a réussie 
        if ($result ==0)
        {
            if($element=='all')
                 echo 'all|'.$_POST[$cle];
            else
                echo $cle.'|'.$_POST[$cle];            
        }
        else
        {
            if($element=='all')
                 echo 'all|erreur|'.$_POST[$cle];
            else
                echo $cle.'|erreur|'.$_POST[$cle];  
        }
    }
    //Si on n'a demandé le statut d'un service, un et un seul service à la fois 
    //Alors on execute le script qui renvoie l'etat d'un service
    if (isset($_POST[$cle])&& ($_POST[$cle]=='status' && $cle!='all' && $_POST['cle']!='all') )
    {
        exec ('sudo '.$cheminScript.'statusService.sh '. $element, $ligne, $result) ;
        if ($result==0)
        {
            echo $cle.'|start' ;
            
        }
        else 
        {
            echo $cle.'|stop' ;            
        }
        
    }
}
$erreurSuppression= "" ;
if (isset($_POST['id']) && $_POST['email'])
{
    $db = connectDatabase();
    $matricule = NULL ;
    $id =  htmlspecialchars( $_POST['id'] );
    $id = (int) $id ;
    $email = htmlspecialchars( $_POST['email'] );
    $email = str_replace(array("\n","\r",PHP_EOL),'',$email);
    $email = (string) $email ;
    
    try
    {
        $db->startTransaction();        
        $req = $db->prepare('SELECT maildir FROM `virtual_users` WHERE id=:id AND email=:email') ;
        $req->execute (
            array(
                'id'=>$id,
                'email'=> $email
            )) ;
        $don = $req->fetch() ;
        if ($don)
        {
            $req->closeCursor() ;
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
                $chemin = '/externe/mail/users/'.$don['maildir'] ;
                $retour = 1 ;
                exec('sudo '.$cheminScript.'deleteUserDirectory.sh ' .$chemin , $ligne, $retour);
                if ($retour == 0)
                {
                    echo $email.'|split|delete' ;                     
                }
                else 
                {
                    echo $email.'|split|notdelete' ;                     
                }                              
            }
        }
    }
    catch (Exception $e)
    {
        $db->rollBack() ; 
        echo $email.'|split|erreur|split|notdelete' ;
        //exit;
    }
}
?>

