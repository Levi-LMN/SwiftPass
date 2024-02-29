<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: ../index.php");
    exit();
}

$user = $_SESSION['user'];

if ($user["role"] != 'admin') {
    header("Location: ../index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
</head>
<body>
<h2>Hello <?php echo $user['first_name']; ?>, welcome to the admin panel</h2>
<!-- Other content for the admin dashboard -->
<!--logout-->
<a href="../auth/logout.php">Logout</a>
<!--all users-->
<br>

<a href="users.php">All Users</a>
<!--change user roles-->
<br>
<a href="change_user_roles.php">Change user roles</a>
<br>
<!--add sacco-->
<a href="add_sacco.php">Add Sacco</a>
</body>
</html>
