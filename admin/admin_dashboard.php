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
    <title>Admin Panel</title>

</head>
<body>
<div class="container">
    <div class="card">
        <h5>Logout</h5>
        <p>Click here to logout from the admin panel.</p>
        <a href="../auth/logout.php">Logout</a>
    </div>
    <div class="card">
        <h5>All Users</h5>
        <p>View all users registered in the system.</p>
        <a href="users.php">View All Users</a>
    </div>
    <div class="card">
        <h5>Change User Roles</h5>
        <p>Change the roles of existing users.</p>
        <a href="change_user_roles.php">Change User Roles</a>
    </div>
    <div class="card">
        <h5>Add Sacco</h5>
        <p>Add a new Sacco to the system.</p>
        <a href="add_sacco.php">Add New Sacco</a>
    </div>
    <div class="card">
        <h5>All Saccos</h5>
        <p>View all saccos in the system.</p>
        <a href="saccos.php">View All Saccos</a>
    </div>
</div>
</body>
</html>

<?php
// Set page title for the layout
$pageTitle = "Dashboard";

// Get the buffered content and assign it to $content
$pageContent = ob_get_clean();

// Include the layout
include('../layout.php');
?>
