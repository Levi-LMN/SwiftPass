<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION["user"])) {
    // Redirect to the login page or handle the case where the user is not logged in
    header("Location: login.php");
    exit();
}

// Include your database connection code here
include '../auth/database.php'; // Update with your actual database connection file

// Retrieve the Sacco admin's information from the User table
$adminId = $_SESSION["user"]["id"]; // Assuming "id" is the unique identifier for the user
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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sacco Admin Dashboard</title>
</head>
<body>
<h2>Sacco Admin Dashboard</h2>
<p>Welcome, <?php echo $adminInfo['first_name'] . ' ' . $adminInfo['last_name']; ?>!</p>

<?php if ($adminInfo['sacco_name']) : ?>
    <p>You are associated with the Sacco: <?php echo $adminInfo['sacco_name']; ?></p>
    <!-- Add more content specific to the Sacco admin's dashboard -->
    <a href="add_vehicle.php">Add Vehicle</a>
    <a href="view_vehicles.php">View Vehicles</a>
    <a href="add_schedule.php">Add Schedule</a>
    <a href="travel_schedules.php">View Travel Schedules</a>
<?php else : ?>
    <p>You are not currently associated with any Sacco.</p>
<?php endif; ?>

<!-- Add more content specific to the Sacco admin's dashboard -->

<!-- Logout link -->
<a href="logout.php">Logout</a>
</body>
</html>

<?php
// Close the database connection
mysqli_close($conn);
?>
