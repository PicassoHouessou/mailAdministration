// JavaScript Document
var facultatifCheckbox = document.getElementById('facultatif') ;
    facultatifCheckbox.addEventListener('change', 
        function ()
        {
            if (facultatifCheckbox.checked ==true)
            {
                var elementFacultatif = document.getElementById('elementFacultatif') ;
                elementFacultatif.className='form-row' ;
            }
            else if (facultatifCheckbox.checked ==false)
            {
                var elementFacultatif = document.getElementById('elementFacultatif') ;
                elementFacultatif.className='form-row d-none' ;
            }
        }
    ) ;
/*
    var facultatifCheckbox = document.getElementById('facultatif') ;
    facultatifCheckbox.addEventListener('change', 
        function ()
        {
            if (facultatifCheckbox.checked ==true)
            {
                var elementFacultatif = document.getElementById('elementFacultatif') ;
                elementFacultatif.className='form-row' ;
            }
            else if (facultatifCheckbox.checked ==false)
            {
                var elementFacultatif = document.getElementById('elementFacultatif') ;
                elementFacultatif.className='form-row d-none' ;
            }
        }
    ) ;

    */
$(function()
{
    $('#loginIcon').removeClass('d-none') ;
});
//$(function()
 //{
    //$('#test').click(function() { $(window).reload ;});
//});
//$( function () {
//   $('#politique').modal('show') ; });

//Read more: https://javarevisited.blogspot.com/2014/11/difference-between-jquery-document-ready-vs-Javascript-window-onload-event.html#ixzz69bXNWyAB
//var loginIcon= document.getElementById('loginIcon');
//loginIcon.className= 'dropdown col-md-2' ; 

/*

$(function(){
    var $facultatif = $('#facultatif') ;
    $facultatif.on('change', function()
    {
        if($facultatif.checked==true)
        {
            $('#elementFacultatif').attr('class','form-row') ;
        }else if ($facultatif.checked==false)
        {
            $('#elementFacultatif').attr('class','form-row d-none') ;
            
        }
    });
    
});

*/