<?php session_start();
//  admin use this file to manage (schedule or delete matches)

// import function file
require('method.php');
?>



<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Gerer Matches | SPORTSCORES</title>
    <link rel="stylesheet" href="style/bootstrap.css">
    <link rel="stylesheet" href="style/monstyle.css">
</head>

<body>
    <!-- import header file-->
    <?php include('header.php');  
    // we verify if user is admin
    if ($_SESSION['user']['userGroup'] == "admin") {
    ?>
        <!-- Bannere  -->
        <div class="px-4 py-3 my-2 text-center container" style="background-color: #8a05f0;">
            <h3 class="display-6 fw-bold" style="color: white;">Espace matches</h3>
            <div class="col-lg-6 mx-auto">
                <p class="lead mb-4" style="color:#dbb2fa;">Programmez les matches du tournoir de quatre equipes</p>
                <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                    <!-- button schedule matches -->
                    <form action="" method="post">
                        <button class="btn  btn-light" name="schedule">Programmer un match</button>
                    </form>
                </div>
            </div>
        </div>
        <!-- end bannere -->

        <?php if (isset($_POST['schedule'])) {
        ?>
            <!-- -------------form to schedule matches------------------ -->
            <div class="container-fluid col-xl-10 col-xxl-10 px-3 py-2 " style="background: #dbb2fa">
                <div class="row align-items-center g-lg-5 py-5">
                    <div class="col-md-10 mx-auto col-lg-5">
                        <form action="" method="post" class="p-4 p-md-5 border rounded-3 bg-light">
                            <!-- start time -->
                            <div class="form-floating mb-3">
                                <input type="datetime-local" class="form-control" name="startTime" required>
                                <label for="floatingInput">heure de debut du match</label>
                            </div>
                            <!-- stadium -->
                            <div class="form-floating mb-3">
                                <input type="stade" class="form-control" name="matchesStadium" required>
                                <label for="floatingInput">Stade</label>
                            </div>
                            <!-- select of firt team -->
                            <div class="form-floating mb-3">
                                <select id="select1" class="form-control" name="team1Id" required>
                                    <?php
                                    $teams = getTeams();
                                    foreach ($teams as $team) {
                                    ?>
                                        <option value="<?= htmlspecialchars($team['teamId']) ?>"><?= htmlspecialchars($team['teamName']) ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                                <label for="select">Selectionner la première equipe </label>
                            </div>
                            <!-- select of second team -->
                            <div class="form-floating mb-3">
                                <select id="select2" class="form-control" name="team2Id" required>
                                    <?php
                                    $teams = getTeams();
                                    foreach ($teams as $team) {
                                    ?>
                                        <option value="<?= htmlspecialchars($team['teamId']) ?>"><?= htmlspecialchars($team['teamName']) ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                                <label for="select">Selectionner la deuxième equipe </label>
                            </div>
                            <button class="w-100 btn btn-lg btn-primary" type="submit" name="add"> Ajouter </button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- ---------end form--------------------- -->
        <?php
        }
        //add matches data in database
        if (isset($_POST['add'])) {
            
            $team1Id = $_POST['team1Id'];
            $team2Id = $_POST['team2Id'];
            $startTime = $_POST['startTime'];
            $matchesStadium = $_POST['matchesStadium'];

            if ($team1Id == $team2Id) {
                echo '<script> alert("Une equipe ne peut jouer contre elle-même. Veuillez choisir de differentes equipes");</script>';
            } else {
                //call of method scheduleMatches 
                scheduleMatches($team1Id, $team2Id, $startTime, $matchesStadium);
                echo '<script> alert("Succès");</script>';
                header('location:managematches.php');
            }
        }
        //end add data

        // matches schedule
        $matches = getMatchesOnschedule();
        foreach ($matches as $matches) {
            // get teams data
            $team1Id = $matches['team1Id'];
            $team1 = getTeam($team1Id);
            $team2Id = $matches['team2Id'];
            $team2 = getTeam($team2Id);
        ?> 
        <!-- matches scheduled display -->
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
                                    <li class="list-group-item fw-bold"><?= htmlspecialchars($matches['startTime']) ?></li>
                                    <li class="list-group-item fw-bold"><?= htmlspecialchars($matches['matchesStadium']) ?></li>
                                </ul>
                                <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                                    <form action="setmatches.php" method="post">
                                        <input type="hidden" name="matchesId" value="<?= htmlspecialchars($matches['matchesId']) ?>">
                                        <button type="submit" name="start" class="btn btn-primary mt-3 mb-3">Demarrer</button>
                                    </form>
                                    <form action="delete.php" method="post">
                                        <input type="hidden" name="matchesId" value="<?= htmlspecialchars($matches['matchesId']) ?>">
                                        <button type="submit" name="deleteMatches" class="btn btn-danger mt-3 mb-3">Supprimer</button>
                                    </form>
                                </div>
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
        
    } else {
        ?>
        <!-- Bannere  -->
        <div class="px-4 py-3 my-2 text-center container" style="background-color: #8a05f0;">
            <h1 class="display-5 fw-bold" style="color: white;"> Espace admin ! </h1>
            <div class="col-lg-6 mx-auto">
                <p class="lead mb-4" style="color:#dbb2fa;">Vous devez vous connecter</p>
                <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                    <!-- login button -->
                    <a href="login.php" class="btn  btn-lg px-4 gap-3" style="background-color: white; color:#8a05f0;">Se connecter</a>

                </div>
            </div>
        </div>
        <!-- end bannere -->
    <?php
    }
//  import footer file
 include('footer.php'); ?>
    <script src="style/bootstrap.js"></script>
</body>

</html>