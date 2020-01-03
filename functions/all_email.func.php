<?php
require("constante.php") ;
// verifie si les sessions sont valides sinon redirige. Doit ete appelé sur toutes les pages *.func.php
verifierSession() ;
$db = connectDatabase();
$erreurSuppression= "" ;
if (isset($_POST['id'])&& $_POST['email'])
{
    try
    {
        $db->startTransaction();        
        $req = $db->prepare('SELECT maildir FROM `virtual_users` WHERE id=:id') ;
        $req->execute (array('id'=>$_POST['id'])) ;
        $don = $req->fetch() ;
        if ($don)
        {
            $req = $db->prepare('DELETE FROM `virtual_users_infos` WHERE `virtual_user_id`=:id ') ;
            $req->execute(array(
                'id'       => $_POST['id']        
            )) ;
            $req->closeCursor() ;
            $req = $db->prepare('DELETE FROM `virtual_users` WHERE `id` =:id AND `email`=:email ') ;
            $req->execute(array(
                'id'       => $_POST['id'], 
                'email'    => $_POST['email']          
            )) ;
            $req->closeCursor() ;
            if($db->commit() )
            {
                $chemin = '/externe/mail/users/'.$don['maildir'] ;
                exec('sudo /deleteMail.sh ' .$chemin);
                $erreur ="MAIL_DELETE" ;                
            }
        }
    }
    catch (Exception $e)
    {
        $db->rollBack() ;  
        exit;
    }
}
?>

