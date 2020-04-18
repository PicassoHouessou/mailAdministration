<header class="row ">  
    <div class="col-md-3 logo">
        <h2 style="padding-top: 4%;"><a href="index.php"><img src="img/asset/eneam.png" alt="logo_eneam" height="60">AdminBoard</a></h2>
    </div>
    <nav class="navbar navbar-expand-md col-md-9 sticky-top">          
        <button class="navbar-toggler"  style="color: white !important ;" type="button" data-toggle="collapse" data-target="#collapse_target">
            <span class="navbar-toggler-icon " ></span>
        </button>
        <div class="collapse navbar-collapse col-md-12" id="collapse_target">
            <ul class="navbar-nav col-md-10 col-sm-8" >
	            <li class="nav-item">
				    	<a class="nav-link" href="index.php?page=home"><i class="fas fa-home fa-lg" ></i>Accueil<span class="sr-only">(current)</span></a>
				</li>
				    <li class="nav-item">
				    	<a class="nav-link" href="index.php?page=all_email"><i class="fas fa-mail-bulk"></i>Adresse Mail</a>
				    </li>
				    <li class="nav-item">
				        <a class="nav-link" href="index.php?page=service"><i class="fas fa-cog fa-fw" ></i>Services</a>
				    </li>
				    <li class="nav-item">
				    	<a class="nav-link" href="index.php?page=about" tabindex="-1" aria-disabled="true"><i class="fas fa-question" ></i>A propos</a>
			      	</li>
            </ul>	
                <!--
                <div  class="col-md-2" id="loginIcon">
                    <button type="button" class="btn btn-primary">Sé déconnecter</button>
                </div>
                <div class="dropdown-toggle col-md-2" id="loginIcon" data-toggle="dropdown">
                    <img src="img/admin.png" /> <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">          
                    <a class="dropdown-item rounded" href="index.php?page=logout" id="deconnecte">Se déconnecter</a>
                </div></div>
                -->	
                <div class="dropdown col-md-2" id="loginIcon" title="Gestion compte et déconnexion">          
                    <div class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user fa-lg text-light"></i></div>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">      
                        <?php 
                        if ( isset($_SESSION['email']) && $_SESSION['email']== 'master@eneam.da')
                        {
                            echo '<a class="dropdown-item rounded" href="index.php?page=adminmanage" id="adminManage">Gérer les administrateurs</a><br>' ;

                        }
                        ?>          
                        <a class="dropdown-item rounded" href="index.php?page=logout" id="deconnecte">Se déconnecter</a>
                    </div>
                </div>             
                                              
            </div>        
        </nav>		
</header>