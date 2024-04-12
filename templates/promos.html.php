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
                                <td><input type="checkbox" name="" id=""></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                        </tfoot>
                        
                    </table>
                    <div class="itemspromos">
                        <div class="itemsparpage">
                            <span>Items par page</span>
                            <select name="" id="">
                                <option value="">10</option>
                                <option value="">20</option>
                                <option value="">30</option>
                            </select>
                        </div>
                        <div class="itemspage">
                            <span class="numeropage">1-1 of 1 </span> 
                            <span id="numview"></span>
                            <form action="" method="post">
                            <input type="hidden" name="page" value="promos">
                            <input type="hidden" name="currentpage" value="1">
                            <button type="submit">I<i class="fa-solid fa-chevron-left"></i></button>
                            </form>

                            <form action="" method="post">
                            <input type="hidden" name="page" value="promos">
                            <input type="hidden" name="currentpage" value="<?= $currentpage -1 ?>">
                            <button type="submit"><i class="fa-solid fa-chevron-left"></i></button>
                            </form>

                            <form action="" method="post">
                            <input type="hidden" name="page" value="promos">
                            <input type="hidden" name="currentpage" value="<?= $currentpage +1 ?>">
                            <button type="submit"><i class="fa-solid fa-chevron-right"></i></button>
                            </form>

                            <form action="" method="post">
                            <input type="hidden" name="page" value="promos">
                            <input type="hidden" name="currentpage" value="<?= $totalPages ?>">
                            <button type="submit"><i class="fa-solid fa-chevron-right"></i>I</button>
                            </form>
                        </div>
                    </div>
                
                </div>
            </div>
            
        </div>
    </div>
</div>