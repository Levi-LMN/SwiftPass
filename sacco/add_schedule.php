<?php
session_start();

// Check if the user is logged in and has the role 'sacco admin'
if (!isset($_SESSION["user"]) || $_SESSION["user"]["role"] !== 'sacco admin') {
    // Redirect to the login page or handle the case where the user is not logged in or not a sacco admin
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

// Retrieve vehicles associated with the Sacco
$vehiclesQuery = "SELECT id, make, model, registration_plate FROM Vehicle WHERE sacco_id = '{$adminInfo['sacco_id']}'";
$vehiclesResult = mysqli_query($conn, $vehiclesQuery);

// Check for errors in the query
if (!$vehiclesResult) {
    die("Error fetching vehicles: " . mysqli_error($conn));
}


// Process the form submission to add a travel schedule
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $departureLocation = $_POST['departure_location'];
    $destination = $_POST['destination'];
    $departureTime = $_POST['departure_time'];
    $price = $_POST['price'];
    $vehicleId = $_POST['vehicle_id'];

    // Insert data into TravelSchedule table
    $insertScheduleQuery = "INSERT INTO TravelSchedule (departure_location, destination, departure_time, price, vehicle_id)
                            VALUES ('$departureLocation', '$destination', '$departureTime', '$price', '$vehicleId')";

    if (mysqli_query($conn, $insertScheduleQuery)) {
        echo "Travel schedule added successfully!";
    } else {
        echo "Error adding travel schedule: " . mysqli_error($conn);
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
    <title>Add Travel Schedule</title>
</head>
<body>
<h2>Add Travel Schedule</h2>
<p>Welcome, <?php echo $adminInfo['first_name'] . ' ' . $adminInfo['last_name']; ?>!</p>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="departure_location">Departure Location:</label>
    <input type="text" name="departure_location" required><br>

    <label for="destination">Destination:</label>
    <input type="text" name="destination" required><br>

    <label for="departure_time">Departure Time:</label>
    <input type="datetime-local" name="departure_time" required><br>

    <label for="price">Price:</label>
    <input type="number" name="price" required><br>

    <label for="vehicle_id">Select Vehicle:</label>
    <select name="vehicle_id" required>
        <?php while ($vehicle = mysqli_fetch_assoc($vehiclesResult)) : ?>
            <option value="<?php echo $vehicle['id']; ?>">
                <?php echo $vehicle['make'] . ' ' . $vehicle['model'] . (isset($vehicle['registration_plate']) ? ' - ' . $vehicle['registration_plate'] : ''); ?>
            </option>

        <?php endwhile; ?>
    </select><br>

    <input type="submit" value="Add Travel Schedule">
</form>

<!--back to admin dashboard-->
<a href="sacco_admin_dashboard.php">Back to Admin Dashboard</a>
</body>
</html>
