              <div class="bodyutilisateurs">
                    <div class="promoutilisateurs">
                        <div class="promotionsutilisateurs"><h3>Promotions</h3></div>
                        <div class="promosutilisateurs"><p>Promos . Liste . Détails . Apprenants</p></div>
                    </div>
                    <div class="container2">
                        <div class="span">
                          <h3>Promotion: <span style="color: #088F89;"><?= $currentPromo['libelle'] ?></span></h3> 
                        </div>
                        <div class="span">
                          <h3>Référentiel: 
                            <span style="color: #088F89;">
                              <form action="" method="post">
                                <input type="hidden" name="page" value="utilisateurs">
                                <select style="color: #088F89;" name="appreferentiel" onchange="this.form.submit()">
                                      <option value="referentiel">Apprenants</option>
                                      <?php foreach($referentielsForCurrentPromo as $referentiel): ?>
                                        <option value="<?= $referentiel['referentiel'] ?>" <?= $_SESSION['appreferentiel']=== $referentiel['referentiel'] ? "selected" : ""?>><span class="referentiel"><?= $referentiel['referentiel'] ?></span></option>
                                      <?php endforeach; ?>
                                </select>
                              </form>
                            </span>
                          </h3> 
                        </div>
                    </div>
                    <div class="container3">
                        <div class="numero">
                            <div class="numero1">1</div>
                            <div class="trait"></div>
                        </div>
                        <div class="containerIntern">
                            <div class="numeroaprenant"><h3>Apprenants</h3></div>
                            <div class="divhaut">
                                <span><h3>Liste Des Apprenants <span style="color: #009186;">(<?php echo count($apprenantsForCurrentPromo) ?>)</span></h3></span>
                                <div class="btns">
                                    <a href="#targetnouveau" class="nouveau">+ Nouveau</a>
                                    <a href="#targetapprenantparmasse" class="clickmass">+ Insertion en masse</a>
                                    <a href="#" class="clickmodel"><i class="fa-solid fa-download"></i>Fichier model</a>
                                    <a href="#" class="clickexclu">Liste des Exclus</a>
                                </div>
                            </div>
                           
                            <div class="filter">
                                <form action="" method="post">
                                  <i class="fa-solid fa-magnifying-glass"></i>
                                  <input type="hidden" name="page" value="motfiltre">
                                  <input type="search" name="recherchefiltre" id="filtrer" placeholder="Filtrer" <?= isset($_POST['recherchefiltre']) ? 'value="' . $_POST['recherchefiltre'] . '"' : '' ?>>
                      
                                </form>
                            </div>
                            <div class="logo1" >
                                <img src="images/folder.png" alt="dossier">
                            </div>
                            <div class="table1">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Image</th>
                                            <th>Nom</th>
                                            <th>Prénom</th>
                                            <th>Email</th>
                                            <th>Genre</th>
                                            <th>Téléphone</th>
                                            <th>Référentiel</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($apprenantsForCurrentPromo as $student): ?>
                                        <tr>
                                            <td><div class="img1"><img src="images/tete.png" alt=""></div></td>
                                            <td ><span style="color: #417b33;"><?= $student['nom']?></span></td>
                                            <td ><span style="color: #417b33;"><?= $student['prenom']?></span></td>
                                            <td><?= $student['email']?></td>
                                            <td><?= $student['genre']?></td>
                                            <td><?= $student['telephone']?></td>
                                            <td><?= $student['referentiel']?></td>
                                            <td><input type="checkbox" class="checkbox"></td>
                                        </tr>
                                        <?php endforeach; ?>
                                        
                                      
                                        
                                </table>
                                
                            </div>
                        </div>
                    </div>
            </div>

<div id="targetnouveau">
    <div class="apprenant-one-modal">
        <div class="apprenant-one">
            <header>
                <h3>Nouvel Apprenant</h3>
                <a href="#" class="close" style="text-decoration: none;">x</a>
            </header>
            <div class="containernouveau">
                <div class="top">
                    <div>
                        <div class="cercle1">1</div>
                        <p>informations Perso.</p>
                    </div>
                    <hr />
                    <div>
                        <div class="cercle2">2</div>
                        <p>informations Supplementaires</p>
                    </div>
                </div>
                <div class="middle">
                    <div class="flex-col">
                        <label for="nom">Nom</label
                        ><input type="text" name="nom" placeholder="entrez le nom" />
                    </div>
                    <div class="flex-col">
                        <label for="prenom">Prenom</label
                        ><input
                        type="text"
                        name="prenom"
                        id="prenom"
                        placeholder="entrez le prenom"
                        />
                    </div>
                    <div class="flex-col">
                        <label for="email">Email</label
                        ><input
                        type="email"
                        name="email"
                        id="email"
                        placeholder="entrez l'email"
                        />
                    </div>
                    <div class="flex-col">
                        <label for="telephone">Telephone</label
                        ><input
                        type="text"
                        name="telephone"
                        id="telephone"
                        placeholder="entrez le telephobe"
                        />
                    </div>
                    <div class="flex-col">
                        <label for="sexe">sexe</label
                        ><input type="text" name="sexe" placeholder="Choisir le sexe*" />
                    </div>
        
                    <div class="flex-col">
                        <label for="date">Date Naissance</label
                        ><input type="date" name="date" />
                    </div>
                    <div class="flex-col">
                        <label for="lieu">Lieu de Naissance</label
                        ><input
                        type="text"
                        name="lieu"
                        placeholder="entrez le lieu de naissance"
                        />
                    </div>
                    <div class="flex-col">
                        <label for="cni">N CNI</label
                        ><input
                        type="text"
                        name="cni"
                        placeholder="entrez le numero de carte d'identite"
                        />
                    </div>
                </div>
                <div class="bottom">
                    <a href="#targetnouveausuivant" style="text-decoration: none;color: white">Suivant</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="targetnouveausuivant">
    <div class="apprenant-modal">
        <div class="form-apprenant">
          <header>
            <h3>Nouvel Apprenant</h3>
            <a href="#" class="close" style="text-decoration: none;">x</a>
          </header>
          <div class="container">
            <div class="top">
              <div>
                <div class="cercle">/</div>
                <p>informations Perso.</p>
              </div>
              <hr />
              <div>
                <div class="cercle">2</div>
                <p>informations Supplementaires</p>
              </div>
            </div>
            <div class="middle">
              <div class="flex-col">
                <label for="nom">Nom & Prenom tuteur</label
                ><input
                  type="text"
                  placeholder="entrez le nom et le prenom du tuteur"
                />
              </div>
              <div class="flex-col">
                <label for="contact">Contact Tuteur</label
                ><input type="text" placeholder="entrez le contact du tuteur" />
              </div>
              <div class="flex-col">
                <label for="Photocopie">Photocopie CNI</label
                ><input type="file" />
              </div>
              <div class="flex-col">
                <label for="Extrait">Extrait de naissance</label
                ><input type="file" />
              </div>
              <div class="flex-col">
                <label for="Diplome">Diplome</label><input type="file" />
              </div>
  
              <div class="flex-col">
                <label for="Casier">Casier judiciaire</label><input type="file" />
              </div>
              <div class="flex-col">
                <label for="Visite">Visite Medicale</label><input type="file" />
              </div>
            </div>
            <div class="bottom">
              <button><a href="#">x cancel</a></button>
              <button>+ cree nouvel apprenant</button>
            </div>
          </div>
        </div>
    </div>
</div>

<div id="targetapprenantparmasse">
    <div class="container-file-modal">
        <div class="modal">
          <div>
            <p>choisir un fichier excel</p>
            <input class="drop" placeholder="drop file here or click to upload" />
            <input type="file" name="" id="" />
          </div>
          <div class="btn-grp">
            <button style="background-color: red"><a href="utilisateurs.php" style="text-decoration: none;color: white">Fermer</a></button>
            <button style="background-color: #018f88">Enregistrer</button>
          </div>
        </div>
    </div>
</div>