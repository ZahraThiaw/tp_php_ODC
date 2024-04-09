<div class="conteneurreferentiels">
            <div class="headreferentiel">
                <div class="referentiels"><h2>Référentiels</h2></div>
                <div class="referentielslistes"><p>Référentiels . Liste</p></div>
            </div>
            <div class="bodyreferentiels">
                <div class="referentielsreferentiels">
                    <?php foreach($referentiels as $referentiel): ?>
                    <div class="referentiel">
                        <span class="troispoint">...</span>
                        <img src="../public/images/classe.jpeg" alt="classe">
                        <span class="nomreferentiel"><?= $referentiel['referentiel'] ?></span>
                        <span class="etatreferentiel"><?= $referentiel['etatreferentiel'] ?></span>
                    </div>
                    <?php endforeach; ?>
                </div>
                <div class="nouveauxreferentiel">
                    <form action="">
                        <h2>Nouveau Référentiel</h2>
                        <label for="libelle">Libelle</label>
                        <i class="fa-regular fa-user icone1"></i><input type="text" name="libelle" id="libelle" placeholder="Entrer le libelle">
                        <label for="description">Description</label>
                        <i class="fa-regular fa-user icone2"></i> <textarea name="description" id="description" placeholder="Entrer la description"></textarea>
                        <button type="submit">Enregistrer</button>
                    </form>
                </div>
            </div>
</div>