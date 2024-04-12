<?php

$mot = $_POST['recherche'];
$_SESSION['mot'] = $mot;
$page = $_SESSION['page'];
switch($page){

    case 'utilisateurs':
        $students = recherche($students, 'nom', $mot);
        include("../templates/utilisateurs.html.php");
        break;
    case 'referentiels':
       
        $referentielsForCurrentPromo = recherche($referentielsForCurrentPromo, 'referentiel', $mot);
        include("../templates/referentiels.html.php");
        break;
    case 'promos':
        $promos = recherche($promos, 'libelle', $mot);
        include("../templates/promos.html.php");
        break;
    case 'presences':
        //$studentpresents = $_SESSION['presences']? $_SESSION['presences'] : $presences;
        $filteredPresences = recherche($filteredPresences, 'Nom', $mot);
        include("../templates/presences.html.php");
        break;
}
?>