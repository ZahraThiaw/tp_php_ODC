<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <title>projet php Fatimata Thiaw</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/stylepromos.css"> 
    <link rel="stylesheet" href="css/connexion.css">
    <link rel="stylesheet" href="css/stylepromotions.css">
    <link rel="stylesheet" href="css/stylenouveaureferentiel.css">
    <link rel="stylesheet" href="css/stylereferentiels.css">
    <link rel="stylesheet" href="css/styleutilisateurs.css">
    <link rel="stylesheet" href="css/stylenouvelapprenant1.css">
    <link rel="stylesheet" href="css/stylenouvelapprenant2.css">
    <link rel="stylesheet" href="css/styleapprenantparmasse.css">
    <link rel="stylesheet" href="css/stylepresences.css">
</head>
<body>
    <?php

        // Définir la durée de session à 5 minutes (300 secondes)
        $active = 30; // 5 minutes
        ini_set('session.gc_maxlifetime', $active);
        session_start();

                


        require_once("../data/file.csv.php");
        require_once("../config/bootstrap.php");
        require_once("../models/users.model.php");
        require_once("../config/validator.php");
        // $data = lireFile(fileusers);
        // $new = [];
        // foreach($data as $dt){
        //     $dt['password'] = hashPassword($dt['password']);
        //     $new[] = $dt;
        // }
        // // var_dump($new);
        // // die();
        // ecrirefile(fileusers, $new);
        
        $error_message = ""; // Erreur d'email vide ou incorrecte
        $error_message_password = ""; // Erreur de mot de passe vide
        $connexion_error = ""; // Erreur de connexion invalide

        // Vérifier les informations de connexion (e-mail et mot de passe)
        if (isset($_POST['email']) && isset($_POST['password'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $users=findAllUsers();

            if(empty($password) || empty($email)){
                if(empty($email)){
                    $error_message = "Adresse e-mail obligatoire.";
                }
                if(empty($password)){
                        $error_message_password = "Mot de passe obligatoire.";
                }
            }else
            {

                if (!isEmailValid($email)) {
                    $error_message = "Veuillez saisir une adresse e-mail correcte.";
                } else {
                    $user = null;
                    foreach($users as $u){
                        if($u['email'] === $email && verifyPassword($password, $u['password'])){
                            $user = $u;
                            break;
                        }
                    }

                    //Si l'utilisateur est authentifier, afficher le contenu de la page d'accueil
                    if($user){
                        //Stocker l'utilisateur dans la session
                        $_SESSION['user'] = $user;

                        //Redirection vers la page d'accueil en fonction du rôle de l'utilisateur
                        if($user['role'] === 'Admin'){
                            $_POST['page'] = 'promos';
                            // header("Location: promos.html.php");
                            // exit();
                        }elseif ($user['role'] === 'Apprenant'){
                            $_POST['page'] = 'presences';
                            // header("Location: presences.html.php");
                            // exit();
                        }
                    }else{
                        //Si l'utilisateur n'est pas authentifier, afficher le contenu de la page de connexion
                        $connexion_error = "Email ou mot de passe invalide.";
                        require_once("../templates/connexion.html.php");
                    }
                }
            }
        }

        $user = isset($_SESSION['user']) ? $_SESSION['user'] : null;

        // Vérifier si le temps de la dernière activité est défini
        // if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > $active)) {
        //     // Si actif pendant plus de 5 minutes, détruire la session et rediriger vers la page de connexion
        //     session_unset();     // vider la variable $_SESSION pour cette session 
        //     session_destroy();   // détruire les données de session
        //     require_once("../templates/connexion.html.php");
        // }

        // // Mettre à jour le temps de la dernière activité à chaque chargement de page
        // $_SESSION['last_activity'] = time();


        if(!isset($_POST['page'])){
            require_once("../templates/connexion.html.php");
        }
        else{
            require_once("../templates/home.html.php");
            require_once("../models/apprenants.model.php");
            require_once("../models/presences.model.php");
        }
    ?>
</body> 
</html>