<?php
$sercice = array(
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
        $result= 'unknown';
        system('sudo /scriptService.sh' .$_POST[$cle].' '.$element , $result);
        echo $cle.'|'.$result ;
        
    }
    
}





?>