<?php session_start();
// this is a leaderboard file

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
    <title>Classements | SPORTSCORES </title>
</head>

<body>
    <?php include('header.php');
    // we verfie if user un connected
    if (isset($_SESSION['user'])) {
    ?>
        <div class="container bg-dark">
            <div class="pricing-header p-3 pb-md-4 mx-auto text-center">
                <h1 class="display-6 fw-bold text-body-emphasis lh-1 mb-3 text-center text" style="color: blue;">Classements et statistiques</h1>
            </div>
        </div>

        <!-- leaderboard display in real-time    -->
        <div class="container my-4">
            <div class="card">
                <div class="card-header">Tableau de classements</div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>N°</th>
                                <th>Equipes</th>
                                <th>Points</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            //get team list
                            $teams = getTeams();
                            $num = 1;

                            foreach ($teams as $team) {
                            ?>
                                <tr>
                                    <td><?= $num++ ?></td>
                                    <td> <?= htmlspecialchars($team['teamName']) ?></td>
                                    <td> <?= htmlspecialchars($team['teamPoints']) ?> pts</td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- end of bord  -->
        <?php
        // display completed matches
        $matches = getMatchesCompleted();
        foreach ($matches as $matches) {
            $matchesId = $matches['matchesId'];
            // get teams data
            $team1Id = $matches['team1Id'];
            $team1 = getTeam($team1Id);
            $team2Id = $matches['team2Id'];
            $team2 = getTeam($team2Id);
            //    get matches statistcis data
            $team1Stats = getStatistics($matchesId, $team1Id);
            $team2Stats = getStatistics($matchesId, $team2Id);

            // get teams goal
            $team1Goal = countGoal($matchesId, $team1Id);
            $team2Goal = countGoal($matchesId, $team2Id);

        ?> 
        <!-- display matches -->
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
                                    <li class="list-group-item">
                                        <h3 class="display-9 fw-bold text-body-emphasis lh-1 mb-3 text-center text" style="color: black;"><?php if ($team1Goal) {
                                                                                                                                                echo $team1Goal;
                                                                                                                                            } else {
                                                                                                                                                echo "0";
                                                                                                                                            } ?> : <?php if ($team2Goal) {
                                                                                                                                                        echo $team2Goal;
                                                                                                                                                    } else {
                                                                                                                                                        echo "0";
                                                                                                                                                    } ?></h3>
                                    </li>

                                    <li class="list-group-item fw-bold"><?= htmlspecialchars($team1Stats['corner']) ?> -- CORNER -- <?= htmlspecialchars($team2Stats['corner']) ?></li>
                                    <li class="list-group-item fw-bold"><?= htmlspecialchars($team1Stats['yellowCard']) ?> -- CARTON JAUNE -- <?= htmlspecialchars($team2Stats['yellowCard']) ?></li>
                                    <li class="list-group-item fw-bold"><?= htmlspecialchars($team1Stats['redCard']) ?> -- CARTON ROUGE -- <?= htmlspecialchars($team2Stats['redCard']) ?></li>
                                    <li class="list-group-item fw-bold"><?= htmlspecialchars($team1Stats['foul']) ?> -- FAUTE -- <?= htmlspecialchars($team2Stats['foul']) ?></li>
                                    <li class="list-group-item fw-bold"><?= htmlspecialchars($team1Stats['possession']) ?> % -- POSSESSION -- <?= htmlspecialchars($team2Stats['possession']) ?> %</li>
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
                      <!-- end display  -->
        <?php
        }
    } else {
        ?>
        <!-- Bannere  -->
        <div class="px-4 py-3 my-2 text-center container" style="background-color: #8a05f0;">
            <h1 class="display-5 fw-bold" style="color: white;"> Espace membre ! </h1>
            <div class="col-lg-6 mx-auto">
                <p class="lead mb-4" style="color:#dbb2fa;">Vous devez vous connecter</p>
                <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                    <!-- button -->
                    <a href="login.php" class="btn  btn-lg px-4 gap-3" style="background-color: white; color:#8a05f0;">Se connecter</a>

                </div>
            </div>
        </div>
        <!-- end bannere -->
    <?php
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