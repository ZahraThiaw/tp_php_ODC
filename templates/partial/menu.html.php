
<input type="checkbox" id="burger-toggle" class="burger-toggle">
<div class="menu">
    <div class="logo">
        <img src="images/Logo-Sonatel-Academy.png" alt="logo Sonatel Academy">
    </div>
    <div class="menutext">
        <div class="menutextbar"></div>
        <div class="menutext1">-MENU</div>
    </div>
    <div class="navbar">
        <nav>
            <ul>
                <li>
                    <form action="" method="post">
                        <input type="hidden" name="page" value="dashboard">
                        <button type="submit"><i class="fa-solid fa-bars-staggered"></i>Dashboard</button>
                    </form>
                </li>
                <li>
                    <form action="" method="post">
                        <input type="hidden" name="page" value="promos">
                        <button type="submit" <?= $_SESSION['user']['role'] === 'Apprenant' ? 'disabled' : '' ?>><i class="fa-regular fa-calendar-days"></i>Promos</button>
                    </form>
                </li>
                <li>
                    <form action="" method="post">
                        <input type="hidden" name="page" value="referentiels">
                        <button type="submit" <?= $_SESSION['user']['role'] === 'Apprenant' ? 'disabled' : '' ?>><i class="fa-solid fa-calendar-days"></i>Referentiels</button>
                    </form>    
                </li>
                <li>
                    <form action="" method="post">
                        <input type="hidden" name="page" value="utilisateurs">
                        <button type="submit" <?= $_SESSION['user']['role'] === 'Apprenant' ? 'disabled' : '' ?>><i class="fa-regular fa-circle-user"></i>Utilisateurs</button>
                    </form>
                </li>
                <li>
                    <form action="" method="post">
                        <input type="hidden" name="page" value="visiteurs">
                        <button type="submit" <?= $_SESSION['user']['role'] === 'Apprenant' ? 'disabled' : '' ?>><i class="fa-regular fa-circle-user"></i>Visiteurs</button>
                    </form>
                </li>
                <li>
                    <form action="" method="post">
                        <input type="hidden" name="page" value="presences">
                        <button type="submit"><i class="fa-regular fa-circle-user"></i>Presences</button>
                    </form>
                </li>
                <li>
                    <form action="" method="post">
                        <input type="hidden" name="page" value="evenements">
                        <button type="submit"><i class="fa-solid fa-calendar-days"></i>Evenements</button>
                    </form>
                </li>
            </ul>
        </nav>
    </div>
</div>

<?php if ($_SESSION['user']['role'] === 'Apprenant') : ?>
    <style>
        .menu .navbar nav ul li form button:hover {
            background-color: none;
        }
    </style>
<?php endif; ?>



