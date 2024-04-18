<?php
    function ecrirefile($fichier, $data){
        $fp = fopen($fichier, 'w');
        // Écrire l'en-tête du fichier CSV
        fputcsv($fp, array_keys(current($data)));

        // Écrire les données dans le fichier CSV
        foreach ($data as $fields) {
            fputcsv($fp, $fields);
        }
        fclose($fp);
    }
    
    
    
    function lireFile($fichier) {
        $rows = array_map('str_getcsv', file($fichier));
        $header = array_shift($rows);
        $data = array();
        foreach ($rows as $row) {
            $data[] = array_combine($header, $row);
        }
        return $data;
    }
    
?>