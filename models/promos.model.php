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


?>