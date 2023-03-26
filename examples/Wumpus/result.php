<!DOCTYPE html>
<html lang="en-US">
<?php

/* retrieve location of the clicked box */
$row = filter_input(INPUT_GET, "row", FILTER_VALIDATE_INT);
$col = filter_input(INPUT_GET, "col", FILTER_VALIDATE_INT);

/* validate box position value, show error message on failure */
if ($row === false || $row === null || $col === false || $col === null) {
    die("Please provide coordinate arguments");
}

/* import database connection module */
require('connect.php');

/* query database with current positional values to check if user found wumpus or not */
$sql = "SELECT * FROM wumpuses WHERE row_num=? AND column_num=?";
$stmt = $dbh->prepare($sql);
$success = $stmt->execute([$row, $col]);

/* specify audio and image file name */
$result = $success && $stmt->rowCount() === 1 ? 'true' : 'false';

/* remove all wumpus location from the database */
$reset = "UPDATE wumpuses SET row_num=?, column_num=?";
$stmt = $dbh->prepare($reset);
$stmt->execute([-1, -1]);

/* generate 5 random locations and insert it into 5 random blocks the database */
for ($i = 1; $i <= 5; $i++) {
    $shuffle = "UPDATE wumpuses SET row_num=?, column_num=? WHERE block_num=?";
    $stmt = $dbh->prepare($shuffle);
    $param = [rand(0, 4), rand(0, 4), rand(1, 25)]; // row: 0..4, col: 0..4, box: 1..25
    $stmt->execute($param);
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/wumpus.css">
    <link rel="stylesheet" href="css/result.css">
    <title>Wumpus</title>
</head>

<body>
    <!-- play success or failure audio -->
    <!-- <audio src=<?= "./sounds/$result.mp3" ?> autoplay>
        Your browser dose not support the audio tag.
    </audio> -->

    <!-- display wumpus location and message, if player found one -->
    <div id="container">
        <h1><?= $result === 'true' ? '🏆YaY, You Won!🏆' : 'Opps! You Lose!' ?></h1>
        <table>
            <?php
            for ($r = 0; $r < 5; $r++) {
                echo "<tr>";
                for ($c = 0; $c < 5; $c++) {
                    $block = $row === $r && $col === $c
                        ? "<img src='img/$result.png'>"
                        : "<a href='result.php?row=$r&col=$c'></a>";
                    echo "<td>$block</td>";
                }
                echo "</tr>";
            }
            ?>
        </table>
    </div>

    <!-- provide a form where player can input email and submit the result to the database -->
    <div class="form-container">
        <form action="save.php" method="post">
            <input type="email" name="email" placeholder="Enter email" required></input>
            <input type="hidden" name="result" value=<?= $result ?>>
            <input type="submit" name="submit">
        </form>
    </div>
</body>

</html>
