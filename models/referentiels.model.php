<?php

function findAllReferentiel(){
//     $referentiel = [
//         [   
//             'idreferentiel' => "Dev_Web",
//             'referentiel' => "Dev Web/Mobile",
//             'etatreferentiel' => "Active",
//             'idpromo' => "6"
//         ],
//         [   
//             'idreferentiel' => "Ref_Dig",
//             'referentiel' => "Référent Digital",
//             'etatreferentiel' => "Active",
//             'idpromo' => "6"
//         ],
//         [   
//             'idreferentiel' => "Aws",
//             'referentiel' => "Aws",
//             'etatreferentiel' => "Active",
//             'idpromo' => "6"
//         ],
//         [   
//             'idreferentiel' => "Hackeuse",
//             'referentiel' => "Hackeuse",
//             'etatreferentiel' => "Active",
//             'idpromo' => "6"
//         ],
//         [   
//             'idreferentiel' => "Dev_Data",
//             'referentiel' => "Développement Data",
//             'etatreferentiel' => "Active",
//             'idpromo' => "6"
//         ],
//         [   
//             'idreferentiel' => "Dev_Web",
//             'referentiel' => "Dev Web/Mobile",
//             'etatreferentiel' => "Active",
//             'idpromo' => "5"
//         ],
//         [   
//             'idreferentiel' => "Ref_Dig",
//             'referentiel' => "Référent Digital",
//             'etatreferentiel' => "Active",
//             'idpromo' => "5"
//         ],
//         [   
//             'idreferentiel' => "Aws",
//             'referentiel' => "Aws",
//             'etatreferentiel' => "Désactive",
//             'idpromo' => "5"
//         ],
//         [   
//             'idreferentiel' => "Hackeuse",
//             'referentiel' => "Hackeuse",
//             'etatreferentiel' => "Active",
//             'idpromo' => "5"
//         ],
//         [   
//             'idreferentiel' => "Dev_Data",
//             'referentiel' => "Développement Data",
//             'etatreferentiel' => "Active",
//             'idpromo' => "5"
//         ]
//     ];

   // ecrirefile(filereferentiels, $referentiel);

   $referentiel = lireFile(filereferentiels);

    return $referentiel;
}


function isImage($file) {
    $imageInfo = getimagesize($file);
    return $imageInfo !== false;
}


// Fonction pour trouver un référentiel par libellé (ignorant la casse et les espaces)
function findReferentielByLibelle($libelle, $csvFilePath) {
    $file = fopen($csvFilePath, 'r');
    while (($row = fgetcsv($file)) !== false) {
        // Comparer en ignorant la casse et les espaces autour du libellé
        if (strcasecmp(trim($row[1]), trim($libelle)) === 0) {
            fclose($file);
            return $row;
        }
    }
    fclose($file);
    return false; // Retourner false si le référentiel n'est pas trouvé
}


// Fonction pour ajouter un nouveau référentiel
function addNewReferentiel($libelle, $description, $imagePath, $idpromo, $etatreferentiel, $csvFilePath) {
    $file = fopen($csvFilePath, 'a'); // Ouvrir le fichier en mode ajout
    $idreferentiel = generateUniqueID($csvFilePath); // Générer un identifiant unique (vous devez implémenter cette fonction)
    $newReferentiel = array($idreferentiel, $libelle, $etatreferentiel, $imagePath, $description, $idpromo);
    fputcsv($file, $newReferentiel); // Ajouter le nouveau référentiel au fichier CSV
    fclose($file);
}

// Fonction pour générer un identifiant unique (simple exemple)
function generateUniqueID($csvFilePath) {
    $data = file($csvFilePath);
    $lastRow = array_pop($data); // Obtenir la dernière ligne
    $lastRowArray = str_getcsv($lastRow); // Convertir la dernière ligne en tableau
    $lastID = $lastRowArray[0]; // Récupérer l'ID
    $newID = $lastID + 1; // Générer un nouvel ID en l'incrémentant
    return $newID;
}


function referentiels_Exist($libelle,$refs){
    
    foreach($refs as $referentiel){
        if($referentiel['libelle'] == $libelle){
            return true;
        }
    }
    return false;
}




function ajouterReferentiel($newref, $file) {
    $referentiels = array_map('str_getcsv', file($file));
    $referentiels[] = $newref;
    // Enregistrer les modifications dans le fichier CSV
    $fp = fopen($file, 'w');
    foreach ($referentiels as $ref) {
        fputcsv($fp, $ref);
    }
    fclose($fp);
}

function ReferentielsbyIdpromo($id_promotion){
    $referentiels = lireFile(filereferentiels);
    $referentielsbyIdpromo = [];
    foreach ($referentiels as $referentiel) {
        if($referentiel['idpromo'] == $id_promotion){
            $referentielsbyIdpromo[] = $referentiel;
        }
        
    }
    return $referentielsbyIdpromo;
}

function referentielHasStudents($libelle,$refs){
    $data = lireFile(fileapprenants);
   foreach($refs as $referentiel){
       if(trim($referentiel['libelle']) == $libelle){
           foreach($data as $utilisateur){
               if($utilisateur['referentiel'] == $referentiel['referentiel']){
                   return true;
               }
           }
       }
   }
   return false;    
}

// Définition de la fonction pour récupérer l'identifiant de la promotion en fonction du libellé de promotion à partir d'un fichier CSV
function get_promotion_id_from_csv($libelle_promo, $file_path) {
    // Ouvrir le fichier CSV en mode lecture
    $file = fopen($file_path, 'r');

    if ($file) {
        // Parcourir chaque ligne du fichier CSV
        while (($row = fgetcsv($file)) !== false) {
            // Vérifier si le libellé de la promotion correspond
            if ($row[1] == $libelle_promo) { // Assurez-vous d'ajuster l'indice selon la position de la colonne du libellé dans votre fichier CSV
                // Fermer le fichier CSV
                fclose($file);
                // Retourner l'identifiant de la promotion
                return $row[0]; // Assurez-vous d'ajuster l'indice selon la position de la colonne de l'identifiant de la promotion dans votre fichier CSV
            }
        }
        
        // Fermer le fichier CSV
        fclose($file);
    }
    
    // Si la promotion n'est pas trouvée, retourner null
    return null;
}


// Fonction pour vérifier si un référentiel est associé à une promotion existante
function promotion_has_referentiel($promotion_id, $referentiel_nom) {
    $file_path = filereferentiels;
    if (($handle = fopen($file_path, 'r')) !== false) {
        while (($data = fgetcsv($handle)) !== false) {
            if ($data[5] == $promotion_id && $data[1] == $referentiel_nom) {
                fclose($handle);
                return true;
            }
        }
        fclose($handle);
    }
    return false;
}

// Fonction pour vérifier si un référentiel a au moins un apprenant associé
function referentiel_has_students($referentiel_nom, $promotion_id) {
    $file_path = fileapprenants;
    if (($handle = fopen($file_path, 'r')) !== false) {
        while (($data = fgetcsv($handle)) !== false) {
            // Vérifie si le référentiel appartient à la promotion
            if ($data[6] == $referentiel_nom && $data[5] == $promotion_id) {
                fclose($handle);
                return true;
            }
        }
        fclose($handle);
    }
    return false;
}


function referentiel_exists_in_promotion($referentiel, $promotion_id, $file_path) {
    $file = fopen($file_path, 'r');
    if ($file) {
        // Parcourir le fichier CSV pour vérifier si le référentiel est déjà associé à la promotion
        while (($row = fgetcsv($file)) !== false) {
            // Vérifier si le référentiel et l'ID de promotion correspondent
            if ($row[5] == $promotion_id && $row[1] == $referentiel) {
                fclose($file);
                return true; // Le référentiel existe déjà dans la promotion
            }
        }
        fclose($file);
    }
    return false; // Le référentiel n'existe pas dans la promotion
}

?>