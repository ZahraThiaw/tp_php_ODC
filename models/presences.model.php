<?php

$elementsParPage = 5;
function generateStudentspresents() {
        // $studentspresent = [
        //    [
        //     'Matricule' => "P6_DEVDAT_2024_129",
        //     'Nom' => "FAYE",
        //     'Prenom' => "Ibrahima",
        //     'Telephone' => "771909638",
        //     'referentiel' => "Développement Data",
        //     "date" => "2024-04-10",
        //     "Heure d'arrivee" => "06:49",
        //     'statuts' => "PRESENT",
        //     'idpromo' => "6"
        //    ],
        //    [
        //     'Matricule' => "P6_REFDIG_2024_130",
        //     'Nom' => "Khadim",
        //     'Prenom' => "Deme",
        //     'Telephone' => "778783197",
        //     'referentiel' => "Référent Digital",
        //     "date" => "2024-04-11",
        //     "Heure d'arrivee" => "09:34",
        //     'statuts' => "PRESENT",
        //     'idpromo' => "6"
        //    ],
        //    ['Matricule' => "P6_REFDIG_2024_135",
        //    'Nom' => "DIAGNE",
        //    'Prenom' => "ASSANE",
        //    'Telephone' => "770968798",
        //    'referentiel' => "Référent Digital",
        //    "date" => "2024-04-10",
        //    "Heure d'arrivee" => "07:48",
        //    'statuts' => "PRESENT",
        //    'idpromo' => "6"
        //    ],
        //    [
        //     'Matricule' => "6_DEVDAT_2024_13",
        //     'Nom' => "FALL",
        //     'Prenom' => "mohamed abdoullah",
        //     'Telephone' => "785844966",
        //     'referentiel' => "Développement Data",
        //     "date" => "2024-04-09",
        //     "Heure d'arrivee" => "07:47",
        //     'statuts' => "PRESENT",
        //     'idpromo' => "6"
        //    ],
        //    [
        //     'Matricule' => "P6_DEVDAT_2024_137",
        //     'Nom' => "Kanteye",
        //     'Prenom' => "thiara",
        //     'Telephone' => "772509700",
        //     'referentiel' => "Développement Data",
        //     "date" => "2024-04-09",
        //     "Heure d'arrivee" => "08:00",
        //     'statuts' => "PRESENT",
        //     'idpromo' => "6"
        //    ],
        //    [
        //     'Matricule' => "P6_DEVDAT_2024_138",
        //     'Nom' => "FALL",
        //     'Prenom' => "sokhna mame diarra",
        //     'Telephone' => "776480120",
        //     'referentiel' => "Développement Data",
        //     "date" => "2024-04-11",
        //     "Heure d'arrivee" => "06:57",
        //     'statuts' => "PRESENT",
        //     'idpromo' => "6"
        //    ],
        //    ['Matricule' => "P6_DEVWEB_2024_20",
        //    'Nom' => "THIAM",
        //    'Prenom' => "El Hadji Fallou Mbacké",
        //    'Telephone' => "777941128",
        //    'referentiel' => "Dev Web/Mobile",
        //    "date" => "2024-04-09",
        //    "Heure d'arrivee" => " ",
        //    'statuts' => "ABSENT",
        //    'idpromo' => "6"
        //    ],
        //    [
        //     'Matricule' => "P6_DEVWEB_2024_41",
        //     'Nom' => "FALL",
        //     'Prenom' => "Makhtar",
        //     'Telephone' => "770643381",
        //     'referentiel' => "Dev Web/Mobile",
        //     "date" => "2024-04-11",
        //     "Heure d'arrivee" => " ",
        //     'statuts' => "ABSENT",
        //     'idpromo' => "6"
        //    ],
        //    [
        //     'Matricule' => "P6_REFDIG_2024_6145",
        //     'Nom' => "COLY",
        //     'Prenom' => "Ndeye mareme badiane",
        //     'Telephone' => "771249834",
        //     'referentiel' => "Référent Digital",
        //     "date" => "2024-04-11",
        //     "Heure d'arrivee" => " ",
        //     'statuts' => "ABSENT",
        //     'idpromo' => "6"
        //    ],
        //    [
        //     'Matricule' => "P6_REFDIG_2024_67",
        //     'Nom' => "SAGNA",
        //     'Prenom' => "DJIBY",
        //     'Telephone' => "776564942",
        //     'referentiel' => "Référent Digital",
        //     "date" => "2024-04-09",
        //     "Heure d'arrivee" => " ",
        //     'statuts' => "ABSENT",
        //     'idpromo' => "6"
        //    ],
        //    [
        //     'Matricule' => "P6_DEVDAT_2024_129",
        //     'Nom' => "FAYE",
        //     'Prenom' => "Ibrahima",
        //     'Telephone' => "771909638",
        //     'referentiel' => "Développement Data",
        //     "date" => "2024-04-12",
        //     "Heure d'arrivee" => "06:49",
        //     'statuts' => "PRESENT",
        //     'idpromo' => "6"
        //    ],
        //    [
        //     'Matricule' => "P6_REFDIG_2024_130",
        //     'Nom' => "Khadim",
        //     'Prenom' => "Deme",
        //     'Telephone' => "778783197",
        //     'referentiel' => "Référent Digital",
        //     "date" => "2024-04-12",
        //     "Heure d'arrivee" => "",
        //     'statuts' => "ABSENT",
        //     'idpromo' => "6"
        //    ],
        //    ['Matricule' => "P6_REFDIG_2024_135",
        //    'Nom' => "DIAGNE",
        //    'Prenom' => "ASSANE",
        //    'Telephone' => "770968798",
        //    'referentiel' => "Référent Digital",
        //    "date" => "2024-04-12",
        //    "Heure d'arrivee" => "07:48",
        //    'statuts' => "PRESENT",
        //    'idpromo' => "6"
        //    ],
        //    [
        //     'Matricule' => "P6_DEVDAT_2024_13",
        //     'Nom' => "FALL",
        //     'Prenom' => "mohamed abdoullah",
        //     'Telephone' => "785844966",
        //     'referentiel' => "Développement Data",
        //     "date" => "2024-04-12",
        //     "Heure d'arrivee" => "07:47",
        //     'statuts' => "PRESENT",
        //     'idpromo' => "6"
        //    ],
        //    [
        //     'Matricule' => "P6_DEVDAT_2024_137",
        //     'Nom' => "Kanteye",
        //     'Prenom' => "thiara",
        //     'Telephone' => "772509700",
        //     'referentiel' => "Développement Data",
        //     "date" => "2024-04-12",
        //     "Heure d'arrivee" => "",
        //     'statuts' => "ABSENT",
        //     'idpromo' => "6"
        //    ],
        //    [
        //     'Matricule' => "P6_REFDIG_2024_130",
        //     'Nom' => "Khadim",
        //     'Prenom' => "Deme",
        //     'Telephone' => "778783197",
        //     'referentiel' => "Référent Digital",
        //     "date" => "2024-04-13",
        //     "Heure d'arrivee" => "09:34",
        //     'statuts' => "PRESENT",
        //     'idpromo' => "6"
        //    ],
        //    ['Matricule' => "P6_REFDIG_2024_135",
        //    'Nom' => "DIAGNE",
        //    'Prenom' => "ASSANE",
        //    'Telephone' => "770968798",
        //    'referentiel' => "Référent Digital",
        //    "date" => "2024-04-13",
        //    "Heure d'arrivee" => "07:48",
        //    'statuts' => "PRESENT",
        //    'idpromo' => "6"
        //    ]
        // ];

        //ecrirefile($studentspresent, filepresences);
        $studentspresent= lireFile(filepresences);
        
    return $studentspresent;
}

function presenceAuneDate($date){
    $allpresence = generateStudentspresents();
    $filtered = [];
    foreach($allpresence as $presence){
        if($presence['date'] == $date){
            $filtered[] = $presence;
        }
    }
    return $filtered;
}
function filter_presence($status, $referentiel, $date) {
    $allpresence = presenceAuneDate($date);
    $filtered = [];
     
    if($status == 'statuts' && $referentiel == 'referentiel'){
        return $allpresence;
    }
    if($status == 'statuts' && $referentiel != 'referentiel'){
        foreach ($allpresence as $presence) {
            if ($presence['referentiel'] == $referentiel) {
                $filtered[] = $presence;
            }
        }
        return $filtered;
    }
    if($status != 'statuts' && $referentiel == 'referentiel'){
        foreach ($allpresence as $presence) {
            if ($presence['statuts'] == $status) {
                $filtered[] = $presence;
            }
        }
        return $filtered;
    }
    if($status != 'statuts' && $referentiel != 'referentiel'){
        foreach ($allpresence as $presence) {
            if ($presence['statuts'] == $status && $presence['referentiel'] == $referentiel) {
                $filtered[] = $presence;
            }
        }
        return $filtered;
    }
    
}

function generateStudentspresentspagines($page, $elementsPerPage) {
    $allStudents = generateStudentspresents();
    $totalItems = count($allStudents);
    
    $startIndex = ($page - 1) * $elementsPerPage;
    $paginatedStudents = array_slice($allStudents, $startIndex, $elementsPerPage);
    
    return $paginatedStudents;
}

function paginate($totalItems, $itemsPerPage, $currentPage)
{
    // Calcul du nombre total de pages en fonction du nombre total d'éléments et du nombre d'éléments par page
    $totalPages = ceil($totalItems / $itemsPerPage);

    // Calcul de la page précédente et de la page suivante
    $prevPage = max($currentPage - 1, 1);
    $nextPage = min($currentPage + 1, $totalPages);

    // Retourner les paramètres de pagination
    return array(
        'totalPages' => $totalPages,
        'currentPage' => $currentPage,
        'prevPage' => $prevPage,
        'nextPage' => $nextPage
    );
}

function paginateTable($array, $pageSize, $currentPage) {
    $totalItems = count($array);
    $totalPages = ceil($totalItems / $pageSize);
    $startIndex = ($currentPage - 1) * $pageSize;
    $pagedArray = array_slice($array, $startIndex, $pageSize);
    return  !empty($pagedArray) ?$pagedArray: $array;
}
