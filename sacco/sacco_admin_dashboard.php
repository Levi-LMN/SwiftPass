<?php
session_start();

// Set page title for the layout
$pageTitle = "Sacco Administrator Dashboard";

// Content for the layout
ob_start();

// Check if the user is logged in
if (!isset($_SESSION["user"])) {
    // Redirect to the login page or handle the case where the user is not logged in
    header("Location: login.php");
    exit();
}

//  database connection
include '../auth/database.php';

// Retrieve the Sacco admin's information from the User table
$adminId = $_SESSION["user"]["id"];
$adminQuery = "SELECT u.*, s.name AS sacco_name
                FROM User u
                LEFT JOIN Sacco s ON u.sacco_id = s.id
                WHERE u.id = '$adminId'";

$adminResult = mysqli_query($conn, $adminQuery);

// Check for errors in the query
if (!$adminResult) {
    die("Error fetching Sacco admin information: " . mysqli_error($conn));
}

// Fetch the Sacco admin's information
$adminInfo = mysqli_fetch_assoc($adminResult);
?>


<div>
    <h2>Sacco Admin Dashboard</h2>
    <p>Welcome, <?php echo $adminInfo['first_name'] . ' ' . $adminInfo['last_name']; ?>!</p>

    <?php if ($adminInfo['sacco_name']) : ?>
        <p>You are associated with the Sacco: <?php echo $adminInfo['sacco_name']; ?></p>
        <div>
            <div>
                <h5>Add Vehicle</h5>
                <p>Add a new vehicle to the Sacco fleet.</p>
                <a href="add_vehicle.php">Go to Add Vehicle</a>
            </div>

            <div>
                <h5>View Vehicles</h5>
                <p>View and manage the existing vehicles in the Sacco.</p>
                <a href="view_vehicles.php">Go to View Vehicles</a>
            </div>

            <div>
                <h5>Add Schedule</h5>
                <p>Create a new travel schedule for the Sacco.</p>
                <a href="add_schedule.php">Go to Add Schedule</a>
            </div>

            <div>
                <h5>View Travel Schedules</h5>
                <p>View and manage the existing travel schedules in the Sacco.</p>
                <a href="travel_schedules.php">Go to View Travel Schedules</a>
            </div>
        </div>
    <?php else : ?>
        <p>You are not currently associated with any Sacco.</p>
    <?php endif; ?>

    <!-- Logout link -->
    <a href="logout.php">Logout</a>
</div>

<?php
// Close the database connection
mysqli_close($conn);
?>

<?php
// Get the buffered content and assign it to $content
$pageContent = ob_get_clean();

// Include the layout
include('../layout.php');
?>
