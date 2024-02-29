<?php
// Start the session
session_start();

// Check if the user is not logged in
if (!isset($_SESSION["user"])) {
    header("Location: ../auth/login.php");
    exit();
}

// Retrieve user details from the session
$user = $_SESSION["user"];

// Set page title for the layout
$pageTitle = "Driver Dashboard";

// Include database configuration
include '../auth/database.php'; // Update with your actual database configuration

// Retrieve vehicle details for the logged-in driver
$driverId = $user['id']; // Assuming you have an 'id' field in the User table
$get_vehicle_query = "SELECT * FROM Vehicle WHERE driver_id = $driverId";
$vehicle_result = $conn->query($get_vehicle_query);

// Check if the driver is associated with a Sacco
$isAssociatedWithSacco = !empty($user['sacco_id']);

// Content for the layout
ob_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Driver Dashboard</title>
</head>
<body>
<h2>Driver Dashboard</h2>

<p>Welcome, <?php echo $user["first_name"] . " " . $user["last_name"]; ?>!</p>

<h3>Your Details:</h3>
<ul>
    <li><strong>First Name:</strong> <?php echo $user["first_name"]; ?></li>
    <li><strong>Last Name:</strong> <?php echo $user["last_name"]; ?></li>
    <li><strong>Email:</strong> <?php echo $user["email"]; ?></li>
    <!-- Add more details as needed -->
</ul>

<?php if ($vehicle_result->num_rows > 0) { ?>
    <h3>Your Vehicle Details:</h3>
    <ul>
        <?php while ($vehicle = $vehicle_result->fetch_assoc()) { ?>
            <li><strong>Vehicle Model:</strong> <?php echo $vehicle["model"]; ?></li>
            <li><strong>License Plate:</strong> <?php echo $vehicle["registration_plate"]; ?></li>
            <li><strong>Capacity:</strong> <?php echo $vehicle["capacity"]; ?></li>

            <!-- Add more vehicle details as needed -->
        <?php } ?>
    </ul>
<?php } else { ?>
    <p>You are not associated with any vehicle.</p>
<?php } ?>

<?php if ($isAssociatedWithSacco) { ?>
    <h3>Your Sacco Details:</h3>
    <ul>
        <li><strong>Sacco Name:</strong> <?php echo $user["sacco_role"]; ?></li>
        <!-- Add more Sacco details as needed -->
    </ul>
<?php } else { ?>
    <p>You are not associated with any Sacco.</p>
<?php } ?>

<!-- Add other content for the driver dashboard -->

<a href="../auth/logout.php">Logout</a>
</body>
</html>

<?php
// Get the buffered content and assign it to $content
$pageContent = ob_get_clean();

// Include the layout
include('../layout.php');
?>
