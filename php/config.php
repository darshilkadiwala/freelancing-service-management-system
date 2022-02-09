<?php
$servername = "localhost";
$dBUsername = "root";
$dBPassword = "";
$dBName = "dbfsms";
$dbConn = mysqli_connect($servername, $dBUsername, $dBPassword, $dBName) or
    die("Conection Failed... Internal server error...!! Please try later..");
