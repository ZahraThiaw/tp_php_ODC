<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <title>projet php Fatimata Thiaw</title>
</head>
<body>
    <div class="container">

        <?php
            require_once("../templates/partial/menu.html.php");
        ?>
        <div class="contenu">
            <?php
                require_once("../templates/partial/header.html.php");
                if(isset($_POST['deconnexion']) && $_POST['deconnexion'] == 'deconnexion'){
                    require_once("../templates/connexion.html.php");
                }
            ?>
            <div class="bodycontenu">
                
                <?php
                require_once("../config/helpers.php");

                require_once("../config/bootstrap.php");
                require_once("../data/file.csv.php");
                require_once("../models/apprenants.model.php");
                $students = findAllStudents();

                require_once("../models/recherches.model.php");
                require_once("../models/presences.model.php");
                require_once("../models/referentiels.model.php");
                require_once("../models/promos.model.php");
                $promos = findAllPromos();


                $currentPromo = null;
                // Trouver la promotion en cours
                foreach($promos as $promo) {
                    if($promo['etat'] === 'En cours') {
                        $currentPromo = $promo;
                        break;
                    }
                }
                if($currentPromo) {
                    $allReferentiels = findAllReferentiel();
                    // Filtrer les référentiels actifs pour la promotion en cours
                    $referentielsForCurrentPromo = array_filter($allReferentiels, function($referentiel) use ($currentPromo) {
                        return $referentiel['idpromo'] === $currentPromo['idpromo'] && $referentiel['etatreferentiel'] === 'Active';
                    });

                };

                if(isset($_POST['changePromo']) && $_POST['changePromo'] !=''){
                    $idpromo = $_POST['changePromo'];
                    promotionCheck($currentPromo['idpromo'], $idpromo);
                    $currentPromo['idpromo'] = $idpromo;
                    $promos = findAllPromos();
                }

                
                $currentreferentiel=null;
                //Trouver les referentiels actifs pour la promo en cours
                foreach($referentielsForCurrentPromo as $referentiel){
                    $currentreferentiel=$referentiel;
                    break;
                }


                if($currentreferentiel){
                    $apprenants = findAllStudents();
                    // Filtrer les apprenants pour les referentiel actifs de la promotion en cours
                    $apprenantsForCurrentPromo = array_filter($apprenants, function($apprenant) use ($currentreferentiel) {
                        return $apprenant['idpromo'] === $currentreferentiel['idpromo'];
                    });
                }


                if(isset($_POST['appreferentiel'] )) {
                  //  dd($_POST['referentiel']);
                    $selectedReferentiel = $_POST['appreferentiel'];
                    $_SESSION['appreferentiel']= $selectedReferentiel;
                    if ($selectedReferentiel == 'referentiel' ) {
                        return $apprenantsForCurrentPromo;
                    }
                    $apprenantsForSelectedReferentiel = array_filter($apprenantsForCurrentPromo, function($apprenant) use ($selectedReferentiel) {
                        return $apprenant['referentiel'] === $selectedReferentiel;
                    });

                    $apprenantsForCurrentPromo = $apprenantsForSelectedReferentiel;
                }


                if (isset($_POST['idreferentiel'])) {
                    $idreferentiel = $_POST['idreferentiel'];
                    $apprenantsForSelectedReferentiel = array_filter($apprenantsForCurrentPromo, function($apprenant) use ($idreferentiel) {
                        return $apprenant['referentiel'] === $idreferentiel;
                    });
                    $apprenantsForCurrentPromo = $apprenantsForSelectedReferentiel;
                }
                

                $elementparpagepromo=2;
                $currentpagepromo=1;
                $totalItemspromo = count($promos);
                $totalPagespromo = ceil($totalItemspromo / $elementparpagepromo);
                $paginationpromo=paginateTable($promos, $elementparpagepromo, $currentpagepromo);

                

                if(isset($_POST['currentpagepromo'])){
                
                    $currentpagepromo = $_POST['currentpagepromo'];
                    $paginationpromo = paginateTable($promos, $elementparpagepromo, $currentpagepromo);
                        
                }


                $studentpresent = generateStudentspresents();


                // Par défaut, afficher les présences de la date du jour
                $date = date("Y-m-d"); // Obtient la date du jour au format YYYY-MM-DD
                $filteredPresences = filter_presence('statuts', 'referentiel', $date); // Filtrer par date du jour
                $elementparpagepresent=5;
                $currentpagepresent=1;
                $totalItemspresent = count($filteredPresences);
                $totalPagespresent = ceil($totalItemspresent / $elementparpagepresent);
                $paginationpresence=paginateTable($filteredPresences, $elementparpagepresent, $currentpagepresent);
                if($currentreferentiel){
                    $presentpagines=$paginationpresence;
                    // Filtrer les apprenants pour les referentiel actifs de la promotion en cours
                    $presentspromo = array_filter($presentpagines, function($present) use ($currentreferentiel) {
                        return $present['idpromo'] === $currentreferentiel['idpromo'];
                    });
                }

                if(isset($_POST['currentpagepresent'])){
                    $currentpagepresent = $_POST['currentpagepresent'];
                    $paginationpresence = paginateTable($filteredPresences, $elementparpagepresent, $currentpagepresent);
                    if($currentreferentiel){
                        $presentpagines=$paginationpresence;
                        // Filtrer les apprenants pour les referentiel actifs de la promotion en cours
                        $presentspromo = array_filter($presentpagines, function($present) use ($currentreferentiel) {
                            return $present['idpromo'] === $currentreferentiel['idpromo'];
                        });
                    }
                        
                }


                if(file_exists("../templates/" . $_POST['page'] . ".html.php")){

                    include("../templates/" . $_POST['page'] . ".html.php");
                    $_SESSION['page'] = $_POST['page'];
                }

                

                if(isset($_POST['filtre']) && $_POST['filtre'] == 'filtre'){
                    $status = $_POST['statuts'];
                    $referentiel = $_POST['referentiel'];
                    $date = $_POST['date'];
                    //$studentpresents = filter_presence($status, $referentiel, $date);
                    // Pour filtrer les présences pour le statut "ABSENT", le référentiel "Référent Digital" et la date "2024-04-09"
                    $_SESSION['statuts']= $status;
                    $_SESSION['referentiel']=$referentiel;
                    $_SESSION['date']= $date;


                    $filteredPresences = filter_presence($status, $referentiel, $date);
                    $paginationpresence=paginateTable($filteredPresences, $elementparpagepresent, $currentpagepresent);
                    if($currentreferentiel){
                        $presentpagines=$paginationpresence;
                        // Filtrer les apprenants pour les referentiel actifs de la promotion en cours
                        $presentspromo = array_filter($presentpagines, function($present) use ($currentreferentiel) {
                            return $present['idpromo'] === $currentreferentiel['idpromo'];
                        });
                    }
                


                    if(isset($_POST['currentpagepresent'])){
                    
                        $currentpagepresent = $_POST['currentpagepresent'];
                        $paginationpresence = paginateTable($filteredPresences, $elementparpagepresent, $currentpagepresent);
                        if($currentreferentiel){
                            $presentpagines=$paginationpresence;
                            // Filtrer les apprenants pour les referentiel actifs de la promotion en cours
                            $presentspromo = array_filter($presentpagines, function($present) use ($currentreferentiel) {
                                return $present['idpromo'] === $currentreferentiel['idpromo'];
                            });
                        }
                            
                    }
                    require_once("../templates/presences.html.php");

                }


                if(isset($_POST['page']) && $_POST['page'] == 'mot'){
                    $page = $_SESSION['page'];
                    require_once("../config/recherche.php");
                }

                if(isset($_POST['page']) && $_POST['page'] == 'motfiltre'){
                    $motfiltre = $_POST['recherchefiltre'];
                    $_SESSION['motfiltre'] = $motfiltre;
                    require_once("../models/recherches.model.php");
                    $apprenantsForCurrentPromo= seachUser($apprenantsForCurrentPromo,$motfiltre);
                    require_once("../templates/utilisateurs.html.php");
                }
                
                ?>
            </div>
            <?php
                require_once("../templates/partial/footer.html.php");
            ?>
        </div>
    </div>
</body>
</html>