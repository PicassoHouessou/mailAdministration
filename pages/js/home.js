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

