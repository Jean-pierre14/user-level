<?php
    $DB_NAME = "user_level_db";
    $DB_USER = "root";
    $DB_PASSWORD = "";
    $DB_HOST = "localhost";

    $con = mysqli_connect($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_NAME) or die("Cannot connect to this DB");