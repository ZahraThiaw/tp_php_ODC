<?php

function recherche($tableau, $key, $value){
    $resultat = [];
    foreach($tableau as $item){
        if($item[$key] == $value){
            $resultat[] = $item;
        }
    }
    return $resultat;
}


function seachUser($users,$name){
    $apprenants = [];
    foreach ($users as $user) {
        if ($user['nom'] == $name) {
            $apprenants[] = $user;
        }
    }
    return $apprenants;
}


?>
