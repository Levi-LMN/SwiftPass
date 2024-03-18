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

<?php if ($loggedIn): ?>
    <h2>Welcome, <?php echo $userName; ?>!</h2>
    <p>This is your personalized dashboard.</p>
<?php else: ?>
    <h1>Welcome to Swiftpass!</h1>
    <p>Explore our features by signing up or logging in.</p>
    <a href="auth/login.php">Login</a>
    <br><br><br>
    <a href="auth/registration.php">Register</a>
<?php endif; ?>

<h2>View All Travel Schedules</h2>
<p>View all travel schedules available in the system.</p>
<a href="user/schedules.php">View Schedules</a>

<h2>Explore Kenya's Popular Destination Routes</h2>
<div>
    <h3>Nairobi to Mombasa</h3>
    <p>Discover the beauty of coastal landscapes and vibrant city life on our Nairobi to Mombasa route.</p>
    <small>Date: February 25, 2024</small>
</div>
<div>
    <h3>Nakuru to Kisumu</h3>
    <p>Embark on a scenic journey from Nakuru to Kisumu, surrounded by the breathtaking views of the Great Rift Valley.</p>
    <small>Date: March 10, 2024</small>
</div>
<div>
    <h3>Kisii to Eldoret</h3>
    <p>Experience the cultural richness as you travel from Kisii to Eldoret, a journey filled with diverse traditions and landscapes.</p>
    <small>Date: March 18, 2024</small>
</div>

<?php
// Get the buffered content and assign it to $content
$pageContent = ob_get_clean();

// Include the layout
include('layout.php');
?>
