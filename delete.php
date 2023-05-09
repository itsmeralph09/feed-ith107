<?php
require_once 'dbconn.php';

if (isset($_GET["id"])){
	$id =$_GET["id"];
	$sql = "DELETE FROM tbl_users WHERE id=$id";
	$result = mysqli_query($conn, $sql);
}
mysqli_close($conn);

header("location: ./index.php");
exit;

?>