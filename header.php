<?php if (session_status() === PHP_SESSION_NONE) {
  session_start();
  // header file
}
// logout button action
if (isset($_POST['deconnecter'])) {
  session_unset();
  header('location: index.php');
  exit;
} ?>

<nav class="navbar navbar-expand-lg navbar-primary bg-light rounded " aria-label="Thirteenth navbar example">
  <div class="container-fluid">
    <div class="collapse navbar-collapse d-lg-flex" id="navbarsExample11">
      <a class="navbar-brand col-lg-3 me-0" href="index.php">SPORTSCORES</a>
      <ul class="navbar-nav col-lg-6 justify-content-lg-center ">
        <?php 
        // sample user pagesroute
        if (isset($_SESSION['user'])) {
        ?>
          <li class="nav-item"><a href="index.php" class="nav-link active" aria-current="page">Acceuil</a></li>
          <li class="nav-item"><a href="matches.php" class="nav-link active" aria-current="page">Matches</a></li>
          <li class="nav-item"><a href="team.php" class="nav-link active">Equipes</a></li>

          <?php
          // admin pagesroute
          if ($_SESSION['user']['userGroup'] == "admin") {
          ?>
            <li class="nav-item"><a href="managematches.php" class="nav-link ">Gerer Matches</a></li>
            <li class="nav-item"><a href="manageteam.php" class="nav-link ">Gerer Equipe</a></li>
          <?php
          }
          ?>
      </ul>
      <div class="d-lg-flex col-lg-3 justify-content-lg-end">
        <form action="" method="post">
          <!-- logout button -->
          <button class="btn btn-danger" type="submit" name="deconnecter">Se deconnecter</button>
        </form>
      </div>
    <?php

        } else {
     ?>
     <!-- login and signup pagesroute -->
      <li class="nav-item"><a href="login.php" class="nav-link active">Se connecter ou S'inscrire</a></li>


    <?php
        }
    ?>
    </div>
  </div>
</nav>