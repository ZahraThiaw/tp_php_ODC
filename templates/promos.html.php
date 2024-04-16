<div class="bodypromo">
    <div class="promo">
        <div class="promotions"><h2>Promotions</h2></div>
        <div class="promos"><p>Promos . Listes</p></div>
    </div>
    <div class="promopromo">
        <div class="Promotion">
            <div class="div">
                <div class="entete">
                    <div>Liste Des Promotions <span style="color: #009186;">(1)</span></div>
                    <div class="cherch" >
                        <div style="position: relative;">
                            <input type="text" placeholder="Recherche ici...">
                            <i class="fa-solid fa-magnifying-glass" style="position: absolute; right: 33px;top: 10px;"></i>
                        </div>
                        <form action="" method="post">
                            <input type="hidden" name="page" value="nouveaupromotion">
                            <button><i class="fa-solid fa-plus"></i>Nouvelle</button>
                        </form>
                    </div>
                </div>
                <div class="tablepromo">
                    <table>
                        <thead>
                            <tr>
                                <th>Libelle</th>
                                <th>Date Début</th>
                                <th>Date Fin</th>
                                <th>Etat</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($promos as $promo): ?>
                            <tr>
                                <td class="img"><img src="images/promos.png" alt=""> <span><?=$promo['libelle']?></span></td>
                                <td><?= $promo['datedebut'] ?></td>
                                <td><?= $promo['datefin'] ?></td>
                                <td style="color : <?= $promo['etat'] == "Terminée" ? "red" : "green" ?> ";><?= $promo['etat'] ?></td>
                                <td>
                                    <form action="" method="post">
                                        <input type="hidden" name="page" value="promos">
                                        <input type="hidden" name="changePromo" value="<?= $promo['idpromo'] ?>">
                                        <button class="btneditpromo" type="submit"><i class="<?= $promo['etat'] === 'En cours' ? "fa-sharp fa-thin fa-square-check editicon fa-solid" : "fa-sharp fa-thin fa-square editicon fa-solid"?>"></i></button>
                                    </form> 
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                        </tfoot>
                        
                    </table>
                    <div class="itemspromos">
                            <div class="itemspages">
                                <span style="font-weight: 100; color: rgb(54, 54, 54); position: relative; left: 0.1%;">Articles par page : </span>
                                <select name="itemsperpage" id="itemsperpage">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                            </div>

                            <div class="navigation">
                                <span></span>
                                <span id="numview"></span>
                                <form action="" method="post">
                                    <input type="hidden" name="page" value="promos">
                                    <input type="hidden" name="currentpagepromo" value="1">
                                    <button type="submit">I<i class="fa-solid fa-chevron-left"></i></button>
                                </form>

                                <form action="" method="post">
                                    <input type="hidden" name="page" value="promos">
                                    <input type="hidden" name="currentpagepromo" value="<?= max($currentpagepromo - 1, 1) ?>">
                                    <button type="submit"><i class="fa-solid fa-chevron-left"></i></button>
                                </form>

                                <form action="" method="post">
                                    <input type="hidden" name="page" value="promos">
                                    <input type="hidden" name="currentpagepromo" value="<?= min($currentpagepromo + 1, $totalPagespromo) ?>">
                                    <button type="submit"><i class="fa-solid fa-chevron-right"></i></button>
                                </form>

                                <form action="" method="post">
                                    <input type="hidden" name="page" value="promos">
                                    <input type="hidden" name="currentpagepromo" value="<?= $totalPagespromo ?>">
                                    <button type="submit"><i class="fa-solid fa-chevron-right"></i>I</button>
                                </form>
                            </div>
                    
                    </div>
                
                </div>
            </div>
            
        </div>
    </div>
</div>