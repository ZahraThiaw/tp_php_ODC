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