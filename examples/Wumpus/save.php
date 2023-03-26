<!DOCTYPE html>
<html lang="en-US">
<?php

/* retrieve player email and game result */
$email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
$result = filter_input(INPUT_POST, "result", FILTER_SANITIZE_STRING);

/* validate email and result values, show error on failure */
if ($email === false || $email === null || $email === "" || $result === false || $result === null || $result === false) {
    die("Please provide coordinate arguments");
}

/* import database connection module */
require('connect.php');

/* query database to check if the player already exists or not */
$sql = "SELECT player_email FROM players WHERE player_email=?";
$stmt = $dbh->prepare($sql);
$success = $stmt->execute([$email]);

/* set default time zone GMT:-04:00 */
date_default_timezone_set("America/Toronto");
$date = date("Y-m-d", time()); // (yyyy-mm-dd)

/* track whether player win or lose */
$win = $result == 'true' ? 1 : 0;
$lose = $result == 'true' ? 0 : 1;

/**
 * if player already exist, update their win and lose value with current date
 * or create a new user with win lose value of that player
 */
if ($success && $stmt->rowCount() === 1) {
    $sql = "UPDATE players SET player_wins=player_wins+?, player_losses=player_losses+?, play_date=? WHERE player_email=?";
    $stmt = $dbh->prepare($sql);
    $success = $stmt->execute([$win, $lose, $date, $email]);
} else {
    $sql = "INSERT INTO players (player_email, player_wins, player_losses, play_date) VALUES (?, ?, ?, ?)";
    $stmt = $dbh->prepare($sql);
    $success = $stmt->execute([$email, $win, $lose, $date]);
}

/* retrieve all the players from the database */
$sql = "SELECT * FROM players ORDER BY player_wins DESC";
$players = $dbh->prepare($sql);
$players->execute();
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/wumpus.css">
    <link rel="stylesheet" href="css/save.css">
    <title>Wumpus</title>
    <script>
        /**
         * this function will redirect user to homepage
         * the [replace] method actually replaces the current page
         * so user can't go back to this page with back navigation
         */
        const playAgain = () => window.location.replace("index.php");
    </script>
</head>

<body>
    <!-- play sample audio at score borad -->
    <!-- <audio src="./sounds/finish.mp3" autoplay>
        Your browser dose not support the audio tag.
    </audio> -->

    <!-- create a score board like view to display top 10 players list -->
    <div class="form-container">
        <h1>Results History</h1>

        <!-- play again button -->
        <h5><?= "👨‍🎓 Player: $email" ?><input type="button" value="Play Again!!!" onclick="playAgain()"></h5>
        <h4>Top 10 Winners</h4>
        <!-- top 10 players list with email, play stats and date for database -->
        <ul>
            <?php while ($row = $players->fetch()) {
                /* display "YOU" after email and highlight current player on the list with different color */
                $user = $row["player_email"] === $email ? "you" : "";
            ?>
                <li class="list-item">
                    <label <?= "class='user $user'" ?>>🤴 <?= $row['player_email'] . " " . strtoupper($user); ?></label>
                    <label class="date">Last played: <?= $row["play_date"] ?></label>
                    <div class="states">
                        <label class="wins">Won: <?= $row["player_wins"] ?>,</label>
                        <label class="losses">Lose: <?= $row["player_losses"] ?></label>
                    </div>
                </li>
            <?php } ?>
        </ul>
    </div>
</body>

</html>
