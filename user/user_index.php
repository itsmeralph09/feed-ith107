<?php
session_start();

if (!isset($_SESSION['username'])) {
	// $_SESSION['error_message'] = "You need to login first";
	header('Location: /login.php');
	exit;
}
if ($_SESSION['role'] != "user") {
	header('Location: /login.php');
	exit;
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Index</title>
	<!-- <link rel="stylesheet" type="text/css" href="./css/bootstrap.css"> -->
	<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->
	<link rel="stylesheet" type="text/css" href="./bootstrap-5.0.2-dist/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="./css/style.css">

</head>
<body>
	<div class="container">
		<h2 class="text-center">View Users</h2>
		<p>Hi <span><?php echo $_SESSION['username']; ?></span>, you're just a <span><?php echo $_SESSION['role']; ?></span>. You have no superpowers to delete, update and create users, aww sad.</p>

		<a class="btn btn-info mb-3 float-start" href="./user_update_profile.php" role="button">Update Profile</a>
		<a class="btn btn-success mb-3 float-start" href="./feed.php" role="button">Feed</a>
		<a class="btn btn-outline-secondary mb-3 float-end" href="./logout.php" role="button">Logout</a>

		<table class="table table-hover bg-light table-striped table-bordered">
			<thead>
				<tr class="text-left">
					<th>ID</th>
					<th>Fisrt Name</th>
					<th>Last Name</th>
					<th>Username</th>
					<th>Role</th>
				</tr>
				<tbody>
				<?php

				require 'dbconn.php';

				$sql = "SELECT * FROM tbl_users ORDER BY username ASC";

				$result = mysqli_query($conn, $sql);

				if (!$result){

					die("Invalid query: ");

				}

				while ($row = mysqli_fetch_assoc($result)) {
					echo "

					<tr>
						<td>$row[id]</td>
						<td>$row[fname]</td>
						<td>$row[lname]</td>
						<td>$row[username]</td>
						<td>$row[role]</td>
					</tr>

					";
				}

				mysqli_close($conn);
				?>
				

				</tbody>
			</thead>
		</table>

	</div>
	<div class="post-area">
		
	</div>

</body>
</html>