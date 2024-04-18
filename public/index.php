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
        
        $error_message = "";
        $connexion_error = ""; // Erreur de connexion invalide

        // Vérifier les informations de connexion (e-mail et mot de passe)
        if (isset($_POST['email']) && isset($_POST['password'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $users=findAllUsers();

            if (!isEmailValid($email)) {
                $error_message = "Veuillez saisir une adresse e-mail valide.";
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