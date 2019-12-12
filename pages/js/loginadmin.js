/*
var email = document.getElementById('email') ;
var emailFunction = function ()
{
    var myRegex = new RegExp("^[a-z0-9]+@eneam.da$") ;
    
    var emailHelp = document.getElementById('emailHelp') ;
    if (emailHelp.className == 'form-text text-muted d-none')
    {
        emailHelp.className = 'form-text text-muted' ;
        //emailHelp.innerHTML = 'Vous etes entrain de saisir votre email';
        if (myRegex.test(email.nodeValue))
        {
            emailHelp.innerHTML = 'Email correct';
            //alert('Ca marche pas');
            
        } else
        {
            emailHelp.innerHTML = 'Email incorrect';
            //alert('Ca marche pas');
            
        }
            
    }else 
    {
        
        if (myRegex.test(email.text))
        {
            emailHelp.innerHTML = 'Email correct';
            
            alert('Ca marche je crois');
            
        } else{
            emailHelp.innerHTML = 'Email incorrect';
            alert('Ca marche pas je crois pas');
            
            
        }
            
    }
    
}
email.addEventListener('keypress', emailFunction) ;


*/