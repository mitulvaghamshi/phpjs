<!DOCTYPE html>
<html lang="en-US">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/wumpus.css">
    <title>Wumpus</title>
</head>

<body>
    <!-- generate a board with 5 rows and 5 columns -->
    <div id="container">
        <h1>Hunt the Wumpus!</h1>
        <table>
            <?php
            for ($r = 0; $r < 5; $r++) {
                echo "<tr>";
                /* every box is clickable and point to the result.php */
                for ($c = 0; $c < 5; $c++) {
                    echo "<td><a href='result.php?row=$r&col=$c'></a></td>";
                }
                echo "</tr>";
            }
            ?>
        </table>
    </div>
</body>

</html>
