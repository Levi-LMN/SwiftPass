<?php
//user dashboard page
// Set page title for the layout
$pageTitle = "Dashboard";

// Content for the layout
ob_start();

session_start();
$loggedIn = isset($_SESSION["user"]) && is_array($_SESSION["user"]);

// Retrieve the user's name from the session if logged in
$userName = $loggedIn ? ($_SESSION["user"]["first_name"] . " " . $_SESSION["user"]["last_name"]) : "";

// Redirect to the appropriate dashboard based on user role
if ($loggedIn) {
    $userRole = $_SESSION["user"]["role"];
    if ($userRole == 'admin') {
        header("Location: admin/admin_dashboard.php");
        exit();
    } elseif ($userRole == 'sacco admin') {
        header("Location: sacco/sacco_admin_dashboard.php");
        exit();
    } elseif ($userRole == 'driver') {
        header("Location: driver/driver_dashboard.php");
        exit();
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?></title>
    <link rel="stylesheet" href="style.css">
    <style>


    </style>
</head>
<body>
<div class="container">
    <div class="card">
        <?php if ($loggedIn): ?>
            <h2 class="dashboard-heading">Welcome, <?php echo $userName; ?>!</h2>
            <p class="dashboard-text">This is your personalized dashboard.</p>



    </div>
    <div class="card">
        <h2 class="schedule-heading">View All Travel Schedules</h2>
        <p class="schedule-text">View all travel schedules available in the system.</p>
        <a href="user/schedules.php" class="view-schedules-link">View Schedules</a>
    </div>
    <?php else: ?>
        <h1 class="welcome-heading">Welcome to Swiftpass!</h1>
        <p class="welcome-text">Explore our features by signing up or logging in.</p>
        <div class="login-register-card">
            <a href="auth/login.php" class="login-register-link">Login</a>
            <a href="auth/registration.php" class="login-register-link">Register</a>
        </div>
    <?php endif; ?>


</div>
</body>
</html>


<?php
// Get the buffered content and assign it to $content
$pageContent = ob_get_clean();

// Include the layout
include('layout.php');
?>
