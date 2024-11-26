<?php
//  this file function file

//  etablish database connexion
function dbConnect()
{
  $DB_DNS = 'mysql:host=localhost;dbname=sportscores';
  $DB_USER = 'root';
  $DB_PASS = '';
  try {
    $database = new PDO($DB_DNS, $DB_USER, $DB_PASS);
  } catch (PDOException $th) {
    echo "Erreur " . $th->getMessage();
  }
  return $database;
}

//function to add user data in database
function insertUser($userName, $userMail, $userPassword, $userCountry, $userGroup): void
{
  // Insert data in database
  $pdo = dbConnect();
  $request = $pdo->prepare("INSERT INTO user (userName, userMail, userPassword, userCountry, userGroup) VALUES (?, ?, ?, ?, ?)");
  $request->bindValue(1, $userName);
  $request->bindValue(2, $userMail);
  $request->bindValue(3, $userPassword);
  $request->bindValue(4, $userCountry);
  $request->bindValue(5, $userGroup);

  $request->execute();
}

//method to add team information in database
function addTeam($teamName, $teamLogo, $teamStory)
{
  // we verify picture
  if (isset($_FILES['teamLogo']) && $_FILES['teamLogo']['error'] === UPLOAD_ERR_OK) {
    // destination folder
    $repertoireDestination = "images/";

    // we picture data
    $fileName = $_FILES['teamLogo']['name'];
    $cheminTemporaire = $_FILES['teamLogo']['tmp_name'];
    $fileSize = $_FILES['teamLogo']['size'];

    // we verify picture size (maximum 2 Mo)
    $maxSize = 2 * 1024 * 1024; // 2 Mo
    if ($fileSize > $maxSize) {
      echo '<script> alert("La taille du logo ne doit pas depasser 2 Mo. Veuillez choisir une image inferieure ou egale à 2 Mo.);</script>';
      
      exit;
    }

    // we verify picture format
    $typeImage = exif_imagetype($cheminTemporaire);
    $typesAcceptes = [IMAGETYPE_JPEG, IMAGETYPE_PNG, IMAGETYPE_GIF];

    if ($typeImage === false || !in_array($typeImage, $typesAcceptes)) {
      echo '<script> alert("Le type du logo non supporté. Veuillez choisir une image au format JPEG, PNG ou GIF. ");</script>';
      
      exit;
    }
    // picture name
    $imageName = uniqid() . "_" . $fileName;

    // destination folder way 
    $cheminDestination = $repertoireDestination . $imageName;

    // move picture to destination folder
    if (move_uploaded_file($cheminTemporaire, $cheminDestination)) {

      // insert query 
      $pdo = dbConnect();
      $request = $pdo->prepare("INSERT INTO team (teamName, teamLogo, teamStory) VALUES (?, ?, ?)");
      $request->bindValue(1, $teamName);
      $request->bindValue(2, $imageName);
      $request->bindValue(3, $teamStory);

      $request->execute();

      echo '<script> alert("Vous avez créer une equipe avec succès");</script>';
    } else {
      echo '<script> alert("Une erreur est survenue lors du téléchargement du logo.");</script>';      
      exit;
    }
  } else {
    echo '<script> alert("Une erreur est survenue lors du téléchargement du logo.");</script>';   
    exit;
  }
}

// function to get teams data
function getTeams()
{
  $pdo = dbConnect();
  $sql = "SELECT * FROM team ORDER BY teamPoints DESC";
  $req = $pdo->query($sql);
  $teams = $req->fetchAll();

  return $teams;
}

// function to get team data
function getTeam($teamid)
{
  $pdo = dbConnect();
  $sql = "SELECT * FROM team WHERE teamId = '$teamid' ";
  $req = $pdo->query($sql);
  $team = $req->fetch();

  return $team;
}

// function to delete team
function deleteTeam($teamId): void
{
  $pdo = dbConnect();
  $sql = "DELETE FROM team WHERE teamId = '$teamId'";
  $req = $pdo->query($sql);
}

// function to schedule match
function scheduleMatches($team1Id, $team2Id, $startTime, $matchesStadium): void
{
  // Insert data in database
  $pdo = dbConnect();
  $request = $pdo->prepare("INSERT INTO matches (team1Id, team2Id, startTime, matchesStadium) VALUES (?, ?, ?, ?)");
  $request->bindValue(1, $team1Id);
  $request->bindValue(2, $team2Id);
  $request->bindValue(3, $startTime);
  $request->bindValue(4, $matchesStadium);

  $request->execute();
}


// function to get matche
function getMatches($matchesId)
{
  $pdo = dbConnect();
  $sql = "SELECT * FROM matches WHERE matchesId = '$matchesId'";
  $req = $pdo->query($sql);
  $matches = $req->fetch();

  return $matches;
}

// function to get scheduled matches
function getMatchesOnschedule()
{
  $pdo = dbConnect();
  $sql = "SELECT * FROM matches WHERE status = 'scheduled' ";
  $req = $pdo->query($sql);
  $matches = $req->fetchAll();

  return $matches;
}

// function get matches in progress
function getMatchesInprogress()
{
  $pdo = dbConnect();
  $sql = "SELECT * FROM matches WHERE status = 'progress' ";
  $req = $pdo->query($sql);
  $matches = $req->fetchAll();

  return $matches;
}

// function to set matches un progress
function setMatchesInprogress($matchesId): void
{
  $pdo = dbConnect();
  $sql = "UPDATE matches SET status = 'progress' WHERE matchesId = '$matchesId' ";
  $req = $pdo->query($sql);
}

// function to get completed matches
function getMatchesCompleted()
{
  $pdo = dbConnect();
  $sql = "SELECT * FROM matches WHERE status = 'completed' ";
  $req = $pdo->query($sql);
  $matches = $req->fetchAll();

  return $matches;
}

// function to set matches completed
function setMatchesCompleted($matchesId): void
{
  $pdo = dbConnect();
  $sql = "UPDATE matches SET status = 'completed' WHERE matchesId = '$matchesId' ";
  $req = $pdo->query($sql);
}

// function to delete matches
function deleteMatches($matchesId): void
{
  $pdo = dbConnect();
  $sql = "DELETE FROM matches WHERE matchesId = '$matchesId'";
  $req = $pdo->query($sql);
}

// function to save goal 
function putGoal($matchesId, $teamId, $scorer, $goalMinute): void
{
  // Insert data in database
  $pdo = dbConnect();
  $request = $pdo->prepare("INSERT INTO goal (matchesId, teamId, scorer, goalMinute) VALUES (?, ?, ?, ?)");
  $request->bindValue(1, $matchesId);
  $request->bindValue(2, $teamId);
  $request->bindValue(3, $scorer);
  $request->bindValue(4, $goalMinute);

  $request->execute();
}

// function to count team's goal
function countGoal($matchesId, $teamId)
{
  $pdo = dbConnect();
  $sql = "SELECT COUNT(*) AS totalGoal FROM goal WHERE matchesId = '$matchesId' AND teamId = '$teamId' ";
  $req = $pdo->query($sql);
  $results = $req->fetch(PDO::FETCH_ASSOC);
  $goal = $results['totalGoal'];
  return $goal;
}

// function to update team's points
function updateTeamPoints($teamId, $points): void
{
  $pdo = dbConnect();
  $sql = "UPDATE team SET teamPoints = teamPoints + '$points' WHERE teamId = '$teamId'";
  $req = $pdo->query($sql);
}
 // share matches points
function setMatchesPoints($team1Id, $team1Goal, $team2Id, $team2Goal): void
{
  //we verify if Team1 win
  if ($team1Goal > $team2Goal) {
    // add 3 points to Team1
    updateTeamPoints($team1Id, 3);
  } //we verify if Team2 win
   elseif ($team2Goal > $team1Goal) {
    // add 3 points to Team2
    updateTeamPoints($team2Id, 3);
  } //in equality 
  else {
    // add 1 points to Team1
    updateTeamPoints($team1Id, 1);
    // add 1 points to Team2
    updateTeamPoints($team2Id, 1);
  }
}

//  add statistics in database
function saveStatistics($matchesId, $teamId, $corner, $redCard, $yellowCard, $foul, $possession)
{
  $pdo = dbConnect();
  $request = $pdo->prepare("INSERT INTO statistics (matchesId, teamId, corner, redCard, yellowCard, foul, possession) VALUES (?, ?, ?, ?, ?, ?, ?)");
  $request->bindValue(1, $matchesId);
  $request->bindValue(2, $teamId);
  $request->bindValue(3, $corner);
  $request->bindValue(4, $redCard);
  $request->bindValue(5, $yellowCard);
  $request->bindValue(6, $foul);
  $request->bindValue(7, $possession);
  
  $request->execute();
}

// get matches statistics
function getStatistics($matchesId, $teamId)
{
  $pdo = dbConnect();
  $sql = "SELECT * FROM statistics WHERE matchesId = '$matchesId' AND teamId = '$teamId' ";
  $req = $pdo->query($sql);
  $stats = $req->fetch();

  return $stats;
}
