<div class="headpromo">
    <div class="headpromogauche">
        <div class="iconebar">
            <label for="burger-toggle" class="burger-icon">
                <i class="fa-solid fa-bars"></i>
            </label>
        </div>
        <div class="iconegrid"><img src="../public/images/menu.png" alt=""></div>
        <div class="barrederecherche">
            <form action="" method="post">
                <input type="hidden" name="page" value="mot">
                <input type="search" name="recherche" id="barrederecherche" placeholder="Rechercher par matricule" <?= isset($_POST['recherche']) ? 'value="' . $_POST['recherche'] . '"' : '' ?>>
                <i class="fa-solid fa-magnifying-glass"></i>
            </form>
        </div>
    </div>
    <div class="headpromodroit">
        <div class="date"><i class="fa-solid fa-calendar-days"></i> 20 March 2024</div>
        <div class="utilisateur">
            <div class="profileuser"><i class="fa-solid fa-user"></i></div>
            <div class="users">
                <div class="typeuser">FATIMATA_THIAW</div>
                <div class="nomuser">
                    <select name="nomuser" id="nomuser">
                        <option value="nomuser">Admin Admin</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>