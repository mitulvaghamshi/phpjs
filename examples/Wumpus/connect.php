<?php
try {
    $dbh = new PDO("mysql:host=localhost;dbname=xdb", "root", "");
} catch (Exception $e) {
    die("ERROR: Couldn't connect. {$e->getMessage()}");
}
?>
