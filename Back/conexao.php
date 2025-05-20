<?php
    $mysqli = new mysqli("Localhost", "root", "", "db_feedback");
    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }
?>