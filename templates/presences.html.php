
<div class="content-presences">
    <div class="promopresences">
        <div class="promotionspresences"><h2>Presences <span style="color: #088F89;"><?= $currentPromo['libelle'] ?></span></h2></div>
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
                        <Option value="referentiel"  <?= $_SESSION['user']['role'] === 'Apprenant' ? 'disabled' : ''?>>Référentiel</Option>
                        <Option value="Dev Web/Mobile" <?= $_SESSION['referentiel']== "Dev Web/Mobile" ? "selected" : ""?>>Dev Web/Mobile</Option>
                        <Option value="Référent Digital" <?= $_SESSION['referentiel']== "Référent Digital" ? "selected" : ""?>>Référent Digital</Option>
                        <Option value="Développement Data" <?= $_SESSION['referentiel']== "Développement Data" ? "selected" : ""?>>Développement Data</Option>
                        <Option value="Aws" <?= $_SESSION['referentiel']== "Aws" ? "selected" : ""?>>Aws</Option>
                        <Option value="Hackeuse" <?= $_SESSION['referentiel']== "Hackeuse" ? "selected" : ""?>>Hackeuse</Option>
                    </select>
                </div>
                <input name="date" type="date" id="date" placeholder="AAAA/MM/JJ" value="<?= isset($_SESSION['date']) ? $_SESSION['date'] : date('Y-m-d'); ?>">

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
                <?php  foreach($presentspromo as $studentspresent): ?> 
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
        <div class="pagination">

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
                    <input type="hidden" name="page" value="presences">
                    <input type="hidden" name="currentpagepresent" value="1">
                    <button type="submit">I<i class="fa-solid fa-chevron-left"></i></button>
                </form>

                <form action="" method="post">
                    <input type="hidden" name="page" value="presences">
                    <input type="hidden" name="currentpagepresent" value="<?= max($currentpagepresent - 1, 1) ?>">
                    <button type="submit"><i class="fa-solid fa-chevron-left"></i></button>
                </form>

                <form action="" method="post">
                    <input type="hidden" name="page" value="presences">
                    <input type="hidden" name="currentpagepresent" value="<?= min($currentpagepresent + 1, $totalPagespresent) ?>">
                    <button type="submit"><i class="fa-solid fa-chevron-right"></i></button>
                </form>

                <form action="" method="post">
                    <input type="hidden" name="page" value="presences">
                    <input type="hidden" name="currentpagepresent" value="<?= $totalPagespresent ?>">
                    <button type="submit"><i class="fa-solid fa-chevron-right"></i>I</button>
                </form>
            </div>
            
        </div>
    </div>
</div>