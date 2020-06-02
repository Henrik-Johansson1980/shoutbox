<?php

namespace JS_ShoutBox;

use PDO;

require  './config.php';
require  './classes/database.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ShoutBox</title>
    <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
    <div class="container">
        <header>
            <h1>ShoutBox</h1>
        </header>
        <ul id="shouts">
        <?php
        // Try and get Shouts from the Database
        try {
            $db = new Database();
            $db->query('SELECT * FROM shouts ORDER BY id DESC');
            $rows = $db->resultSet();
            foreach ($rows as $row) {
                printf('<li>%s: %s [%s]</li>', $row['name'], $row['shout'], $row['date']);
            }
        } catch (PDOException $e) {
            print "<p>Error!: " . $e->getMessage() . "</p>";
            $db = null;
        }

        ?>
        </ul>
        <footer>
            <form action="">
                <label>Name:</label>
                <input type="text" name="name" id="name" />
                <label >Shout Text:</label>
                <input type="text" name="shout" id="shout" />
                <br>
                <input type="submit" id="submit" value="Shout" />
            </form>
        </footer>
    </div> <!-- container -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
    integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
    crossorigin="anonymous">
    </script>
    <script src="./js/script.js"></script>
</body>
</html>
