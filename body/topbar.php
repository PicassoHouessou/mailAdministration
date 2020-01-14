	<!--Navigation-->
	<header class="row">
        <nav class="navbar navbar-expand bg-light col-md-12">
		
            <div class="navbar-brand col-md-3"><h1>Alinkka</h1></div>
			    <ul class="navbar-nav col-md-7">
				    <li class="nav-item">
				    	<a class="nav-link" href="index.php?page=home"><i class="fas fa-home fa-lg" ></i>Accueil<span class="sr-only">(current)</span></a>
				    </li>
				    <li class="nav-item">
				    	<a class="nav-link" href="index.php?page=all_email"><i class="fas fa-mail-bulk"></i>Adresse Mail</a>
				    </li>
				    <li class="nav-item">
				        <a class="nav-link" href="index.php?page=service"><i class="fas fa-cog fa-fw" ></i>Service</a>
				    </li>
				    <li class="nav-item">
				    	<a class="nav-link" href="index.php?page=about" tabindex="-1" aria-disabled="true"><i class="fas fa-question" ></i>Apropos</a>
			      	</li>
    			</ul>			
           
               <div class="dropdown col-md-2" id="loginIcon">          
                   <div class="dropdown-toggle" data-toggle="dropdown"><img src="img/admin.png" /></div>           
                   <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">                
                       <a class="dropdown-item rounded" href="index.php?page=logout" id="deconnecte">Se déconnecter</a>
              </div>
                </div>
        
        </nav>
		
	</header>

<script>
/*var deconnecte = document.getElementById('deconnecte') ;
     
        deconnecte.addEventListener('click', function(){
              
    var loginIcon = document.getElementById('loginIcon');
    loginIcon.className= 'dropdown col-md-2 d-none' ;        
    }) ;
*/
</script>
