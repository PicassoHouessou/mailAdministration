
<div class="row" style="margin-bottom: 200px;">   
    
    <section class="col-md-10 offset-md-2"><br>
    <?php
        echo "<p> Bienvenue Monsieur <strong>".$_SESSION['prenom']." ".$_SESSION['nom']. "</strong> sur la plateforme d'aministration. Il est <strong>". date('Y-m-d')."</strong><br/>Si vous si vous rencontrez des problème ou constatez des bugs, veuillez bien me contacter sur par mail <a href=\"mailto:houessoupicasso@yahoo.fr\">Picasso Houessou</a>" ;      
    ?>           
        </p>
    </section>
    <section class="col-md-8 offset-md-2">
        <!--<div class="card"> -->
        <div class="card rounded" style="padding-top: 20px; padding-bottom: 20px;">
        <form method="post" action="index?page=ajout_utilisateur" class="col-md-12">
            <legend><h4>Création rapide de compte email</h4></legend>
            <div class="col-md-12">
                <div class="form-group">
                    <input type="email" class="form-control" name="email" aria-describedby="emailHelp" placeholder="exemple@eneam.da" required>
                </div>
                <div class="form-group">
                    <input type="password"  name="password" class="form-control" id="exampleInputPassword1" placeholder="********************************************" required>
                    <small id="emailPassword" class="form-text text-muted">Doit contenir au moins 8 caractères, une lettre majuscule, un chiffre et un caractère spécial !@&#$%^*-.</small>
                </div>
                <div class="form-group">
                    <input type="password"  name="passwordConfirm" class="form-control" id="exampleInputPassword2" placeholder="********************************************" required>
                    <small id="emailPassword2" class="form-text text-muted">
                    Veuillez confirmer le mot de passe</small>
                </div>
                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" id="facultatif" name="facultatif">
                    <label class="form-check-label" for="facultatif">Afficher les options facultatives</label>
                </div>
            </div>
            <div class="form-row d-none" id="elementFacultatif">
                <div class="form-group col-md-6">
                    <label for="nom">Nom </label> 
                    <input type="tel" placeholder="Nom Ex: Houessou " class="form-control" id="nom" name="nom">
                </div>
                <div class="form-group col-md-6">
                    <label for="prenom">Prénoms</label>
                    <input type="text" id="prenom" name="prenom" placeholder="Prénoms Ex: Paul Karl" class="form-control">                    
                </div>
                <div class="form-row">                    
                    <div class="form-group col-md-3">
                        <label for="matricule">Matricule</label>
                        <input type="tel" placeholder="Matricule ex: 112222" class="form-control" id="matricule" name="matricule">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="telephone">Numéro de téléphone</label>
                        <input type="tel" placeholder="Numero de telephone" class="form-control" id="telephone" name="telephone">  
                    </div>
                    <div class="form-group col-md-3">
                        <label for="dateFin">Date d'expiration</label>
                        <input type="date" class="form-control" id="dateFin" name="dateFin" <?php $min = date('Y-m-d'); $max = date('Y-m-d',time()+157680000 ); echo 'min="'.$min.'"' ; echo ' max="'.$max.'"';?>> 
                        <small id="" class="form-text text-muted">Ne peut dépasser <?php $max = date('Y-m-d',time()+157680000 ); echo ' '.$max ;?></small>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="pays">Pays</label>
                        <select name="pays" class="form-control" id="pays">
                            <optgroup label="Afrique 54pays">Afrique</option>                    
                                <option value="Afrique du Sud">Afrique du Sud</option>
                                <option value="Algérie">Algérie</option>
                                <option value="Angola">Angola</option>
                                <option value="Bénin" selected>Bénin</option>
                                <option value="Botswana">Botswana</option>
                                <option value="Burkina">Burkina</option>
                                <option value="Burundi">Burundi</option>
                                <option value="Cameroun">Cameroun</option>
                                <option value="Cap-Vert">Cap-Vert</option>
                                <option value="République centrafricaine">République centrafricaine</option>
                                <option value="Comores">Comores</option>
                                <option value="Congo">Congo</option>
                                <option value="République démocratique du Congo">République démocratique du Congo</option>
                                <option value="Côte d'Ivoire">Côte d'Ivoire</option>
                                <option value="Djibouti">Djibouti</option>
                                <option value="Égypte">Égypte</option>
                                <option value="Érythrée">Érythrée</option>
                                <option value="Éthiopie">Éthiopie</option>
                                <option value="Gabon">Gabon</option>
                                <option value="Gambie">Gambie</option>
                                <option value="Ghana">Ghana</option>
                                <option value="Guinée">Guinée</option>
                                <option value="Guinée-Bissau">Guinée-Bissau</option>
                                <option value="Guinée équatoriale">Guinée équatoriale</option>
                                <option value="Kenya">Kenya</option>
                                <option value="Lesotho">Lesotho</option>
                                <option value="Libéria">Libéria</option>
                                <option value="Libye">Libye</option>
                                <option value="Madagascar">Madagascar</option>
                                <option value="Malawi">Malawi</option>
                                <option value="Mali">Mali</option>
                                <option value="Maroc">Maroc</option>
                                <option value="Maurice">Maurice</option>
                                <option value="Mauritanie">Mauritanie</option>
                                <option value="Mozambique">Mozambique</option>
                                <option value="Namibie">Namibie</option>
                                <option value="Niger">Niger</option>
                                <option value="Nigeria">Nigeria</option>
                                <option value="Ouganda">Ouganda</option>
                                <option value="Rwanda">Rwanda</option>
                                <option value="Sao Tomé-et-Principe">Sao Tomé-et-Principe</option>
                                <option value="Sénégal">Sénégal</option>
                                <option value="Seychelles">Seychelles</option>
                                <option value="Sierra Leone">Sierra Leone</option>
                                <option value="Somalie">Somalie</option>
                                <option value="Soudan">Soudan</option>
                                <option value="Sud-Soudan">Sud-Soudan</option>
                                <option value="Swaziland">Swaziland</option>
                                <option value="Tanzanie">Tanzanie</option>
                                <option value="Tchad">Tchad</option>
                                <option value="Togo">Togo</option>
                                <option value="Tunisie">Tunisie</option>
                                <option value="Zambie">Zambie</option>
                                <option value="Zimbabwe">Zimbabwe</option>
                            </optgroup>
                            <optgroup label="Amérique 36pays">
                                <option value="Antigua-et-Barbuda">Antigua-et-Barbuda</option>
                                <option value="Argentine">Argentine</option>
                                <option value="Bahamas">Bahamas</option>
                                <option value="Barbade">Barbade</option>
                                <option value="Belize">Belize</option>
                                <option value="Bolivie">Bolivie</option>
                                <option value="Brésil">Brésil</option>
                                <option value="Canada">Canada</option>
                                <option value="Chili">Chili</option>
                                <option value="Colombie">Colombie</option>
                                <option value="Costa Rica">Costa Rica</option>
                                <option value="Cuba">Cuba</option>
                                <option value="République dominicaine">République dominicaine</option>
                                <option value="Dominique">Dominique</option>
                                <option value="Équateur">Équateur</option>
                                <option value="États-Unis">États-Unis</option>
                                <option value="Grenade">Grenade</option>
                                <option value="Guatemala">Guatemala</option>
                                <option value="Guyana">Guyana</option>
                                <option value="Haïti">Haïti</option>
                                <option value="Honduras">Honduras</option>
                                <option value="Jamaïque">Jamaïque</option>
                                <option value="Mexique">Mexique</option>
                                <option value="Nicaragua">Nicaragua</option>
                                <option value="Panama">Panama</option>
                                <option value="Paraguay">Paraguay</option>
                                <option value="Pérou">Pérou</option>
                                <option value="Porto Rico">Porto Rico</option>
                                <option value="Saint-Christophe-et-Niévès">Saint-Christophe-et-Niévès</option>
                                <option value="Sainte-Lucie">Sainte-Lucie</option>
                                <option value="Saint-Vincent-et-les Grenadines">Saint-Vincent-et-les Grenadines</option>
                                <option value="Salvador">Salvador</option>
                                <option value="Suriname">Suriname</option>
                                <option value="Trinité-et-Tobago">Trinité-et-Tobago</option>
                                <option value="Uruguay">Uruguay</option>
                                <option value="Venezuela">Venezuela</option>
                            </optgroup>
                            <optgroup label="Asie 45pays">
                                <option value="Afghanistan">Afghanistan</option>
                                <option value="Arabie saoudite">Arabie saoudite</option>
                                <option value="Bahreïn">Bahreïn</option>
                                <option value="Bangladesh">Bangladesh</option>
                                <option value="Bhoutan">Bhoutan</option>
                                <option value="Birmanie">Birmanie</option>
                                <option value="Brunei">Brunei</option>
                                <option value="Cambodge">Cambodge</option>
                                <option value="Chine">Chine</option>
                                <option value="Corée du Nord">Corée du Nord</option>
                                <option value="Corée du Sud">Corée du Sud</option>
                                <option value="Émirats arabes unis">Émirats arabes unis</option>
                                <option value="Inde">Inde</option>
                                <option value="Indonésie">Indonésie</option>
                                <option value="Irak">Irak</option>
                                <option value="Iran">Iran</option>
                                <option value="Israël">Israël</option>
                                <option value="Japon">Japon</option>
                                <option value="Jordanie">Jordanie</option>
                                <option value="Kazakhstan">Kazakhstan</option>
                                <option value="Kirghizistan">Kirghizistan</option>
                                <option value="Koweït">Koweït</option>
                                <option value="Laos">Laos</option>
                                <option value="Liban">Liban</option>
                                <option value="Malaisie">Malaisie</option>
                                <option value="Maldives">Maldives</option>
                                <option value="Mongolie">Mongolie</option>
                                <option value="Népal">Népal</option>
                                <option value="Oman">Oman</option>
                                <option value="Ouzbékistan">Ouzbékistan</option>
                                <option value="Palestine">Palestine</option>
                                <option value="Pakistan">Pakistan</option>
                                <option value="Philippines">Philippines</option>
                                <option value="Qatar">Qatar</option>
                                <option value="Singapour">Singapour</option>
                                <option value="Sri Lanka">Sri Lanka</option>
                                <option value="Syrie">Syrie</option>
                                <option value="Tadjikistan">Tadjikistan</option>
                                <option value="Taïwan">Taïwan</option>
                                <option value="Thaïlande">Thaïlande</option>
                                <option value="Timor oriental">Timor oriental</option>
                                <option value="Turkménistan">Turkménistan</option>
                                <option value="Turquie">Turquie</option>
                                <option value="Viêt Nam">Viêt Nam</option>
                                <option value="Yémen">Yémen</option>
                            </optgroup>                  
                            <optgroup label="Europe 48pays">
                                <option value="Allemagne">Allemagne</option>
                                <option value="Albanie">Albanie</option>
                                <option value="Andorre">Andorre</option>
                                <option value="Arménie">Arménie</option>
                                <option value="Autriche">Autriche</option>
                                <option value="Azerbaïdjan">Azerbaïdjan</option>
                                <option value="Belgique">Belgique</option>
                                <option value="Biélorussie">Biélorussie</option>
                                <option value="Bosnie-Herzégovine">Bosnie-Herzégovine</option>
                                <option value="Bulgarie">Bulgarie</option>
                                <option value="Chypre">Chypre</option>
                                <option value="Croatie">Croatie</option>
                                <option value="Danemark">Danemark</option>
                                <option value="Espagne">Espagne</option>
                                <option value="Estonie">Estonie</option>
                                <option value="Finlande">Finlande</option>
                                <option value="France">France</option>
                                <option value="Géorgie">Géorgie</option>
                                <option value="Grèce">Grèce</option>
                                <option value="Hongrie">Hongrie</option>
                                <option value="Irlande">Irlande</option>
                                <option value="Islande">Islande</option>
                                <option value="Italie">Italie</option>
                                <option value="Lettonie">Lettonie</option>
                                <option value="Liechtenstein">Liechtenstein</option>
                                <option value="Lituanie">Lituanie</option>
                                <option value="Luxembourg">Luxembourg</option>
                                <option value="République de Macédoine">République de Macédoine</option>
                                <option value="Malte">Malte</option>
                                <option value="Moldavie">Moldavie</option>
                                <option value="Monaco">Monaco</option>
                                <option value="Monténégro">Monténégro</option>
                                <option value="Norvège">Norvège</option>
                                <option value="Pays-Bas">Pays-Bas</option>
                                <option value="Pologne">Pologne</option>
                                <option value="Portugal">Portugal</option>
                                <option value="République tchèque">République tchèque</option>
                                <option value="Roumanie">Roumanie</option>
                                <option value="Royaume-Uni">Royaume-Uni</option>
                                <option value="Russie">Russie</option>
                                <option value="Saint-Marin">Saint-Marin</option>
                                <option value="Serbie">Serbie</option>
                                <option value="Slovaquie">Slovaquie</option>
                                <option value="Slovénie">Slovénie</option>
                                <option value="Suède">Suède</option>
                                <option value="Suisse">Suisse</option>
                                <option value="Ukraine">Ukraine</option>
                                <option value="Vatican">Vatican</option>
                            </optgroup>
                            <optgroup label="Océannie 14pays">
                                <option value="Australie">Australie</option>
                                <option value="Fidji">Fidji</option>
                                <option value="Kiribati">Kiribati</option>
                                <option value="Marshall">Marshall</option>
                                <option value="Micronésie">Micronésie</option>
                                <option value="Nauru">Nauru</option>
                                <option value="Nouvelle-Zélande">Nouvelle-Zélande</option>
                                <option value="Palaos">Palaos</option>
                                <option value="Papouasie-Nouvelle-Guinée">Papouasie-Nouvelle-Guinée</option>
                                <option value="Salomon">Salomon</option>
                                <option value="Samoa">Samoa</option>
                                <option value="Tonga">Tonga</option>
                                <option value="Tuvalu">Tuvalu</option>
                                <option value="Vanuatu">Vanuatu</option>
                            </optgroup>

                        </select>     
                    </div>
                </div>
                
            </div>


          <button type="submit" class="btn btn-primary">Créer le compte</button>
        </form>
        </div>
        <!--</div> 
    </section>
    
        < div class="modal" data-backdrop="static" tabindex="-1" role="dialog" id="politique">        
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title font-weight-bold">Confidentialité et Politique d'utilisation</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    <p> Soyez la bienvenue sur la page d'administration du serveur de mail. Nous n'utilisons pas du tout les cookies. L'utilisation de cette plateforme est sujette à plusieurs conditions que vous approuvez explicitement.</p>
                    <p>
                         <h6 class="font-weight-bold">Nous déclinons toutes responsabilité à la mauvaise utilisation  </h6>
                         En effet vous etes responsables de l'utilisation que vous faites de ce outils. De ce fait notre équipe ne peut pas etre tenu responsable de vos agissements.   
                    </p>
                    <p>
                         <h6 class="font-weight-bold">Votre travail, notre plaisir </h6>
                         Nous travaillons chaque jour à rendre meilleur nos services pour vous garantir la sécurité et une experience informatique plus doue que jamais.   
                    </p>
                    <p>
                         <h6 class="font-weight-bold">Nous sommes à l'ecoute</h6>
                         Nous vous encourageons de bien vouloir nous faire part de problèmes ou bugs constatés afin que nous vous aidons dans la démarches à suivre   
                    </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                        <button type="button" class="btn btn-primary">Accepter</button>
                    </div>
                </div>
            </div>
        </div>
    -->
</div>
<?php
    echo "<script src=\"pages/js/home.js\"></script>" ;

?>
