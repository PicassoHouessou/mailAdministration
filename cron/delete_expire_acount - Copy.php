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

$db = connectDatabase();
$req =  ('DELETE FROM `virtual_user` WHERE  ')
//Pour supprimer un compte 
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

?>