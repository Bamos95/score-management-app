<?php session_start();
// admin use this file to manage (schedule or delete teams)

// import function file
require('method.php');
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Gerer Equipe | SPORTSCORES</title>
    <link rel="stylesheet" href="style/bootstrap.css">
    <link rel="stylesheet" href="style/monstyle.css">
</head>

<body>
    <!-- import header file-->
    <?php include('header.php');  ?>
    <!-- we verfy if user is admin -->
    <?php if ($_SESSION['user']['userGroup'] == "admin") {
    ?>
        <!-- Bannere  -->
        <div class="px-4 py-3 my-2 text-center container" style="background-color: #8a05f0;">
            <h3 class="display-6 fw-bold" style="color: white;">Espace equipes</h3>
            <div class="col-lg-6 mx-auto">
                <p class="lead mb-4" style="color:#dbb2fa;">Ajoutez et supprimez les equipes</p>
                <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                    <!-- button add team -->
                    <form action="" method="post">
                        <button class="btn  btn-light" name="add">Ajouter une equipe</button>
                    </form>
                </div>
            </div>
        </div>
        <!-- end bannere -->

        <?php if (isset($_POST['add'])) {
        ?>
            <!-- -------------form add team------------------ -->
            <div class="container-fluid col-xl-10 col-xxl-10 px-3 py-2 " style="background: #dbb2fa">
                <div class="row align-items-center g-lg-5 py-5">
                    <div class="col-md-10 mx-auto col-lg-5">
                        <form action="" method="post" enctype="multipart/form-data" class="p-4 p-md-5 border rounded-3 bg-light">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="teamName" required>
                                <label for="floatingInput">Nom de l'equipe</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="file" class="form-control" name="teamLogo" required>
                                <label for="floatingInput">Logo de l'equipe </label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="teamStory" required>
                                <label for="floatingInput">Histoire de l'equipe</label>
                            </div>

                            <button class="w-100 btn btn-lg btn-primary" type="submit" name="team"> Ajouter </button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- ---------end form--------------------- -->
        <?php

        }
        //add team data in database       

        if (isset($_POST['team'])) {
            $teamName = $_POST['teamName'];
            $teamLogo = $_FILES['teamLogo']['name'];
            $teamStory = $_POST['teamStory'];
            //call of method addTeam to add the team
            addTeam($teamName, $teamLogo, $teamStory);
            echo '<script> alert("Succès");</script>';
            header('location:manageteam.php');
        }
        //end add data

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
                                    <li class="list-group-item" style=""> <span style="color:blue;"> Equipe :</span> <?= htmlspecialchars($team['teamName']) ?></li>
                                    <li class="list-group-item" style=""> <span style="color:blue;"> Histoire :</span> <?= htmlspecialchars($team['teamStory']) ?></li>
                                    <li class="list-group-item" style=""> <span style="color:blue;"> Point (Tournoir des quatres equipes) : </span> <?= htmlspecialchars($team['teamPoints']) ?> pts</li>
                                </ul>
                                <form action="delete.php" method="post">
                                    <input type="hidden" name="teamId" value="<?= $team['teamId']; ?>">
                                    <button type="submit" name="delete" class="btn btn-danger mt-3 mb-3">Supprimer</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        }
    } else {
        ?>
        <!-- bannere  -->
        <div class="px-4 py-3 my-2 text-center container" style="background-color: #8a05f0;">
            <h1 class="display-5 fw-bold" style="color: white;"> Espace admin ! </h1>
            <div class="col-lg-6 mx-auto">
                <p class="lead mb-4" style="color:#dbb2fa;">Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis facere repellat et debitis quibusdam, voluptas sapiente!</p>
                <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                    <!-- login button -->
                    <a href="login.php" class="btn  btn-lg px-4 gap-3" style="background-color: white; color:#8a05f0;">Se connecter</a>

                </div>
            </div>
        </div>
        <!--end  bannere-->
    <?php
    }
    // import footer file
    include('footer.php'); ?>
    <script src="style/bootstrap.js"></script>

</body>

</html>