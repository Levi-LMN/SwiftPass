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

<div>
    <h2>Hello <?php echo $user['first_name']; ?>, welcome to the admin panel</h2>
    <hr>
    <!--logout-->
    <div>
        <h5>Logout</h5>
        <p>Click here to logout from the admin panel.</p>
        <a href="../auth/logout.php">Logout</a>
    </div>
    <!--all users-->
    <div>
        <h5>All Users</h5>
        <p>View all users registered in the system.</p>
        <a href="users.php">All Users</a>
    </div>
    <!--change user roles-->
    <div>
        <h5>Change User Roles</h5>
        <p>Change the roles of existing users.</p>
        <a href="change_user_roles.php">Change User Roles</a>
    </div>
    <!--add sacco-->
    <div>
        <h5>Add Sacco</h5>
        <p>Add a new Sacco to the system.</p>
        <a href="add_sacco.php">Add Sacco</a>
    </div>
    <!--all saccos-->
    <div>
        <h5>All Saccos</h5>
        <p>View all saccos system.</p>
        <a href="saccos.php">View Sacco</a>
    </div>
</div>

<?php
// Set page title for the layout
$pageTitle = "Dashboard";

// Get the buffered content and assign it to $content
$pageContent = ob_get_clean();

// Include the layout
include('../layout.php');
?>
