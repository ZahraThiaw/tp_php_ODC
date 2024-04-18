<?php
function findAllUsers() {
    // $user=[
    //     [
    //         'iduser'=>1,
    //         'email' => 'zahra2024@gmail.com',
    //         'password' => 'admin',
    //         'role' => 'Admin',
    //         'prenom' => 'ZAHRA',
    //         'nom' => 'THIAW',
    //         'image' => 'admin.png'
    //     ],
    //     [
    //         'iduser'=>'P6_DEVWEB_2024_23',
    //         'email' => 'thiaw2024@gmail.com',
    //         'password' => 'apprenant',
    //         'role' => 'Apprenant',
    //         'prenom' => 'FATIMATA',
    //         'nom' => 'THIAW',
    //         'image' => 'apprenant.png'
    //     ]
    // ];
    //ecrirefile(fileusers, $user);
    $user = lireFile(fileusers);
    return $user;
}

function verifierUtilisateur($email, $password){
    $file = fileusers;
    if(file_exists($file)){
        $lines = file($file);
        foreach($lines as $line){
            $data = str_getcsv($line);
            if($data[1] == $email && $data[2] == $password){
                $role = $data[3];
                if($role == 'Admin' || $role == 'Apprenant'){
                    return array('role' => $role);
                } else {
                    // Gérez le rôle d'utilisateur invalide
                    return false;
                }
            }
        }
    }
    return false;
}

function hashPassword($password) {
    return password_hash($password, PASSWORD_DEFAULT);
}

function verifyPassword($password1, $password2) {
    return password_verify($password1, $password2);
}
?>