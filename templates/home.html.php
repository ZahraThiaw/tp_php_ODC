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
                    session_unset();     // vider la variable $_SESSION pour cette session 
                    session_destroy();   // détruire les données de session
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

                $studentpresent = generateStudentspresents();

                $users = findAllUsers();
                $user = isset($_SESSION['user']) ? $_SESSION['user'] : null;

                $currentuser = null;
                // Trouver l'utilisateur actuellement connecté
                foreach($users as $user) {
                    if($user['iduser'] === $_SESSION['user']['iduser']){
                        $currentuser = $user;
                        break;
                    }
                }

                // Parcourir les données des présences pour trouver le référentiel de l'utilisateur connecté
                $referentieluser = null;
                foreach($studentpresent as $present) {
                    if($present['iduser'] === $currentuser['iduser']){
                        $referentieluser = $present;
                        break;
                    }
                }
                
                //Trouver l'idpromo de l'apprenant connecté
                $idpromouser = null;
                foreach($studentpresent as $present) {
                    if($present['iduser'] === $currentuser['iduser']){
                        $idpromouser = $present['idpromo'];
                        break;
                    }
                }

                //Trouver la promo de l'apprenant connecté
                $promouser = null;
                foreach($promos as $promo) {
                    if($promo['idpromo'] === $idpromouser){
                        $promouser = $promo;
                        break;
                    }
                }

                //Afficher tous les precences de l'apprenant connecté
                if( $currentuser){
                    if($currentuser['role'] === 'Apprenant'){
                        $studentpresent = generateStudentspresents();
                        $presencessapprenants= array_filter($studentpresent, function($present) use ($currentuser) {
                            return $present['iduser'] === $currentuser['iduser'];
                        });

                        // // Nombre total de présences de l'apprenant connecté
                        // $totalPresences = count($presencessapprenants);

                        // // Nombre de présences à afficher par page
                        // $presencesParPage = 3;

                        // // Calcul du nombre total de pages
                        // $totalPages = ceil($totalPresences / $presencesParPage);

                        // // Récupération du numéro de page actuelle, par défaut à 1 si non spécifié
                        // $pageActuelle = isset($_POST['pages']) ? $_POST['pages'] : 1;

                        // // Calcul de l'indice de début et de fin pour les présences à afficher sur la page actuelle
                        // $indiceDebut = ($pageActuelle - 1) * $presencesParPage;
                        // $indiceFin = $indiceDebut + $presencesParPage - 1;

                        // // Sélection des présences à afficher sur la page actuelle
                        // $presencessapprenants = array_slice($presencessapprenants, $indiceDebut, $presencesParPage);


                        // Filtrer par statut et date si des valeurs sont fournies
                        if(isset($_POST['filtre']) && $_POST['filtre'] == 'filtre'){

                            // Filtrer par statut si une valeur est fournie
                        if (isset($_SESSION['statuts'])) {
                            $statut = $_SESSION['statuts'];
                            $presencessapprenants = filterPresenceByStatus($presencessapprenants, $statut);
                        }

                        // Filtrer par date si une valeur est fournie
                        if (isset($_POST['date'])) {
                            $date = $_POST['date'];
                            $presencessapprenants = filterPresenceByDate($presencessapprenants, $date);
                        }

                        
                            
                        }
                    }
                }


                $erreur_libelle_promo = "";
                $erreur_date_debut = "";
                $erreur_date_fin = "";
                $erreur_duree = "";
                //Ajouter une nouvelle promotion      
                if(isset($_POST['nouveaupromotion']) && $_POST['nouveaupromotion'] == 'nouveaupromotion'){
                    $libellepromo=$_POST['libelle_promo'];
                    $datedebutpromo=$_POST['date1'];
                    $datefinpromo=$_POST['date2'];

                    $_SESSION['libelle_promo'] = $libellepromo;
                    $_SESSION['date1'] = $datedebutpromo;
                    $_SESSION['date2'] = $datefinpromo;

                    // Vérifier si le libellé est vide
                    if (empty($libellepromo)) {
                        $_POST['page'] = 'nouveaupromotion';
                        $erreur_libelle_promo    = "Le libellé de la promotion est obligatoire.";
                        unset($_SESSION['libelle_promo']);
                    }

                    // Vérifier si la date de début est vide
                    if (empty($datedebutpromo)) {
                        $_POST['page'] = 'nouveaupromotion';
                        $erreur_date_debut = "La date de début de la promotion est obligatoire.";
                        unset($_SESSION['date1']);
                    }

                    // Vérifier si la date de fin est vide
                    if (empty($datefinpromo)) {
                        $_POST['page'] = 'nouveaupromotion';
                        $erreur_date_fin = "La date de fin de la promotion est obligatoire.";
                        unset($_SESSION['date2']);
                    }

                    // Vérifier l'existence du libellé et la durée de la promotion
                    if (!check_promotion_existence($libellepromo)) {
                        
                        if(!empty($datedebutpromo) && !empty($datefinpromo)){
                            $duration = calculate_promotion_duration($datedebutpromo, $datefinpromo);
                            if ($duration >= 120) { // 4 mois = 120 jours
                                add_promotion($libellepromo, $datedebutpromo, $datefinpromo);
                                $_POST['page'] = 'nouveaureferentiel';
                                //$toutLesReferentiels = lireFile(fileallreferentiels);
                            
                                $success_message = "Nouvelle promotion ajoutée avec succès!";
                            } else {
                                $_POST['page'] = 'nouveaupromotion';
                                $erreur_duree = "La durée de la promotion doit être superieure à 4 mois.";
                                unset($_SESSION['date1']);
                                unset($_SESSION['date2']);
                            }
                        }                      
                    } else {
                        $_POST['page'] = 'nouveaupromotion';
                        $erreur_libelle_promo = "Le libellé de la promotion existe déjà. Vous pouvez ajouter des référentiels.";
                    }
                    unset($_SESSION['date1']);
                    unset($_SESSION['date2']);
                }
                

                //Ajouter un referentiel
                if(isset($_POST['ajoutreferentiel']) && $_POST['ajoutreferentiel'] == 'ajoutreferentiel'){
                    $libellepromo=$_POST['libelle_promo'];
                    $_SESSION['libelle_promo']= $libellepromo;
                    // Vérifier si le libellé est vide
                    if (empty($libellepromo)) {
                        $_POST['page'] = 'nouveaupromotion';
                        $erreur_libelle_promo    = "Le libellé de la promotion est obligatoire.";
                    } else {
                        // Vérifier l'existence du libellé
                        if (check_promotion_existence($libellepromo)) {
                            $_POST['page'] = 'nouveaureferentiel';
                        } else {
                            $_POST['page'] = 'nouveaupromotion';
                            $erreur_libelle_promo = "Le libellé de la promotion n'existe pas. Vous devez d'abord l'ajouter.";
                        }
                    }
                }
                
                $toutLesReferentiels = lireFile(fileallreferentiels);
                $promotion_id =  get_promotion_id_from_csv($_SESSION['libelle_promo'], filepromos);
                
                if (isset($_POST['creer'])) {
                    // Assurez-vous que les référentiels sont sélectionnés
                    if (isset($_POST['referentiels_selectionnes']) && is_array($_POST['referentiels_selectionnes'])) {
                        $referentiels_selectionnes = $_POST['referentiels_selectionnes'];
                        
                        // Ouverture du fichier CSV en mode lecture et écriture
                        $file_path = filereferentiels;
                        $file = fopen($file_path, 'a+');
                        if ($file) {
                            // Ajout de chaque association au fichier CSV
                            foreach ($referentiels_selectionnes as $referentiel) {
                                // Vérifier si le référentiel est déjà associé à la promotion
                                $referentiel_exists = referentiel_exists_in_promotion($referentiel, $promotion_id, $file_path);
                                
                                if (!$referentiel_exists) {
                                    $referentiel_id = get_promotion_id_from_csv($referentiel,  $file_path);
                                    // Écriture des données dans le fichier filereferentiels
                                    fputcsv($file, [$referentiel_id, $referentiel, 'Active', 'classe.jpeg', ' ', $promotion_id]);
                                }
                            }
                            
                            // Fermeture du fichier CSV
                            fclose($file);
                            
                            // Redirigez l'utilisateur ou affichez un message de succès
                            //$_POST['page'] = 'nouveaureferentiel';
                            require_once("../templates/nouveaupromotion.html.php");
                            $success_message = "Referentiels ajoutés avec succès!";
                        } else {
                            // Gestion de l'erreur si le fichier ne peut pas être ouvert
                            $erreur_fichier = "Impossible d'ouvrir le fichier CSV.";
                        }
                    } else {
                        // Si aucun référentiel n'est sélectionné, affichez un message d'erreur
                        $erreur_referentiel = "Veuillez sélectionner au moins un référentiel.";
                    }

                    unset($_SESSION['libelle_promo']);
                }

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
                
                $erreur_libelle = "";
                $erreur_description = "";
                $erreur_image = "";

                // Traitement du formulaire pour ajouter un nouveau référentiel
                if (isset($_POST['nouveaureferentiel']) && $_POST['nouveaureferentiel'] == 'nouveaureferentiel') {
                    // Récupérer les valeurs du formulaire
                    $libelle = $_POST['libelle'];
                    $description = $_POST['description'];
                    $imagePath = ""; // Vous devez traiter l'upload de l'image ici// Vérifier si un fichier a été uploadé
                    if(isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                        // Vérifier si le fichier est une image
                        $imageType = exif_imagetype($_FILES['image']['tmp_name']);
                        if($imageType === IMAGETYPE_JPEG || $imageType === IMAGETYPE_PNG || $imageType === IMAGETYPE_GIF) {
                            // Déplacer le fichier uploadé vers le répertoire souhaité
                            $uploadDir = "../public/images/";
                            $uploadFile = $uploadDir . basename($_FILES['image']['name']);
                    
                            if(move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
                                $imagePath = basename($_FILES['image']['name']);
                            } else {
                                $erreur_image = "Une erreur est survenue lors du chargement de l'image.";
                            }
                        } else {
                            $erreur_image = "Le fichier téléchargé n'est pas une image valide.";
                        }
                    } else {
                        $imagePath = "classe.jpeg";
                    }

                    // Ajouter le nouveau Réferentiel
                    $idpromo = (isset($_POST['addToPromo']) && $_POST['addToPromo'] == 'on') ? $currentPromo['idpromo'] : null;
                    $etatreferentiel = (isset($_POST['addToPromo']) && $_POST['addToPromo'] == 'on') ? 'Active' : 'Desactive';

                    // Vérification si le libellé existe déjà
                    $existingReferentiel = findReferentielByLibelle($libelle, filereferentiels);
                    if (!$existingReferentiel) {
                        // Ajouter le nouveau référentiel
                        $nouveaureferentiel = addNewReferentiel($libelle, $description, $imagePath, $idpromo, $etatreferentiel, filereferentiels);
                        $allReferentiels = findAllReferentiel();
                        // Filtrer les référentiels actifs pour la promotion en cours
                        $referentielsForCurrentPromo = array_filter($allReferentiels, function($referentiel) use ($currentPromo) {
                            return $referentiel['idpromo'] === $currentPromo['idpromo'] && $referentiel['etatreferentiel'] === 'Active';
                        });
                        
                    } else {
                        $erreur_libelle = "Ce libellé de référentiel existe déjà.";
                    }
                }

                
                

                if(isset($_POST['appreferentiel'])) {
                    $selectedReferentiels = $_POST['appreferentiel'];
                    $_SESSION['appreferentiel'] = $selectedReferentiels;
                    
                    // Vérifie si "referentiel" est sélectionné
                    if (in_array('referentiel', $selectedReferentiels)) {
                        return $apprenantsForCurrentPromo;
                    }
                
                    // Filtre les apprenants en fonction des référentiels sélectionnés
                    $filteredApprenants = [];
                    foreach ($selectedReferentiels as $selectedReferentiel) {
                        $apprenantsForSelectedReferentiel = array_filter($apprenantsForCurrentPromo, function($apprenant) use ($selectedReferentiel) {
                            return $apprenant['referentiel'] === $selectedReferentiel;
                        });
                        $filteredApprenants = array_merge($filteredApprenants, $apprenantsForSelectedReferentiel);
                    }
                
                    $apprenantsForCurrentPromo = $filteredApprenants;

                    
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
                    if ($user['role'] !== 'Apprenant'){
                        $referentiel = $_POST['referentiel'];
                    }
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