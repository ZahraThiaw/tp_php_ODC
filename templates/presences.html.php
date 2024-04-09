
<div class="content-presences">
    <div class="promopresences">
        <div class="promotionspresences"><h2>Presences</h2></div>
        <div class="promospresences"><p>Presences . Listes</p></div>
    </div>
    <div class="contenu-presences">
        <div class="zone1">
            <form action="" method="post">
                <div class="select1">
                    <select name="statuts" id="statut">
                        <Option value="statuts">Statut</Option>
                        <Option value="PRESENT" <?= $_SESSION['statuts']== "PRESENT" ? "selected" : ""?>>Présent</Option>
                        <Option value="ABSENT" <?= $_SESSION['statuts']== "ABSENT" ? "selected" : ""?>>Absent</Option>
                    </select>
                </div>
                <div class="select2">
                    <select name="referentiel" id="selectreferentiel">
                        <Option value="referentiel">Référentiel</Option>
                        <Option value="Dev Web/Mobile" <?= $_SESSION['referentiel']== "Dev Web/Mobile" ? "selected" : ""?>>Dev Web/Mobile</Option>
                        <Option value="Référent Digital" <?= $_SESSION['referentiel']== "Référent Digital" ? "selected" : ""?>>Référent Digital</Option>
                        <Option value="Développement Data" <?= $_SESSION['referentiel']== "Développement Data" ? "selected" : ""?>>Développement Data</Option>
                        <Option value="Aws" <?= $_SESSION['referentiel']== "Aws" ? "selected" : ""?>>Aws</Option>
                        <Option value="Hackeuse" <?= $_SESSION['referentiel']== "Hackeuse" ? "selected" : ""?>>Hackeuse</Option>
                    </select>
                </div>
                <input type="date" id="datechoice" placeholder="JJ/MM/AAAA">

                <input type="hidden" name="page">
                <input type="hidden" name="filtre" value="filtre">
                <button id="refresh">Rafraîchir</button>
            </form>
        </div>

        <div class="tableaupresence">
            <table>
                <tr>
                    <th>Matricule</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Téléphone</th>
                    <th>Référentiel</th>
                    <th>Heure d'arrivée</th>
                    <th>Status</th>
                </tr>
                <?php   foreach($studentpresents as $studentspresent): ?> 
                    <?php //foreach($presencesPaginees as $studentspresent): ?>

                <tr>
                    <td style="color: rgb(88, 179, 4);"><?= $studentspresent['Matricule'] ?> </td>
                    <td><?= $studentspresent['Nom'] ?></td>
                    <td><?= $studentspresent['Prenom'] ?></td>
                    <td><?= $studentspresent['Telephone'] ?></td>
                    <td><?= $studentspresent['referentiel'] ?></td>
                    <td style="color : <?= $studentspresent["Heure d'arrivee"] > "08:15" ? "red" : "green" ?> ";><?= $studentspresent["Heure d'arrivee"] ?></td>
                    <td style="color : <?= $studentspresent['statuts'] == "ABSENT" ? "red" : "green" ?> ";><?= $studentspresent['statuts'] ?></td>
                </tr>
                <?php endforeach; ?>
            </table>
        </div>
        <div class="footer-presence">

        <?php foreach ($presenceOnPage as $pagination): ?>

            <div class="pagination">
                <span>Page <?= $pagination['currentPage'] ?> - <?= $pagination['totalPages'] ?></span>
                <form action="" method="post">
                    <input type="hidden" name="pages">
                    <input type="hidden" name="prevPage" value="prevPage">
                    <button <?= $pagination['prevPage'] ?>><i class="fa-solid fa-chevron-left"></i></button>
                </form>
                <form action="" method="post">
                    <input type="hidden" name="pages">
                    <input type="hidden" name="nextPage" value="nextPage">
                    <button <?= $pagination['nextPage'] ?>> <i class="fa-solid fa-chevron-right"></i></button>
                </form>
                
            </div>

        <?php endforeach; ?>
        <!-- <form action="" method="post">
            <span style="font-weight: 100; color: rgb(54, 54, 54); position: relative; left: 0.1%;">Items per page: </span>
            <select name="itemsperpage" id="itemsperpage">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="4">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
            </select>
            
            <div class="navigation">
                <span id="numview"><?php //echo ($numero_page - 1) * $etudiants_par_page + 1; ?> - <?php //echo min($numero_page * $etudiants_par_page, count($etudiants)); ?> of <?php echo count($etudiants); ?></span>
                <button type="submit" name="action" value="first">I<i class="fa-solid fa-chevron-left"></i></button>
                <button type="submit" name="action" value="previous"><i class="fa-solid fa-chevron-left"></i></button>
                <button type="submit" name="action" value="next"><i class="fa-solid fa-chevron-right"></i></button>
                <button type="submit" name="action" value="last"><i class="fa-solid fa-chevron-right"></i>I</button>
            </div>
        </form> -->

            <?php //if ($pages > 1) : ?>
                <!-- <a href="?page=pre&pages=<?php //echo ($pages - 1) ?>"><</a> -->
                <!-- <form action="" method="post">
                        <input type="hidden" name="page" value="presences">
                        <button type="submit">Presences</button>
                </form> -->
                <?php //endif ?>
                <?php //for ($i = 1; $i <= ceil(count($listes,) / $elementsParPage); $i++) : ?>
                    <!-- <a href="?page=pre&pages=<?php //echo $i ?>" <?php //if ($i == $pages) echo 'style="font-weight:bold;"' ?>><?php //echo $i ?></a> -->
                <?php //endfor ?>
                <?php //if ($pages >= ceil(count($listes,) / $elementsParPage)) : ?>
                    <!-- <a href="?page=pre&pages=<?php //echo ($pages + 1) ?>">></a> -->
                <?php //endif 
            ?>
        </div>

    </div>



           
</div>