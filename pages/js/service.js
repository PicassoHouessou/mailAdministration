$(function()
{
    function sendDetail( commande, objet , supplement )
    {
        $.post()
        {
            'pages/traitement.php' ,
            {
                objet : commande
            },
            function(data){
                displayResult (data)
            },
            'text'
        }
        if (supplement != "")
        {
            alert (supplement);
            $(supplement).ajaxStart( function ()
            { $(this).attr({
                class:'fas fa-stop-circle fa-lg' ,
                style: 'cursor: pointer; color: blue;' });
             console.log("L'appel AJAX est lancé !");
            });            
        }        
    }
    function displayResult(reponse)
    {
        if (reponse.length)
        {
            reponse = reponse.split("|") ;
            var serviceType= reponse[1] ;
            var serviceState = reponse[2] ;
            var serviceX = $('#'+serviceType+'Start');
            if (serviceState=='start')
            {
                serviceX.attr ({
                    class:'fas fa-check fa-lg' ,
                    style: 'cursor: pointer; color: blue;' 
                }) ;
            }
            else if (serviceState=='stop')
            {
                serviceX.attr ({
                    class:'fas fa-stop-circle fa-lg' ,
                    style: 'cursor: pointer; color: red;' 
                }) ;                 
            }
            else if(serviceState=='unknown')
            {
                serviceX.attr ({
                    class:'fas fa-check fa-lg' ,
                    style: 'cursor: pointer; color: red;' 
                })  ;           
            }            
        }        
    }
    var tableau = {
        apache2 : 'apache2',
        phpfpm :'phpfpm', 
        nginx : 'nginx',
        postfix : 'postfix' ,
        dovecot : 'dovecot'    
    } ;
    var tabStart= new Array(5), tabStop = new Array(5);
    for (var i in tableau) 
    {
        tabStart[i] = $('#'+i+'Start');        
        tabStart[i].on('click', function(){sendDetail("restart", i, i+'Start') ;});        
        tabStop[i] = $('#'+i+'Stop');
        tabStop[i].on('click', function(){ sendDetail("stop",i, "" ) ; });        
    }
    var demarrerTous = $('#all') ;    
    demarrerTous.on('click',function()
    {
        $('#confirmation').modal('show') ;
        $('#buttonConfirm').click( function(){ $('#confirmation').modal('hide') ; sendDetail("restart", "all")});
    });   
});
