<?php
// Connecting to database

$con = mysqli_connect("127.0.0.1", "root", "", "test");

if(!$con) {
    die("Error connection to DB" . mysqli_connect_errno());
}

?>