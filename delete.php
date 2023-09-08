<?php
// action delete file

//import function file 
include('method.php');
// delete a team
if (isset($_POST['delete'])) {
    $teamId = $_POST['teamId'];
    deleteTeam($teamId);
    header('location:manageteam.php');
}

// delete a matches schedule
if (isset($_POST['deleteMatches'])) {
    $matchesId = $_POST['matchesId'];
    deleteMatches($matchesId);
    header('location:managematches.php');
}
