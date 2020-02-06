
<?php
$error = '' ;
//   les champs
function verifier($req,$par)
{
	return preg_match($req ,$par) ;
}
function protectionForm($var)
{
    return htmlspecialchars($var) ;       
}
// On déclare toutes les variables qu'on va utiiser
$email= NULL;
$password =NULL ;
$passwordConfirm =NULL;
$dateFin =NULL;
$nom = NULL;
$prenom = NULL;
$matricule = NULL;
$telephone =NULL ;
$pays = NULL;
// ON FAIT TOUTES LES VERIFICATIONS DE BASE
if ( isset($_POST['email']) && isset($_POST['password']) && isset($_POST['passwordConfirm']))
{     
    sleep(1) ; // On met en pause une seconde ralentir les attaques par brute force
    $email = protectionForm($_POST['email']) ;
    //On supprime les retour à la ligne
    $email = str_replace(array("\n","\r",PHP_EOL),'',$email);
    $password = protectionForm($_POST['password']) ;
    $passwordConfirm = protectionForm($_POST['passwordConfirm']) ;
    // Nous pensons que ce regex est valide peut etre corrigé pour les emails spéciaux qui refusent de marcher
    //$regMail="#^[^\W][a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\@[a-zA-Z0-9_]{2,}(\.[a-zA-Z0-9_]+)*\.[a-zA-Z]{2,4}$#" ;
    //Ce regex pour le mail marche mais nous ne pouvons utiliser cela car nous utilisons la chaine avant le @ comme nom des repertoires ce qui va poser problème s'il a éventuellement  des caractères spéciaux puisque le nom d'un répertoire en linux ne peut pas conenir certains caractères :)
    //$regMail="#^[^\W][a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\@([a-zA-Z0-9_]{2,}\.)*(eneam\.da){1}$#" ;  
    $regMail = "#^[a-z0-9._-]+@([a-z0-9._-])*(eneam\.da){1}$#" ;
    $regPassword = '#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W)#';
    $regMatricule= "#(\d){4,}$#";
    $regTelephone = "#^(\d){8,}$#" ;
    $regDate = "/^([2-3][0-9]{3})(-)((0[1-9])|(1[012]))(-)((0[1-9])|([1-2][0-9])|(3[01]))$/" ;    
    
    if (isset($_POST['matricule'])&& empty($_POST['matricule'])!= true)
    {
        $matricule = protectionForm($_POST['matricule']) ;  
        $matricule = (int) $matricule ; // Il faut etre sur que c'est un nombre
        if (verifier ($regMatricule, $matricule) == false )
        {
            $error = "MATRICULE_INVALIDE" ;
            header ('Location: index.php?page=home&error='.$error);
            exit ;       	
        } 
    }
    if (isset($_POST['telephone']) && empty($_POST['telephone'])!= true)
    {
        $telephone = protectionForm($_POST['telephone']) ;  
        $telephone = (int) $telephone ; // Il faut etre sur que c'est un nombre
        if (verifier ($regTelephone, $telephone) == false )
        {
            $error = "TELEPHONE_INVALIDE" ;
            header ('Location: index.php?page=home&error='.$error);
            exit ;       	
        }         
    }
    if (isset($_POST['pays']) && empty($_POST['pays'])!= true)
    {
        $pays = protectionForm($_POST['pays']) ;
        $pays = (string) $pays ;
        if (strlen($pays)>150)
        {
            $error = "PAYS_TROP_LONG" ;
            header ('Location: index.php?page=home&error='.$error);
            exit ;            
        }
    }
    if (isset($_POST['nom']) && empty($_POST['nom'])!= true)
    {
        $nom = protectionForm($_POST['nom']) ;
        $nom = (string) $nom ;
        if (strlen($nom)>150)
        {
            $error = "NOM_TROP_LONG" ;
            header ('Location: index.php?page=home&error='.$error);
            exit ;            
        }
    }
    if (isset($_POST['prenom']) && empty($_POST['prenom'])!= true)
    {
        $prenom = protectionForm($_POST['prenom']) ;  
        $prenom = (string) $prenom ;
        if (strlen($prenom)>150)
        {
            $error = "PRENOM_TROP_LONG" ;
            header ('Location: index.php?page=home&error='.$error);
            exit ;            
        }
    }
    if (isset($_POST['dateFin']) && empty($_POST['dateFin'])!= true)
    {
        $dateFin = protectionForm($_POST['dateFin']) ; 
        $dateFin = (string) $dateFin ;
        if (verifier ($regDate, $dateFin) == false )
        {
            $error = "DATE_INVALIDE" ;
            header ('Location: index.php?page=home&error='.$error);
            exit ;       	
        } 
        $debutDate = explode('-', $dateFin)[0] ;
        $debutDate = (int) $debutDate ;
        // On verifie que la date n'est pas trop grande ne dépasse pas 6 ans , en réalité la date maximal d'espiration est 5 ans mais là on verifie juste 6ans . A reecrire plus tard
        if ($debutDate > (int) date('Y', strtotime('+6 years')))
        {
            $error = "DATE_TROP_GRAND" ;
            header ('Location: index.php?page=home&error='.$error);
            exit ;
            
        }
    }   
}
else
{
    sleep(1) ; // On met en pause une seconde ralentir les attaques par brute force
    $error  = "CHAMPS_VIDES" ;    
    header('Location:index.php?page=home&error='.$error) ; 
    //On s'assure que le code qui suis ne sera pas exécuté
    exit;        
}
// On fait les verifications qui nécessitent les regex
if ( verifier ($regMail, $email) == false)
{
    $error = "MAIL_INCORRECT";	     
    header ('Location: index.php?page=home&error='.$error);
    exit;
}
else
{
    sleep(1 ); // On ralenti les attaques par brutes forces    
    if ($password != $passwordConfirm) 
    {
        $error = "PASSWORD_INCORRECT" ;
        header ('Location: index.php?page=home&error='.$error);
        exit ;
    }// si les mot de passes sont les meme ont vérifie leur entropies
    if (verifier ($regPassword, $password) == false )
    {
        $error = "PASSWORD_FAIBLE" ;
        header ('Location: index.php?page=home&error='.$error);
        exit ;       	
    }   
    else{
        // On hash le mot de passe
        $password = password_hash($password, PASSWORD_ARGON2I ) ;
        if ($password==false)
        {
            sleep(1) ;
            $error ='PASSWORD_HASH_ERROR';
            header('Location:index.php?page=home&error='.$error);
            exit ;
        }
    }
}
// Arrivé ici on peut commencer les bases de donnes
//On se connect
$db = connectDatabase() ;
// On s'assure que le mail n'existe pas 
$req1 = $db->prepare('SELECT `email` FROM `virtual_users` WHERE email=:mail') ;
$req1->execute (array ('mail' => $email )) ;
//Si on trouve une valeur on sort sinon on continue
if ($req1->fetch())
{
    $error ="MAIL_EXIST" ;
    header ('Location: index.php?page=home&error'.$error);
    exit ;    
}
$req1->closeCursor() ;
//On ecrit dans la base 
//On recupere juste le debut du mail
$debutMail = explode('@', $_POST['email'])[0] ;
//$finMail = explode('@', $_POST['email'])[1] ; A considerer quand on voudra gerer plusieurs domaines
// On commence les transaction 
try 
{  
    $db->beginTransaction() ;
    $req2 = $db->prepare('INSERT INTO `virtual_users`(`domain_id`,`email`,`password`,`maildir`) VALUES (1, :email,:pass, :dir) ');
    $req2->execute(array(
        'email' => $email ,
        'pass'      => $password ,
        'dir'       => 'eneam.da/'.$debutMail.'/'
    )) ;
    $req2->closeCursor() ;    
    //On s'apprete à faire les jointures    
    /*
    $req3 = $db->prepare('SELECT id AS virtual_user_id FROM `virtual_users` WHERE email= :debutMail UNION INSERT INTO `virtual_users_infos`(`virtual_user_id`, `nom`, `prenom`,`matricule`, `telephone`, `pays`, `date_fin`) VALUES (virtual_user_id, :nomV, :prenomV,:matriculeV, :telephoneV, :paysV, :dateFinV) ');
    $req3->execute(array(
        'nomV'        => $nom,
        'prenomV'     => $prenom ,
        'matriculeV'  => $matricule,
        'telephoneV'  => $telephone ,
        'paysV'       => $pays,
        'dateFinV'   => $dateFin        
    )) ;
    $req3->closeCursor();
    */
    $req3 = $db->prepare('SELECT id FROM`virtual_users` WHERE email= :email');
    $req3->execute (array('email' => $email)) ;
    $don3 = $req3->fetch() ;
    $virtual_users_id = $don3['id'] ;
    $virtual_users_id = (int) $virtual_users_id ; //etre sur que c'est un entier
    //On ferme le curseur
    $req3->closeCursor() ;
    //On ecrit les informations facultatives et ou optionnelles
    $req4 = $db->prepare ('INSERT INTO `virtual_users_infos`(`virtual_user_id`, `nom`, `prenom`,`matricule`, `telephone`, `pays`, `date_fin`) VALUES (:virtual_id, :nom, :prenom,:matricule, :telephone, :pays, :dateFin )') ;
    $req4->execute(array(
        'virtual_id' =>  $virtual_users_id ,
        'nom'        => $nom,
        'prenom'     => $prenom ,
        'matricule'  => $matricule,
        'telephone'  => $telephone ,
        'pays'       => $pays,
        'dateFin'   => $dateFin        
    )) ; 
    //Si c'est bon on crée le repertoire avec les bons droits d'acces 
    if ($db->commit())
    {   $cheminScript = "/externe/www/html/www.admin.eneam.da/scripts/" ;
        $nomRepertoire = $debutMail ;
        $retour = 1 ;
        exec('sudo '.$cheminScript.'createUserDirectory.sh ' .$nomRepertoire , $ligne, $retour);
        if ($retour != 0)      
        {
            //Dans le cas où le script n'a pas pu creer le dossier contenant les courriers de l'utilisateur on notifie 
            $error = 'MAIL_CREATION_SUCCESS_BUT_DIRECTORY_CREATION_NOT' ;
            header ('Location:index.php?page=home&error='.$error) ;
            exit ;                     
        }           
        //Envoi du premier mail
        $to      = $email;
        $subject = 'Compte créé avec succès ';
        $message = 'Bonjour. L\'équipe d\'ENEAM vous souhaite la bienvenue.\r\n Vous pouvez envoyez et recevoir des courriers.\r\n Ne répondez pas à ce message. Cordialement ';
        // Dans le cas où nos lignes comportent plus de 70 caractères, nous les coupons en utilisant wordwrap()
        $message = wordwrap($message, 70, "\r\n");
        $headers = 'From: admin@eneam.da' . "\r\n" .
        'Reply-To: admin@eneam.da' . "\r\n" .
        'X-Mailer: PHP/' . phpversion();

        mail($to, $subject, $message, $headers);
    }
    //S'il a eu un problème avec les transactions on redirige et on signale 
}
catch (Exception $e)
{
    $error = 'INSERTION_ERREUR' ;
    $db->rollBack(); //On annule tout et on repasse en autocommit
    header ('Location:index.php?page=home&error='.$error) ;
    exit ;
}
//Si ces lignes s'executent c'est qu'il n'a pas eu d'erreurs 
$error = "MAIL_CREATION_SUCCESS" ;
header ('Location: index.php?page=home&error='.$error) ;

?>

