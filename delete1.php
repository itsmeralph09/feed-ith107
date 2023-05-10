<?php
require_once 'dbconn.php';

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Get the user ID from the URL parameter
    $user_id = $_GET['id'];

    // Delete the user from the database
    $sql = "DELETE FROM tbl_users WHERE id='$user_id'";

    if ($conn->query($sql) === TRUE) {
        echo "<script>
    alert('User deleted successfully!');
    window.location.href = 'index.php';
</script>";
    } else {
        echo "Error deleting user: " . $conn->error;
    }
}

// Get the user ID from the URL parameter
$user_id = $_GET['id'];

// Select the user's information from the database
$sql = "SELECT id, fname, lname, username, password, role FROM tbl_users WHERE ID='$user_id'";

$result = $conn->query($sql);

// Check if there are any results
if ($result->num_rows > 0) {
    // Output the user's information in a form
    $row = $result->fetch_assoc();
    ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Delete User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container ">
        <div class="row ">
            <div class="col-sm-12 text-center">
                <br>
                <h1>Delete user</h1>
                <form method="post">
                    <div class="mb-3">
                        <p>You are about to delete this record.</p>
                        <p class="text-danger"><strong>Are you sure you want to delete this user?</strong></p>
                        <p>First Name: <?php echo $row['fname']; ?></p>
                        <p>Last Name: <?php echo $row['lname']; ?></p>
                        <p>Username: <?php echo $row['username']; ?></p>
                    
                        <p>Role: <?php echo $row['role']; ?></p>
                    </div>

                    <button type="submit" class="btn btn-danger">Delete User</button>
                </form>

            </div>
        </div>
    </div>
</body>
</html>
<?php }?>