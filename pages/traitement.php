<?php
$sercice = array(
    'apache2'   =>'apache2' ,
    'phpfpm'   => 'phpfpm' ,
    'nginx'   =>    'nginx',
    'postfix'    => 'postfix' ,
    'dovecot'   =>  'dovecot'
    ) ;
    
foreach ( $service as $cle=>$element)
{
    if (isset($_POST[$cle])&& ($_POST[$cle]==='start'||$_POST[$cle]==='stop'))
    {
        $result= 'unknown';
        system('sudo /scriptService.sh' .$cle.'' .$_POST[$cle]  , $result);
        echo $cle.'|'.$result ;
        
    }
    
}





?>