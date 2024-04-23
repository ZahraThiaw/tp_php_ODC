<div class="contenupromotions">
    <div class="promo">
        <div class="promotions"><h2>Promotions</h2></div>
        <div class="promos"><p>Promos . Création</p></div>
    </div>
    <div class="bodynouveaupromo">
        <div class="numeronouveaupromo">
            <div class="numero1nouveaupromo">1</div>
            <div class="trait"></div>
            <div class="numero2nouveaupromo">2</div>
        </div>
        <div class="bodynouveaupromodroit">
            <div class="bodynouveaupromodroit1"><h2>Promotion</h2></div>
            <form action="" method="post" class="nouveaupromotion">
                <div class="bodynouveaupromodroit2">
                    <label for="libelle">Libelle</label>
                    <input class="libellepromo" type="text" placeholder="entrez le libelle" name ="libelle_promo" value="<?php if(isset($_SESSION['libelle_promo'])) echo($_SESSION['libelle_promo']) ?>"/>
                    <span style="color: red;"><?= $erreur_libelle_promo ?></span>
                </div>
                <span style="color: red;"><?= $erreur_duree ?></span>
                <div class="bodynouveaupromodroit3">
                    <div class="datedebut">
                        <label for="datedebutpromo">Date Début</label>
                        <input class="datedebutpromo" type="date"  name="date1" placeholder="MM/DD/YYYY *" value="<?php if(isset($_SESSION['date1'])) echo($_SESSION['date1']) ?>"/>
                        <span style="color: red;"><?= $erreur_date_debut ?></span>
                    </div>
                    <div class="datefin">
                        <label for="datefinpromo">Date Fin</label>
                        <input class="datefinpromo" type="date"  name="date2" placeholder="MM/DD/YYYY *" value="<?php if(isset($_SESSION['date2'])) echo($_SESSION['date2']) ?>" />
                        <span style="color: red;"><?= $erreur_date_fin ?></span>
                    </div>
                </div>
                <div class="bodynouveaupromodroit4">
                    <div class="nouveaureferentiel">
                        <input type="hidden" name="page" value="nouveaupromotion"> 
                        <button type="submit" name="ajoutreferentiel" value="ajoutreferentiel">Ajouter referentielle</button>
                    </div>
                    <div class="nouveaupromotion">
                        <button type="submit" name="nouveaupromotion" value="nouveaupromotion">Créer Promotion</button>
                    </div>
                </div>
            </form>

            <div class="bodynouveaupromodroit5"><h2>Référentiels</h2></div>
        </div>
    </div>
</div>