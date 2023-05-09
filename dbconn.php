<?php

$servername="localhost";
$uname="root";
$pass="";
$dbname="ith107_prelim_exam";

$conn = mysqli_connect($servername, $uname, $pass, $dbname);
if (!$conn) {
	echo 'Error connecting to database'.mysqli_connect_error($conn);
}


?>