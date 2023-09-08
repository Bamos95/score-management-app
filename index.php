<?php session_start();
// import function file
require('method.php');
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <!-- <meta http-equiv="refresh" content="5"> -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/bootstrap.css">
    <link rel="stylesheet" href="style/monstyle.css">
    <title>Acceuil | SPORTSCORES </title>
</head>

<body>
    <?php include('header.php') ?>

    <!-- Bannere  -->
    <div class="container  px-4 py-1 my-3 bg-secondary" sstyle="background-color: #8a05f0;">
        <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
            <div class="col-10 col-sm-8 col-lg-6">
                <img src="images/image3.jpg" class="d-block mx-lg-auto img-fluid rounded-3" alt="SPORTSCORES" width="700" height="500" loading="lazy">
            </div>
            <div class="col-lg-6">
                <h1 class="display-5 fw-bold text-body-emphasis lh-1 mb-3 text-center text-white">SPORTSCORES</h1>
                <p class="lead text-center text-light">Suivez les matches du tournoirs des quatres equipes.</p>
                <div class="d-grid gap-5 d-md-flex justify-content-md-center">
                    <!-- leaderboard button -->
                    <a type="button" class="btn btn-primary btn-lg px-4" href="leaderboard.php">Voir les statistiques</a>
                </div>
            </div>
        </div>
    </div>
    <!-- end Bannere -->

    <?php if (isset($_SESSION['user'])) {
    ?>
        <!-- matches in progress-->
        <div class="container bg-light">
            <div class="pricing-header p-3 pb-md-4 mx-auto text-center">
                <h1 class="display-5 fw-bold text-body-emphasis lh-1 mb-3 text-center text" style="color: red;">Matches en direct :</h1>
                <p class="fs-5 text-body-secondary">Recevez les statistiques en temps réel !</p>
            </div>
        </div>
        <?php

        // call method to get all matches in progress
        $matches = getMatchesInprogress();

        if (!$matches) {
        ?>
            <div class="container bg-danger">
                <div class="pricing-header p-3 pb-md-4 mx-auto text-center">
                    <h1 class="display-7  text-body-emphasis lh-1 mb-3 text-center text" style="color: black;">Aucun match en cours actuellement. Les matchs en direct s'afficherons automatiquement ici.</h1>

                </div>
            </div>
        <?php
        }
        foreach ($matches as $matches) {
            // get teams data
            $team1Id = $matches['team1Id'];
            $team1 = getTeam($team1Id);
            $team2Id = $matches['team2Id'];
            $team2 = getTeam($team2Id);

            // get teams goal
            $team1Goal = countGoal($matches['matchesId'], $team1Id);
            $team2Goal = countGoal($matches['matchesId'], $team2Id);
        ?>
            <!-- displaying matches in real-time -->
            <div class="container py-2 px-3">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card  py-3 shadow-lg">
                            <div class="d-flex justify-content-center align-items-center">
                                <img src=" images/<?= $team1['teamLogo'] ?>" class="card-img-top rounded-circle border-gray " style="width:200px; height:200px; border:5px solid;" alt="Logo">
                            </div>                       
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card shadow-lg ">
                            <div class="card-body bg-secondary">
                                <ul class="list-group justify-content-center text-center">

                                    <li class="list-group-item fw-bold">Tournoir de Football</li>
                                    <li class="list-group-item">
                                        <h3 class="display-7 fw-bold text-body-emphasis lh-1 mb-3 text-center text" style="color: blue;"><?= htmlspecialchars($team1['teamName']) ?> VS <?= htmlspecialchars($team2['teamName']) ?></h3>
                                    </li>
                                    <li class="list-group-item">
                                        <h3 class="display-9 fw-bold text-body-emphasis lh-1 mb-3 text-center text" style="color: black;"> <?php if ($team1Goal) {
                                                                                                                                                echo $team1Goal;
                                                                                                                                            } else {
                                                                                                                                                echo "0";
                                                                                                                                            } ?> : <?php if ($team2Goal) {
                                                                                                                                                        echo $team2Goal;
                                                                                                                                                    } else {
                                                                                                                                                        echo "0";
                                                                                                                                                    } ?></h3>
                                    </li>
                                    <li class="list-group-item fw-bold"><?= htmlspecialchars($matches['matchesStadium']) ?></li>
                                </ul>                               
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card  py-3 shadow-lg">
                            <div class="d-flex justify-content-center align-items-center">
                                <img src=" images/<?= $team2['teamLogo'] ?>" class="card-img-top rounded-circle border-gray " style="width:200px; height:200px; border:5px solid;" alt="Logo">
                            </div>                         
                        </div>
                    </div>
                </div>
            </div>       
    <?php
        }
    }
    ?>
    <!-- footer -->
    <?php include('footer.php'); ?>
    <script src="style/bootstrap.js"></script>
    <!-- reload display -->
     <script>
        setTimeout(function() {
            location.reload();
        }, 5000);
    </script> 
</body>

</html>