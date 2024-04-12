<?php  


// Fonction pour une redirection
function redirect($url)
{
    header('Location: '.$url);
    exit();
}

// fonction pour affivher tous les etudiants
function findAllStudents(){
    $student = [
       
        [
            "nom" => 'Mbow',
            "prenom" => 'Baye Saer',
            "email" => 'mbowbayesaer44@gmail.com',
            "genre" => 'M',
            "telephone" => '777220308',
        ],
        [ 
            "nom" => 'Tine',
            "prenom" => 'Fanta Ndao',
            "email" => 'fantatine18@gmail.com',
            "genre" => 'F',
            "telephone" => '785286330',
        ], 
        [ 
            "nom" => 'Wade',
            "prenom" => 'Aldemba',
            "email" => 'Ldmbwade@gmail.com',
            "genre" => 'M',
            "telephone" => '772716990',
        ],
        [ 
            "nom" => 'Diagne',
            "prenom" => 'Mouhamadou Moustapha',
            "email" => 'mousdef34@gmail.com',
            "genre" => 'M',
            "telephone" => '785953562',
        ],
        [ 
            "nom" => 'Sow',
            "prenom" => 'Mouhamadou Bobo',
            "email" => 'mbowbayesaer44@gmail.com',
            "genre" => 'M',
            "telephone" => '777930609',
        ]
        
    ];

    return $student;
}

function filter_apprenant($nom, $prenom, $email, $genre, $telephone) {
    $allapprenants = findAllStudents();
    $filteredapprenant = [];
     
    if($nom == 'nom'){
        foreach ($allapprenants as $apprenant) {
            if ($apprenant['nom'] == $nom) {
                $filteredapprenant[] = $apprenant;
            }
        }
        return $filteredapprenant;
    }
    if($prenom == 'prenom'){
        foreach ($allapprenants as $apprenant) {
            if ($apprenant['prenom'] == $prenom) {
                $filteredapprenant[] = $apprenant;
            }
        }
        return $filteredapprenant;
    }
    if($email == 'email'){
        foreach ($allapprenants as $apprenant) {
            if ($apprenant['email'] == $email) {
                $filteredapprenant[] = $apprenant;
            }
        }
        return $filteredapprenant;
    }
    if($genre == 'genre'){
        foreach ($allapprenants as $apprenant) {
            if ($apprenant['genre'] == $genre) {
                $filteredapprenant[] = $apprenant;
            }
        }
        return $filteredapprenant;
    }
    if($telephone == 'telephone'){
        foreach ($allapprenants as $apprenant) {
            if ($apprenant['telephone'] == $telephone) {
                $filteredapprenant[] = $apprenant;
            }
        }
        return $filteredapprenant;
    }
    
}

?>
