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


//$req= $db->query('SELECT `virtual_users`.`id` AS `id`, `email` , maildir FROM `virtual_users`, `virtual_users_infos` WHERE `virtual_users_infos`.`date_fin`= ADDDATE( CURDATE(), INTERVAL 90 DAY )');
$req= $db->query('SELECT `virtual_users`.`id` AS `id`, `email` , maildir FROM `virtual_users`, `virtual_users_infos` WHERE `virtual_users_infos`.`virtual_user_id`= `virtual_users`.`id` ');
//$don = $req->fetch () ;
$req->closeCursor();
while ($don=$req->fetch ())
{
	echo $don['email']."<br>" ;
} 
/*
while ($don)
{
	$id =  $don['id'] ;
	$email = $don['email'] ;
	$db->beginTransaction();
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

/*
//$date = date() ;
$db->query ('SET FOREIGN_KEY_CHECKS = 0 ') ;
try{
$req = $db->exec('DELETE FROM `virtual_users`, `virtual_users_info` WHERE `virtual_user`.`date` <= ADDDATE(CURDATE(), INTERVAL 90 DAY ) AND  `virtual_users_info`.`id` = `virtual_users`.`id` ') ;
if ($db->commit())
{
	echo "success"; exit ;

}
//$req->execute (array ('date'=>$date ));
} catch(Exception $e)
{
	die ('Erreur: '.$e->getMessage()) ;
	$db->rollBack(); 
	echo "Erreur" ;
}
/*


$req = $db->prepare ('DELETE FROM  `virtual_users_info` WHERE `virtual_user`.`date`<:date AND  `virtual_users_info`.id = `virtual_user`.`id` ') ;
$req->execute (array ('date'=>$date ));
$req = $db->prepare ('DELETE FROM `virtual_user`WHERE `virtual_user`.`date`<:date') ;
$req->execute (array ('date'=>$date ));


$db->query ('SET FOREIGN_KEY_CHECKS = 0 ') ;
exit ;
*/
?>