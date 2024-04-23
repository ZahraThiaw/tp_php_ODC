    <div class="nouveaureferentiels">
    <div class="promonouveaureferentiels">
        <div class="promotionsnouveaureferentiels"><h2>Promotions</h2></div>
        <div class="promosnouveaureferentiels"><p>Promos . Création</p></div>
    </div>
    <div class="bodynouveaureferentiels">
        <div class="numeronouveaureferentiels">
            <div class="numero1nouveaureferentiels">/</div>
            <div class="traitnouveaureferentiels"></div>
            <div class="numero2nouveaureferentiels">2</div>
        </div>
        <div class="bodynouveaureferentielsdroittout">
            <div class="bodynouveaureferentielsdroit">
                <div class="bodynouveaureferentielsdroit1"><h2>Promotion</h2></div>
                <div class="bodynouveaureferentielsdroit2"><h2>Référentiels</h2></div>
            </div>
            <div class="selection">
                
                <form action="" method="post">
                    <span>Sélectionner un ou plusieurs référentiels</span>
                    <?php foreach ($toutLesReferentiels as $referentiel): ?>
                        <div>
                            <?php
                             $checked = '';
                             $disabled = '';
                             // Vérifie si le référentiel est associé à la promotion existante
                             if (promotion_has_referentiel($promotion_id, $referentiel['libelle'])) {
                                 $checked = 'checked';
                             }
                             // Vérifie si le référentiel a au moins un apprenant associé
                             if (referentiel_has_students($referentiel['libelle'], $promotion_id)) {
                                 $disabled = 'disabled';
                             }
                            ?>
                            <input type="checkbox" name="referentiels_selectionnes[]" value="<?= $referentiel['libelle'] ?>" <?= $checked ?> <?= $disabled ?>/>
                            <label><?= $referentiel['libelle'] ?></label>
                        </div>
                    <?php endforeach; ?>
                    <div class="button">
                        <form action="" method="post">
                            <input type="hidden" name="page" value="nouveaupromotion">
                            <button type="submit" id="back" name="back" class="back">Retour</button>
                        </form>
                        <button type="submit" name="creer" class="creer">Créer</button>
                    </div>
                </form>

            </div>
        </div>
        
    </div>
</div>