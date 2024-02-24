<?php
// Set page title for the layout
$pageTitle = "Dashboard";

// Content for the layout
ob_start();
?>

<?php
session_start();
//if (!isset($_SESSION["user"])) {
//    header("Location: auth/login.php");
//}
?>
<?php
$loggedIn = isset($_SESSION["user"]);
?>


<div >
    <h1>Welcome to Dashboard</h1>
<?php if ($loggedIn): ?>
    <p>You are logged in </p>
    <a href="auth/logout.php" class="btn btn-warning">Logout</a>
    <br>
    <br>
    <br>
    <a href="admin/users.php" class="btn btn-warning">All Users</a>
<?php else: ?>
    <p>You are not logged in</p>
    <a href="auth/login.php" class="btn btn-warning">Login</a>
    <br>
    <br>
    <br>
    <a href="auth/registration.php" class="btn btn-warning">Register</a>
<?php endif; ?>
</div>


<?php
// Get the buffered content and assign it to $content
$pageContent = ob_get_clean();

// Include the layout
include('layout.php');
?>