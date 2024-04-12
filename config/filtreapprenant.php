<?php

$motfiltre = $_POST['recherchefiltre'];
$_SESSION['motfiltre']= $motfiltre;
$page = $_SESSION['page'];
$students = findAllStudents();
if ($_POST['page']== 'utilisateurs'){
    switch($students){
        case 'nom':
            $students = recherche($students, 'nom', $motfiltre);
            require_once("../templates/utilisateurs.html.php");
            break;
        case 'prenom':
            $students = recherche($students, 'prenom', $motfiltre);
            require_once("../templates/utilisateurs.html.php");
            break;
        case 'email':
            $students = recherche($students, 'email', $motfiltre);
            require_once("../templates/utilisateurs.html.php");
            break;
        case 'genre':
            $students = recherche($students, 'genre', $motfiltre);
            require_once("../templates/utilisateurs.html.php");
            break;
        case 'telephone':
            $students = recherche($students, 'telephone', $motfiltre);
            require_once("../templates/utilisateurs.html.php");
            break;
    }
    
//   if($motfiltre = $students['nom']){
//         $students = recherche($students, 'nom', $motfiltre);
//         require_once("../templates/utilisateurs.html.php");
//     }else
//     if($motfiltre = $students['prenom']){
//         $students = recherche($students, 'prenom', $motfiltre);
//         $apprenantfiltre = filter_apprenant($nom, $prenom, $email, $genre, $telephone);
//         require_once("../templates/utilisateurs.html.php");
//     }else
//     if($motfiltre = $students['email']){
//         $students = recherche($students, 'email', $motfiltre);
//         $apprenantfiltre = filter_apprenant($nom, $prenom, $email, $genre, $telephone);
//         require_once("../templates/utilisateurs.html.php");
//     }else
//     if($motfiltre = $students['genre']){
//         $students = recherche($students, 'genre', $motfiltre);
//         $apprenantfiltre = filter_apprenant($nom, $prenom, $email, $genre, $telephone);
//         require_once("../templates/utilisateurs.html.php");
//     }else
//     if($motfiltre = $students['telephone']){
//         $students = recherche($students, 'telephone', $motfiltre);
//         $apprenantfiltre = filter_apprenant($nom, $prenom, $email, $genre, $telephone);
//         require_once("../templates/utilisateurs.html.php");
//     }
}

?>