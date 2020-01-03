<div class="row">
    <?php
    $req = $db->query('SELECT `virtual_users`.`id` AS id , `email` , `nom`, `prenom`, `matricule`, `telephone`, `pays`, `date_fin` FROM `virtual_users` INNER JOIN `virtual_users_infos` ON `virtual_users`.`id`= `virtual_users_infos`.virtual_user_id ');
while ($don= $req->fetch())
{
    ?>
    <div class="col-md-3 col-sm-5 " style="margin-top: 2%; margin-bottom: 2%;">
            <div class="card col-md-12">
                <img src="..." class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $don['prenom'].' '.$don['nom'] ;?></h5>
                    <p class="card-text"><strong>Matricule</strong><?php echo $don['matricule'] ; ?><br>
                        <strong>Tél</strong><?php echo $don['telephone'] ; ?></br>
                        <strong>Expire</strong><?php echo $don['date_fin'] ; ?><br></p>                 
                    <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                        <div class="btn-group mr-2" role="group" aria-label="First group">
                            <button type="button" class="btn btn-secondary" id="<?php echo $don['id'] ; ?>"><i class="fas fa-user-times"></i></button>
                            <button type="button" class="btn btn-secondary"><i class="fas fa-edit"></i></button>
                            <button type="button" class="btn btn-secondary"><a href="mailto:<?php echo $don['email'] ; ?>" class="text-light"><i class="fas fa-mail-bulk" ></i></a></button>                            
                        </div>
                    </div>
                </div>                
            </div>            
        </div>
<?php
}
$req->closeCursor() ;
if ($erreurSuppression="MAIL_DELETE")
{?>
    <div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header">
    <img src="..." class="rounded mr-2" alt="...">
    <strong class="mr-auto">Info</strong>
    <small>A <?php echo date('H').'h'.date('i').'m' ;?></small>
    <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
     </div>
    <div class="toast-body"> Le compte email a été correctement supprimé</div>
    </div>
<?php
 $erreurSuppression="";
}
?>
    <!--
        <div class="col-md-3 col-sm-5 " style="margin-top: 2%; margin-bottom: 2%;">
            <div class="card col-md-12">
                <img src="..." class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Karl Dagobert</h5>
                    <p class="card-text"><strong>Matricule</strong> 22222<br>
                        <strong>Tél</strong>  95718340 </br>
                        <strong>Expire</strong> 2024-12-03.<br></p>                    
                    <div class="btn-toolbar " role="toolbar" aria-label="Toolbar with button groups">
                        <div class="btn-group mr-2" role="group" aria-label="First group">
                            <button type="button" class="btn btn-secondary"><i class="fas fa-user-times"></i></button>
                            <button type="button" class="btn btn-secondary"><i class="fas fa-edit"></i></button>
                            <button type="button" class="btn btn-secondary"><a href="mailto:houessou@pica.com" class="text-light"><i class="fas fa-mail-bulk" ></i></a></button>                            
                        </div>
                    </div>
                </div>                
            </div>            
        </div>
        <div class="col-md-3 col-sm-5 " style="margin-top: 2%; margin-bottom: 2%;">
            <div class="card col-md-12">
                <img src="..." class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Karl Dagobert</h5>
                    <p class="card-text"><strong>Matricule</strong> 22222<br>
                        <strong>Tél</strong>  95718340 </br>
                        <strong>Expire</strong> 2024-12-03.<br></p>
                    
                    <div class="btn-toolbar " role="toolbar" aria-label="Toolbar with button groups">
                        <div class="btn-group mr-2" role="group" aria-label="First group">
                            <button type="button" class="btn btn-secondary"><i class="fas fa-user-times"></i></button>
                            <button type="button" class="btn btn-secondary"><i class="fas fa-edit"></i></button>
                            <button type="button" class="btn btn-secondary"><a href="mailto:houessou@pica.com" class="text-light"><i class="fas fa-mail-bulk" ></i></a></button>                            
                        </div>
                    </div>
                </div>                
            </div>            
        </div>
        <div class="col-md-3 col-sm-5 " style="margin-top: 2%; margin-bottom: 2%;">
            <div class="card col-md-12">
                <img src="..." class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Karl Dagobert</h5>
                    <p class="card-text"><strong>Matricule</strong> 22222<br>
                        <strong>Tél</strong>  95718340 </br>
                        <strong>Expire</strong> 2024-12-03.<br></p>
                    
                    <div class="btn-toolbar " role="toolbar" aria-label="Toolbar with button groups">
                        <div class="btn-group mr-2" role="group" aria-label="First group">
                            <button type="button" class="btn btn-secondary"><i class="fas fa-user-times"></i></button>
                            <button type="button" class="btn btn-secondary"><i class="fas fa-edit"></i></button>
                            <button type="button" class="btn btn-secondary"><a href="mailto:houessou@pica.com" class="text-light"><i class="fas fa-mail-bulk" ></i></a></button>                            
                        </div>
                    </div>
                </div>                
            </div>            
        </div>
        <div class="col-md-3 col-sm-5 " style="margin-top: 2%; margin-bottom: 2%;">
            <div class="card col-md-12">
                <img src="..." class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Karl Dagobert</h5>
                    <p class="card-text"><strong>Matricule</strong> 22222<br>
                        <strong>Tél</strong>  95718340 </br>
                        <strong>Expire</strong> 2024-12-03.<br></p>
                    
                    <div class="btn-toolbar " role="toolbar" aria-label="Toolbar with button groups">
                        <div class="btn-group mr-2" role="group" aria-label="First group">
                            <button type="button" class="btn btn-secondary"><i class="fas fa-user-times"></i></button>
                            <button type="button" class="btn btn-secondary"><i class="fas fa-edit"></i></button>
                            <button type="button" class="btn btn-secondary"><a href="mailto:houessou@pica.com" class="text-light"><i class="fas fa-mail-bulk" ></i></a></button>                            
                        </div>
                    </div>
                </div>                
            </div>            
        </div>
        <div class="col-md-3 col-sm-5 " style="margin-top: 2%; margin-bottom: 2%;">
            <div class="card col-md-12">
                <img src="..." class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Karl Dagobert</h5>
                    <p class="card-text"><strong>Matricule</strong> 22222<br>
                        <strong>Tél</strong>  95718340 </br>
                        <strong>Expire</strong> 2024-12-03.<br></p>
                    
                    <div class="btn-toolbar " role="toolbar" aria-label="Toolbar with button groups">
                        <div class="btn-group mr-2" role="group" aria-label="First group">
                            <button type="button" class="btn btn-secondary"><i class="fas fa-user-times"></i></button>
                            <button type="button" class="btn btn-secondary"><i class="fas fa-edit"></i></button>
                            <button type="button" class="btn btn-secondary"><a href="mailto:houessou@pica.com" class="text-light"><i class="fas fa-mail-bulk" ></i></a></button>                            
                        </div>
                    </div>
                </div>                
            </div>            
        </div>
        <div class="col-md-3 col-sm-5 " style="margin-top: 2%; margin-bottom: 2%;">
            <div class="card col-md-12">
                <img src="..." class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Karl Dagobert</h5>
                    <p class="card-text"><strong>Matricule</strong> 22222<br>
                        <strong>Tél</strong>  95718340 </br>
                        <strong>Expire</strong> 2024-12-03.<br></p>
                    
                    <div class="btn-toolbar " role="toolbar" aria-label="Toolbar with button groups">
                        <div class="btn-group mr-2" role="group" aria-label="First group">
                            <button type="button" class="btn btn-secondary"><i class="fas fa-user-times"></i></button>
                            <button type="button" class="btn btn-secondary"><i class="fas fa-edit"></i></button>
                            <button type="button" class="btn btn-secondary"><a href="mailto:houessou@pica.com" class="text-light"><i class="fas fa-mail-bulk" ></i></a></button>                            
                        </div>
                    </div>
                </div>                
            </div>            
        </div>
</div>
        
        -->
      <!--  </div> -->
    
    <div class="col-md-8 offset-md-4" style=" margin-top: 20px; ">
        <ul class="pagination">
            <li class="page-item"><a class="page-link" href="#" aria-label="Previous"><span aria-hidden="true">&laquo;</span>
              </a>
            </li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item"><a class="page-link" href="#">4</a></li>
            <li class="page-item"><a class="page-link" href="#">5</a></li>
            <li class="page-item"><a class="page-link" href="#" aria-label="Next"><span aria-hidden="true">&raquo;</span> </a>
            </li>
        </ul>
    </div>
</div>