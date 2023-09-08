<?php session_start();
// this file is team file. User can display team informations

// import function file
require('method.php');
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Equipes | SPORTSCORES</title>
    <link rel="stylesheet" href="style/bootstrap.css">
    <link rel="stylesheet" href="style/monstyle.css">
</head>

<body>
    <!-- import header file -->
    <?php include('header.php');
    if (isset($_SESSION['user'])) {
    ?>
        <!-- Bannere  -->
        <div class="px-4 py-3 my-2 text-center container bg-secondary" sstyle="background-color: #8a05f0;">
            <h3 class="display-6 fw-bold" style="color: white;">Les equipes</h3>
            <div class="col-lg-6 mx-auto">
                <p class="lead mb-4" style="color:#dbb2fa;">Un aperçu sur chaque equipe du "tournoir des quatres equipes" </p>
                <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                    <!-- leaderboard button -->
                    <a href="leaderboard.php" class="btn  btn-lg px-4 gap-3" style="background-color: white; color:#8a05f0;">Voir le classement</a>
                </div>
            </div>
        </div>
        <!-- bannere -->

        <?php
        //display teams

        $teams = getTeams();
        foreach ($teams as $team) {

        ?> <div class="container py-2 px-3">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card  py-3 shadow-lg">
                            <div class="d-flex justify-content-center align-items-center">
                                <img src=" images/<?= $team['teamLogo'] ?>" class="card-img-top rounded-circle border-gray " style="width:200px; height:200px; border:5px solid;" alt="Logo">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card shadow-lg " sstyle="border-radius:1%;">
                            <div class="card-body">
                                <ul class="list-group">
                                    <li class="list-group-item" style=""> <span style="color:blue;"> Equipe :</span> <?= $team['teamName'] ?></li>
                                    <li class="list-group-item" style=""> <span style="color:blue;"> Histoire :</span> <?= $team['teamStory'] ?></li>
                                    <li class="list-group-item" style=""> <span style="color:blue;"> Point (Tournoir des quatres equipes) : </span> <?= $team['teamPoints'] ?> pts</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        }
    } else {
        ?>
        <!-- Message when user is not connect  -->
        <div class="px-4 py-3 my-2 text-center container" style="background-color: #8a05f0;">
            <h1 class="display-5 fw-bold" style="color: white;"> Connectez-vous pour acceder à cette page ! </h1>
            <div class="col-lg-6 mx-auto">
                <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                    <a href="login.php" class="btn  btn-lg px-4 gap-3" style="background-color: white; color:#8a05f0;">Se connecter</a>
                </div>
            </div>
        </div>
        <!-- end -->
    <?php
    }
    // import footer file
    include('footer.php'); ?>
    <script src="style/bootstrap.js"></script>

</html>