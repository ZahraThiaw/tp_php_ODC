<div class="conteneurreferentiels">
            <div class="headreferentiel">
                <div class="referentiels"><h2>Référentiels: <span style="color: #088F89;"><?= $currentPromo['libelle'] ?></span></h2></div>
                <div class="referentielslistes"><p>Référentiels . Liste</p></div>
            </div>
            <div class="bodyreferentiels">
                <div class="referentielsreferentiels">
                    <?php foreach($referentielsForCurrentPromo as $referentiel): ?>
                    <div class="referentiel">
                        <span class="troispoint">...</span>
                        
                        <img src="<?= "../public/images/".$referentiel['imagePath'] ?>" alt="classe">
                        <form action="" method="post">
                            <input type="hidden" name="page" value="utilisateurs">
                            <input type="hidden" name="idreferentiel" value="<?= $referentiel['referentiel'] ?>">
                            <button type="submit"><span class="nomreferentiel"><?= $referentiel['referentiel'] ?></span></button>
                        </form>
                        <span class="etatreferentiel"><?= $referentiel['etatreferentiel'] ?></span>
                    </div>
                    <?php endforeach; ?>
                </div>
                <div class="nouveauxreferentiel">
                    <form action="" method="post" enctype="multipart/form-data">
                        <h2>Nouveau Référentiel</h2>
                        <label for="libelle">Libelle</label>
                        <i class="fa-regular fa-user icone1"></i><input type="text" name="libelle" id="libelle" placeholder="Entrer le libelle">
                        <span style="color: red;"><?= $erreur_libelle ?></span>
                        <label for="description">Description</label>
                        <i class="fa-regular fa-user icone2"></i><textarea name="description" id="description" placeholder="Entrer la description"></textarea>
                        <span style="color: red;"><?= $erreur_description ?></span>
                        <label for="image">Image</label>
                        <input class="image" type="file" name="image" id="image">
                        <span style="color: red;"><?= $erreur_image ?></span>
                        <label for="addToPromo">Ajouter à la promo en cours</label>
                        <label class="switch">
                            <input type="checkbox" name="addToPromo" id="addToPromo" />
                            <span></span>
                        </label>
                        <input type="hidden" name="page" value="referentiels">
                        <input type="hidden" name="nouveaureferentiel" value="nouveaureferentiel">
                        <button type="submit">Enregistrer</button>
                    </form>
                </div>

            </div>
</div>