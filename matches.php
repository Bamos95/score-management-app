<?php session_start();
// this a matches file. User can display scheduled matchs

// import function file
require('method.php');
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/bootstrap.css">
    <link rel="stylesheet" href="style/monstyle.css">
    <title>Matches | SPORTSCORES </title>
</head>

<body>
    <!-- import header file -->
    <?php include('header.php') ?>
    <!-- Bannere  -->
    <div class="container  px-4 py-1 my-3 " style="background-color: blue;">
        <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
            <div class="col-10 col-sm-8 col-lg-6">
                <img src="images/image4.jpg" class="d-block mx-lg-auto img-fluid rounded-3" alt="SPORTSCORES" width="700" height="500" loading="lazy">
            </div>
            <div class="col-lg-6">
                <h1 class="display-5 fw-bold text-body-emphasis lh-1 mb-3 text-center text-white">SCORE EN DIRECT</h1>
                <p class="lead text-center text-light">Suivez les matches du tournoirs des quatres equipes.</p>
            </div>
        </div>
    </div>
    <!-- end Bannere -->

    <?php if (isset($_SESSION['user'])) {
    ?>
        <!-- matches in schedule-->
        <div class="container bg-light">
            <div class="pricing-header p-3 pb-md-4 mx-auto text-center">
                <h1 class="display-5 fw-bold text-body-emphasis lh-1 mb-3 text-center text" style="color: red;">Matches à venir :</h1>
                <p class="fs-5 text-body-secondary">Prenez le rendez-vous pour une experience inedite !</p>
            </div>
        </div>
        <?php

        // call method to get matches scheduled
        $matches = getMatchesOnschedule();
        foreach ($matches as $matches) {
            // get teams data
            $team1Id = $matches['team1Id'];
            $team1 = getTeam($team1Id);
            $team2Id = $matches['team2Id'];
            $team2 = getTeam($team2Id);
        ?>
            <!-- display scheduled matches-->
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
                        <div class="card shadow-lg " sstyle="border-radius:1%;">
                            <div class="card-body bg-secondary">
                                <ul class="list-group justify-content-center text-center">

                                    <li class="list-group-item fw-bold">Tournoir de Football</li>
                                    <li class="list-group-item">
                                        <h3 class="display-7 fw-bold text-body-emphasis lh-1 mb-3 text-center text" style="color: blue;"><?= htmlspecialchars($team1['teamName']) ?> VS <?= htmlspecialchars($team2['teamName']) ?></h3>
                                    </li>
                                    <li class="list-group-item fw-bold"><?= htmlspecialchars($matches['startTime']) ?></li>
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
    // import footer file
    include('footer.php'); ?>
    <script src="style/bootstrap.js"></script>
</body>

</html>