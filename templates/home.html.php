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
            SESSION_start();
            require_once("../templates/partial/menu.html.php");
        ?>
        <div class="contenu">
            <?php
                require_once("../templates/partial/header.html.php");
            ?>
            <div class="bodycontenu">
                
                <?php
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

                    
                }
              

                $studentpresent = generateStudentspresents();

                // Par défaut, afficher les présences de la date du jour
                $date = date("Y-m-d"); // Obtient la date du jour au format YYYY-MM-DD
                $filteredPresences = filter_presence('statuts', 'referentiel', $date); // Filtrer par date du jour
                $elementparpagepresent=3;
                $currentpage=1;
                $totalItems = count($filteredPresences);
                $totalPages = ceil($totalItems / $elementparpagepresent);
                $paginationpresence=paginateTable($filteredPresences, $elementparpagepresent, $currentpage);
                //  var_dump($paginationpresence);
                // die();


                if(isset($_POST['currentpage'])){
                //     var_dump($_POST['currentpage']);
                // die();
                    $currentpage = $_POST['currentpage'];
                    $paginationpresence = paginateTable($filteredPresences, $elementparpagepresent, $currentpage);
                        
                }


                if(file_exists("../templates/" . $_POST['page'] . ".html.php")){

                    include("../templates/" . $_POST['page'] . ".html.php");
                    $_SESSION['page'] = $_POST['page'];

                }else 
                  
                if(isset($_POST['filtre']) && $_POST['filtre'] == 'filtre'){
                    $status = $_POST['statuts'];
                    $referentiel = $_POST['referentiel'];
                    $date = $_POST['date'];
                    //$studentpresents = filter_presence($status, $referentiel, $date);
                    // Pour filtrer les présences pour le statut "ABSENT", le référentiel "Référent Digital" et la date "2024-04-09"
                    $filteredPresences = filter_presence($status, $referentiel, $date);
                    $paginationpresence=paginateTable($filteredPresences, $elementparpagepresent, $currentpage);
                //  var_dump($paginationpresence);
                // die();


                    if(isset($_POST['currentpage'])){
                    // var_dump($_POST['currentpage']);
                    // die();
                        $currentpage = $_POST['currentpage'];
                        $paginationpresence = paginateTable($filteredPresences, $elementparpagepresent, $currentpage);
                            
                    }
                    $_SESSION['statuts']= $status;
                    $_SESSION['referentiel']=$referentiel;
                    $_SESSION['date']= $date;
                    include("../templates/presences.html.php");

                }

                if(isset($_POST['page']) && $_POST['page'] == 'mot'){
                    $page = $_SESSION['page'];
                    require_once("../config/recherche.php");
                }

                if(isset($_POST['page']) && $_POST['page'] == 'motfiltre'){
                    $motfiltre = $_POST['recherchefiltre'];
                    $_SESSION['motfiltre'] = $motfiltre;
                    require_once("../models/recherches.model.php");
                    $students= seachUser($students,$motfiltre);
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