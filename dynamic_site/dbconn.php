<?php

const DB_HOST = "localhost"; // Do not modify this line
const DB_USER = "jc101"; // TODO Set this to your username
const DB_PASS = "2ee458d907dc"; // TODO Set this to your DB password (from mysql_pass.txt)
const DB_NAME = DB_USER;     // Do not modify this line

try {
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
} catch (mysqli_sql_exception $ex) {
    // Something went wrong...
    echo "<p>Error: Unable to connect to database.</p>";
    echo "<p>Debugging error code: " . $ex->getCode() . "</p>";
    echo "<p>Debugging message: " . $ex->getMessage() . "</p>";
    exit;
}