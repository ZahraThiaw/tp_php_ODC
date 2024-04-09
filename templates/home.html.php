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
            SESSION_start();
            require_once("../templates/partial/menu.html.php");
        ?>
        <div class="contenu">
            <?php
                require_once("../templates/partial/header.html.php");
            ?>
            <div class="bodycontenu">
                
                <?php
                require_once("../models/apprenants.model.php");
                $students = findAllStudents();

                require_once("../models/presences.model.php");
                require_once("../models/referentiels.model.php");
                $referentiels= findAllReferentiel();

                if(file_exists("../templates/" . $_POST['page'] . ".html.php")){
                    $studentpresents= generateStudentspresents();
                    include("../templates/" . $_POST['page'] . ".html.php");
                }else 
                  
                if($_POST['filtre'] == 'filtre'){
                    $status = $_POST['statuts'];
                    $referentiel = $_POST['referentiel'];
                    $studentpresents = filter_presence($status, $referentiel);
                    $_SESSION['statuts']= $status;
                    $_SESSION['referentiel']=$referentiel;
                    $totalItems = count($studentpresents);
                    $itemsPerPage= 5;
                    $currentPage = isset($_POST['pages']) ? intval($_POST['pages']) : 1;
                    $pagination = paginate($totalItems, $itemsPerPage, $currentPage);

                    $startIndex = ($currentPage - 1) * $itemsPerPage;
                    $presenceOnPage = array_slice($studentpresents, $startIndex, $itemsPerPage);
                    
                    include("../templates/presences.html.php");


                    if($_POST['search'] == 'search'){
                        $nom = $student['nom'];
                        $prenom = $student['prenom'];
                        $email = $student['email'];
                        $genre = $student['genre'];
                        $telephone = $student['telephone'];
                        $apprenantfiltre = filter_apprenant($nom, $prenom, $email, $genre, $telephone);

                        include("../templates/utilisateurs.html.php");
                    }

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