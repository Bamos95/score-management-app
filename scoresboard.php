<?php session_start();
// admin use this file to manage matches (record score and matches statistics)

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
    <title>Scoresbord | SPORTSCORES </title>
</head>

<body>
    <!-- import header file -->
    <?php include('header.php');
    // we verify if user is admin
    if ($_SESSION['user']['userGroup'] == 'admin') {
    ?>       
        <div class="container bg-light">
            <div class="pricing-header p-3 pb-md-4 mx-auto text-center">
                <h1 class="display-6  text-body-emphasis lh-1 mb-3 text-center text" style="color: red;">En Direct</h1>
            </div>
        </div>
        <?php        // call method to get matches in progress
        $matches = getMatchesInprogress();
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
            <div class="container py-2 px-3">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card  py-3 shadow-lg">
                            <div class="d-flex justify-content-center align-items-center">
                                <img src=" images/<?= $team1['teamLogo'] ?>" class="card-img-top rounded-circle border-gray " style="width:200px; height:200px; border:5px solid;" alt="Logo">
                            </div>
                            <!-- form for record first team scores -->
                            <form action="setmatches.php" method="post" class="p-4 p-md-5 border rounded-3 bg-light">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" name="scorer" required>
                                    <label for="floatingInput">le Butteur</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="number" class="form-control" name="goalMinute" required>
                                    <label for="floatingPassword">Heure du but (Minute)</label>
                                </div>
                                <input type="hidden" name="matchesId" value="<?= htmlspecialchars($matches['matchesId']) ?>">
                                <input type="hidden" name="teamId" value="<?= htmlspecialchars($matches['team1Id']) ?>">
                                <button class="w-100 btn btn-lg btn-primary" type="submit" name="savegoal1">Enregistrer un but</button>
                            </form>
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
                                        <!-- display goal -->
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
                                <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                                    <form action="" method="post">
                                        <input type="hidden" name="matchesId" value="<?= htmlspecialchars($matches['matchesId']) ?>">
                                        <button type="submit" name="stop" class="btn btn-danger mt-3 mb-3">Mettre fin au match</button>
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
                            <!-- form for record second matches scores -->
                            <form action="setmatches.php" method="post" class="p-4 p-md-5 border rounded-3 bg-light">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" name="scorer" required>
                                    <label for="floatingInput">le Butteur</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="number" class="form-control" name="goalMinute" required>
                                    <label for="floatingInput">Heure du but (Minute)</label>
                                </div>
                                <input type="hidden" name="matchesId" value="<?= htmlspecialchars($matches['matchesId']) ?>">
                                <input type="hidden" name="teamId" value="<?= htmlspecialchars($matches['team2Id']) ?>">
                                <button class="w-100 btn btn-lg btn-primary" type="submit" name="savegoal2">Enregistrer un but</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        }
        // action under stop matches button
        if (isset($_POST['stop'])) {
            $matchesId = $_POST['matchesId'];

            // get matches data
            $matches = getMatches($matchesId);

            // get team data
            $team1Id = $matches['team1Id'];
            $team1 = getTeam($team1Id);
            $team2Id = $matches['team2Id'];
            $team2 = getTeam($team2Id);

            // get teams goal
            $team1Goal = countGoal($matches['matchesId'], $team1Id);
            $team2Goal = countGoal($matches['matchesId'], $team2Id);

            // set matches for teams
            setMatchesPoints($team1Id, $team1Goal, $team2Id, $team2Goal);
        ?>
            <!-- form for record matches statistics -->
            <div class="container-fluid col-xl-10 col-xxl-10 px-3 py-2 bg-dark">
                <div class="row align-items-center g-lg-5 py-2">
                    <div class="col-md-10 mx-auto col-lg-5">
                        <h3 class="text-center text-primary">Enregistrer les statistiques du match :</h3>
                        <form action="setmatches.php" method="post" class="p-4 p-md-5 border rounded-3 bg-light">
                            <!-- first team's statistics -->
                            <div class="form-floating mb-3">
                                <input type="number" class="form-control" name="foul1" required>
                                <label for="floatingInput">Nombre de Faute de l'equipe <?= htmlspecialchars($team1['teamName']) ?></label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="number" class="form-control" name="yellowCard1" required>
                                <label for="floatingInput">Nombre de Carton Jaune de l'equipe <?= htmlspecialchars($team1['teamName']) ?></label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="number" class="form-control" name="redCard1" required>
                                <label for="floatingInput">Nombre de Carton Rouge de l'equipe <?= htmlspecialchars($team1['teamName']) ?></label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="number" class="form-control" name="possession1" required>
                                <label for="floatingInput">Pourcentage de Possession de l'equipe <?= htmlspecialchars($team1['teamName']) ?></label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="number" class="form-control" name="corner1" required>
                                <label for="floatingInput">Nombre de Corner de l'equipe <?= htmlspecialchars($team1['teamName']) ?></label>
                            </div>
                            <input type="hidden" name="team1Id" value="<?= htmlspecialchars($team1Id) ?>">
                            <!-- Second team's statistics -->
                            <div class="form-floating mb-3">
                                <input type="number" class="form-control" name="foul2" required>
                                <label for="floatingInput">Nombre de Faute de l'equipe <?= htmlspecialchars($team2['teamName']) ?></label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="number" class="form-control" name="yellowCard2" required>
                                <label for="floatingInput">Nombre de Carton Jaune de l'equipe <?= htmlspecialchars($team2['teamName']) ?></label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="number" class="form-control" name="redCard2" required>
                                <label for="floatingInput">Nombre Carton Rouge de l'equipe <?= htmlspecialchars($team2['teamName']) ?></label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="number" class="form-control" name="possession2" required>
                                <label for="floatingInput">Pourcentage de possession de l'equipe <?= htmlspecialchars($team2['teamName']) ?></label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="number" class="form-control" name="corner2" required>
                                <label for="floatingInput">Nombre de Corner de l'equipe <?= htmlspecialchars($team2['teamName']) ?></label>
                            </div>
                            <input type="hidden" name="matchesId" value="<?= htmlspecialchars($matchesId) ?>">
                            <input type="hidden" name="team2Id" value="<?= htmlspecialchars($team2Id) ?>">
                            <button class="w-100 btn btn-lg btn-primary" type="submit" name="save">Enregistrer</button>
                        </form>
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
    include('footer.php'); ?>
    <script src="style/bootstrap.js"></script>
</body>

</html>