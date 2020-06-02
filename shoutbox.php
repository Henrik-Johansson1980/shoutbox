<?php

namespace JS_ShoutBox;

use PDO;

require  './config.php';
require  './classes/database.php';

// Check passed in data
if (isset($_POST['name']) && isset($_POST['shout'])) {
    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $shout = filter_var($_POST['shout'], FILTER_SANITIZE_STRING);
    $date = filter_var($_POST['date'], FILTER_SANITIZE_STRING);
    try {
        date_default_timezone_set('Europe/Stockholm');
        $date = date('h:i:s a', time());
    } catch (Throwable $e) {
        print "<p>Error!: " . $e->getMessage() . "</p>";
    }

    // Create database connection.
    try {
        $db = new Database();
        $db->query('INSERT INTO shouts (name, shout, date) VALUES(:name, :shout, :date)');
        $db->bind(':name', $name);
        $db->bind(':shout', $shout);
        $db->bind(':date', $date);
        $db->execute();
        echo "<li>$name: $shout [$date]</li>";
    } catch (PDOException $e) {
        print "<p>Error!: " . $e->getMessage() . "</p>";
        $db = null;
    }
}
