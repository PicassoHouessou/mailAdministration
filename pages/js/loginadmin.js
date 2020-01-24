
var email = document.getElementById('email') ;
var emailHelp = document.getElementById('emailHelp') ;

email.addEventListener('keyup', function() {
    
var myRegex = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/ ; 
    
    if (myRegex.test(email.value))
    {
        emailHelp.innerHTML = "Email valide"; 
    } else
    {        
        emailHelp.innerHTML = "Email invalide";
    } 
                      
}) ;
$(function(){
    $('#loginIcon').addClass('d-none') ;
});
/*
$(window).load (function()
{
    $(body)
    <div class="progress">
  <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
</div>

    
})

*/