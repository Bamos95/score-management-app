<?php
// this file is a button action file

// import function file
require('method.php');
// action set matches in progres
if (isset($_POST['start'])) {
    $matchesId = $_POST['matchesId'];
    setMatchesInprogress($matchesId);

    header('location:scoresboard.php');
}
// save team1 goal
if (isset($_POST['savegoal1'])) {
    $matchesId = $_POST['matchesId'];
    $teamId = $_POST['teamId'];
    $scorer = $_POST['scorer'];
    $goalMinute = $_POST['goalMinute'];

    putGoal($matchesId, $teamId, $scorer, $goalMinute);

    header('location:scoresboard.php');
}
// save team2
if (isset($_POST['savegoal2'])) {
    $matchesId = $_POST['matchesId'];
    $teamId = $_POST['teamId'];
    $scorer = $_POST['scorer'];
    $goalMinute = $_POST['goalMinute'];

    putGoal($matchesId, $teamId, $scorer, $goalMinute);

    header('location:scoresboard.php');
}
// save statistics
if (isset($_POST['save'])) {
    $matchesId = $_POST['matchesId'];
    // first team data
    $team1Id = $_POST['team1Id'];
    $corner1 = $_POST['corner1'];
    $redCard1 = $_POST['redCard1'];
    $yellowCard1 = $_POST['yellowCard1'];
    $foul1 = $_POST['foul1'];
    $possession1 = $_POST['possession1'];
    //second team data
    $team2Id = $_POST['team2Id'];
    $corner2 = $_POST['corner2'];
    $redCard2 = $_POST['redCard2'];
    $yellowCard2 = $_POST['yellowCard2'];
    $foul2 = $_POST['foul2'];
    $possession2 = $_POST['possession2'];

    //call function to send data in database
    saveStatistics($matchesId, $team1Id, $corner1, $redCard1, $yellowCard1, $foul1, $possession1);
    saveStatistics($matchesId, $team2Id, $corner2, $redCard2, $yellowCard2, $foul2, $possession2);

    //call function to set matches completed
    setMatchesCompleted($matchesId);
    header('location:leaderboard.php');
}