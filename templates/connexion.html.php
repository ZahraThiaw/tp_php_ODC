<div class="containerconnexion">
        <img src="images/Logo-Sonatel-Academy.png" alt="logo Sonatel Academy">
        <form action="" method="post">
            <div class="infoslogin">
                <span style="color: red;"><?= $connexion_error ?></span>
                <label for="email">Email Adress <span>*</span></label>
                <input type="text" name="email" id="email" placeholder="Enter email adress *">
                <span style="color: red;"><?= $error_message ?></span>
                <label for="password">Password <span>*</span></label>
                <input type="password" name="password" id="password" placeholder="Enter your password *">
                <span style="color: red;"><?= $error_message_password ?></span>
            </div>
            <div class="sauvegarde">
                <div>
                    <input type="checkbox" name="remember" id="remember">
                    <label for="remember">Remember me</label>
                </div>
                <p>Mot de passe Oublié?</p>
            </div>
            <div class="connecter"> 
                    <!-- <input type="hidden" name="page" value="promos"> -->
                    <button type="submit">Log In</button>
            </div>
        </form>
</div>