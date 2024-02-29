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

// Check if the Sacco admin is associated with a Sacco
if (!$adminInfo['sacco_name']) {
    // Redirect to a page with appropriate access or show an error message
    echo "You are not currently associated with any Sacco.";
    exit();
}

// Retrieve all drivers
$driversQuery = "SELECT id, first_name, last_name FROM User WHERE role = 'driver'";
$driversResult = mysqli_query($conn, $driversQuery);

// Check for errors in the query
if (!$driversResult) {
    die("Error fetching drivers: " . mysqli_error($conn));
}

// Process the form submission to add a vehicle
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $make = $_POST['make'];
    $model = $_POST['model'];
    $registrationPlate = $_POST['registration_plate'];
    $capacity = $_POST['capacity'];
    $driverId = $_POST['driver_id'];

    // Insert data into Vehicle table
    $insertVehicleQuery = "INSERT INTO Vehicle (make, model, registration_plate, capacity, sacco_id, driver_id)
                           VALUES ('$make', '$model', '$registrationPlate', '$capacity', '{$adminInfo['sacco_id']}', '$driverId')";

    if (mysqli_query($conn, $insertVehicleQuery)) {
        echo "Vehicle added successfully!";
    } else {
        echo "Error adding vehicle: " . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Vehicle</title>
</head>
<body>
<h2>Add Vehicle</h2>
<p>Welcome, <?php echo $adminInfo['first_name'] . ' ' . $adminInfo['last_name']; ?>!</p>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="make">Make:</label>
    <input type="text" name="make" required><br>

    <label for="model">Model:</label>
    <input type="text" name="model" required><br>

    <label for="registration_plate">Registration Plate:</label>
    <input type="text" name="registration_plate" required><br>

    <label for="capacity">Capacity:</label>
    <input type="number" name="capacity" required><br>

    <label for="driver_id">Select Driver:</label>
    <select name="driver_id" required>
        <?php while ($driver = mysqli_fetch_assoc($driversResult)) : ?>
            <option value="<?php echo $driver['id']; ?>"><?php echo $driver['first_name'] . ' ' . $driver['last_name']; ?></option>
        <?php endwhile; ?>
    </select><br>

    <input type="submit" value="Add Vehicle">
</form>

<!--back to admin dashboard-->
<a href="sacco_admin_dashboard.php">Back to Admin Dashboard</a>
</body>
</html>
