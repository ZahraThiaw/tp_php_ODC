<?php

// nombre d'element a afficher par page
#define 
$elementsParPage = 5;
function generateStudentspresents() {
        $studentspresent = [
           [
            'Matricule' => "P6_DEVDAT_2024_129",
            'Nom' => "FAYE",
            'Prenom' => "Ibrahima",
            'Telephone' => "771909638",
            'referentiel' => "Développement Data",
            "Heure d'arrivee" => "06:49",
            'statuts' => "PRESENT"
           ],
           [
            'Matricule' => "P6_REFDIG_2024_130",
            'Nom' => "Khadim",
            'Prenom' => "Deme",
            'Telephone' => "778783197",
            'referentiel' => "Référent Digital",
            "Heure d'arrivee" => "09:34",
            'statuts' => "PRESENT"
           ],
           ['Matricule' => "P6_REFDIG_2024_135",
           'Nom' => "DIAGNE",
           'Prenom' => "ASSANE",
           'Telephone' => "770968798",
           'referentiel' => "Référent Digital",
           "Heure d'arrivee" => "07:48",
           'statuts' => "PRESENT"
           ],
           [
            'Matricule' => "6_DEVDAT_2024_13",
            'Nom' => "FALL",
            'Prenom' => "mohamed abdoullah",
            'Telephone' => "785844966",
            'referentiel' => "Développement Data",
            "Heure d'arrivee" => "07:47",
            'statuts' => "PRESENT"
           ],
           [
            'Matricule' => "P6_DEVDAT_2024_137",
            'Nom' => "Kanteye",
            'Prenom' => "thiara",
            'Telephone' => "772509700",
            'referentiel' => "Développement Data",
            "Heure d'arrivee" => "08:00",
            'statuts' => "PRESENT"
           ],
           [
            'Matricule' => "P6_DEVDAT_2024_138",
            'Nom' => "FALL",
            'Prenom' => "sokhna mame diarra",
            'Telephone' => "776480120",
            'referentiel' => "Développement Data",
            "Heure d'arrivee" => "06:57",
            'statuts' => "PRESENT"
           ],
           ['Matricule' => "P6_DEVWEB_2024_20",
           'Nom' => "THIAM",
           'Prenom' => "El Hadji Fallou Mbacké",
           'Telephone' => "777941128",
           'referentiel' => "Dev Web/Mobile",
           "Heure d'arrivee" => " ",
           'statuts' => "ABSENT"
           ],
           [
            'Matricule' => "P6_DEVWEB_2024_41",
            'Nom' => "FALL",
            'Prenom' => "Makhtar",
            'Telephone' => "770643381",
            'referentiel' => "Dev Web/Mobile",
            "Heure d'arrivee" => " ",
            'statuts' => "ABSENT"
           ],
           [
            'Matricule' => "123P6_REFDIG_2024_6145",
            'Nom' => "COLY",
            'Prenom' => "Ndeye mareme badiane",
            'Telephone' => "771249834",
            'referentiel' => "Référent Digital",
            "Heure d'arrivee" => " ",
            'statuts' => "ABSENT"
           ],
           [
            'Matricule' => "P6_REFDIG_2024_67",
            'Nom' => "SAGNA",
            'Prenom' => "DJIBY",
            'Telephone' => "776564942",
            'referentiel' => "Référent Digital",
            "Heure d'arrivee" => " ",
            'statuts' => "ABSENT"
           ]
        ];
    return $studentspresent;
}

function filter_presence($status, $referentiel) {
    $allpresence = generateStudentspresents();
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
