<?php

function findAllPromos(){
//     $promo = [
//         [
//             'idpromo' => "1",
//             'libelle' => "Promotion 1",
//             'datedebut' => "2019-02-01",
//             'datefin' => "2019-11-30",
//             'etat' => "Terminée"
//         ],
//         [
//             'idpromo' => "2",
//             'libelle' => "Promotion 2",
//             'datedebut' => "2020-02-01",
//             'datefin' => "2020-11-30",
//             'etat' => "Terminée"
//         ],
//         [
//             'idpromo' => "3",
//             'libelle' => "Promotion 3",
//             'datedebut' => "2021-02-01",
//             'datefin' => "2021-11-30",
//             'etat' => "Terminée"
//         ],
//         [
//             'idpromo' => "4",
//             'libelle' => "Promotion 4",
//             'datedebut' => "2022-02-01",
//             'datefin' => "2022-11-30",
//             'etat' => "Terminée"
//         ],
//         [
//             'idpromo' => "5",
//             'libelle' => "Promotion 5",
//             'datedebut' => "2023-02-01",
//             'datefin' => "2023-11-30",
//             'etat' => "Terminée"
//         ],
//         [
//             'idpromo' => "6",
//             'libelle' => "Promotion 6",
//             'datedebut' => "2024-02-01",
//             'datefin' => "2024-11-30",
//             'etat' => "En cours"
//         ]
 //   ];

    //ecrirefile( filepromos, $promo);
    $promo = lireFile( filepromos );

    return $promo;
}


function promotionCheck($idPromoActive, $idPromoInactive){
    $promos = array_map('str_getcsv', file(filepromos));

    // Désactiver la promotion active
    foreach($promos as $key => $promo){
        if($promo[0] == $idPromoActive){
            $promos[$key][4] = 'Terminée';
        }
        if($promo[0] == $idPromoInactive){
            $promos[$key][4] = 'En cours';
        }
    }

// Enregistrer les modifications dans le fichier CSV
        $fp = fopen(filepromos, 'w');
        foreach ($promos as $promo) {
            fputcsv($fp, $promo);
        }
        fclose($fp);
        //return $promos;
}




// Fonction pour vérifier si le libellé existe déjà dans le fichier CSV
function check_promotion_existence($libelle) {
    $file = fopen(filepromos, 'r');
    while (($row = fgetcsv($file)) !== false) {
        if ($row[1] == $libelle) {
            fclose($file);
            return true;
        }
    }
    fclose($file);
    return false;
}

// Fonction pour calculer la durée de la promotion en jours
function calculate_promotion_duration($start_date, $end_date) {
    $start = strtotime($start_date);
    $end = strtotime($end_date);
    $duration = ($end - $start) / (60 * 60 * 24); // Convertir en jours
    return $duration;
}

// Fonction pour générer un nouvel ID promotion en incrémentant le dernier ID trouvé dans le fichier CSV
function generate_promotion_id() {
    $file = fopen(filepromos, 'r');
    $last_id = 0;
    while (($row = fgetcsv($file)) !== false) {
        $last_id = intval($row[0]);
    }
    fclose($file);
    return $last_id + 1;
}

// Fonction pour ajouter une nouvelle promotion au fichier CSV
function add_promotion($libelle, $start_date, $end_date) {
    $id = generate_promotion_id();
    $etat = "Terminée";
    $file = fopen(filepromos, 'a');
    fputcsv($file, array($id, $libelle, $start_date, $end_date, $etat));
    fclose($file);
}


// Fonction pour ajouter une nouvelle promotion ou des référentiels à une promotion existante
function add_new_promotion($libelle, $start_date, $end_date, $referentiels=null) {
    // Vérifier si le libellé est vide
    if (empty($libelle)) {
        $_POST['page'] = 'nouveaupromotion';
        $erreur_libelle = "Le libellé de la promotion est obligatoire.";
    }

    // Vérifier si la date de début est vide
    if (empty($start_date)) {
        $_POST['page'] = 'nouveaupromotion';
        $erreur_date_debut = "La date de début de la promotion est obligatoire.";
    }

    // Vérifier si la date de fin est vide
    if (empty($end_date)) {
        $_POST['page'] = 'nouveaupromotion';
        $erreur_date_fin = "La date de fin de la promotion est obligatoire.";
    }

    // Vérifier l'existence du libellé et la durée de la promotion
    if (!check_promotion_existence($libelle)) {
        $duration = calculate_promotion_duration($start_date, $end_date);
        if ($duration >= 120) { // 4 mois = 120 jours
            add_promotion($libelle, $start_date, $end_date);
            if ($referentiels) {
                add_referentiels_to_promotion($libelle, $referentiels);
            }
            $_POST['page'] = 'nouveaureferentiel';
            $success_message = "Nouvelle promotion ajoutée avec succès!";
        } else {
            $_POST['page'] = 'nouveaupromotion';
            $erreur_duree = "La durée de la promotion est inférieure à 4 mois.";
        }
    } else {
        $_POST['page'] = 'nouveaupromotion';
        $erreur_libelle = "Le libellé de la promotion existe déjà. Vous pouvez ajouter des référentiels.";
    }
}


// Fonction pour ajouter des référentiels à une promotion existante
function add_referentiels_to_promotion($libelle, $referentiels) {
    // Vérifier si le libellé de la promotion existe
    if (check_promotion_existence($libelle)) {
        // Récupérer les référentiels actuels de la promotion
        $file = fopen(filepromos, 'r+');
        $promotions = [];
        while (($row = fgetcsv($file)) !== false) {
            if ($row[1] == $libelle) {
                $promotions[] = $row;
            }
        }
        fclose($file);
        
        // Mettre à jour les référentiels de la promotion
        $updated_promotions = [];
        foreach ($promotions as $promotion) {
            $existing_referentiels = explode(",", $promotion[4]);
            $updated_referentiels = array_unique(array_merge($existing_referentiels, $referentiels));
            $promotion[4] = implode(",", $updated_referentiels);
            $updated_promotions[] = $promotion;
        }
        
        // Réécrire les promotions dans le fichier CSV
        $file = fopen(filepromos, 'w');
        foreach ($updated_promotions as $promotion) {
            fputcsv($file, $promotion);
        }
        fclose($file);
        
        // Rediriger vers la page nouveaureferentiel
        $_POST['page'] = 'nouveaureferentiel';
    }
}




?>