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

// Process the form submission to delete a vehicle
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['vehicle_id'])) {
    $vehicleIdToDelete = $_POST['vehicle_id'];

    // Perform the deletion in the database
    $deleteVehicleQuery = "DELETE FROM Vehicle WHERE id = '$vehicleIdToDelete' AND sacco_id = '{$adminInfo['sacco_id']}'";

    if (mysqli_query($conn, $deleteVehicleQuery)) {
        echo "Vehicle deleted successfully!";
        // You may want to refresh the page or redirect to update the displayed vehicle list
    } else {
        echo "Error deleting vehicle: " . mysqli_error($conn);
    }
}

// Retrieve all vehicles associated with the Sacco
$vehiclesQuery = "SELECT * FROM Vehicle WHERE sacco_id = '{$adminInfo['sacco_id']}'";
$vehiclesResult = mysqli_query($conn, $vehiclesQuery);

// Check for errors in the query
if (!$vehiclesResult) {
    die("Error fetching vehicles: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Vehicles</title>
</head>
<body>
<h2>Vehicles Associated with <?php echo $adminInfo['sacco_name']; ?></h2>
<p>Welcome, <?php echo $adminInfo['first_name'] . ' ' . $adminInfo['last_name']; ?>!</p>

<?php if (mysqli_num_rows($vehiclesResult) > 0) : ?>
    <table border="1">
        <tr>
            <th>Make</th>
            <th>Model</th>
            <th>Registration Plate</th>
            <th>Capacity</th>
            <th>Action</th>

        </tr>
        <?php while ($vehicle = mysqli_fetch_assoc($vehiclesResult)) : ?>
            <tr>
                <td><?php echo $vehicle['make']; ?></td>
                <td><?php echo $vehicle['model']; ?></td>
                <td><?php echo $vehicle['registration_plate']; ?></td>
                <td><?php echo $vehicle['capacity']; ?></td>
                <td>
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <input type="hidden" name="vehicle_id" value="<?php echo $vehicle['id']; ?>">
                        <input type="submit" value="Delete" onclick="return confirm('Are you sure you want to delete this vehicle?')">
                    </form>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
<?php else : ?>
    <p>No vehicles associated with <?php echo $adminInfo['sacco_name']; ?>.</p>
<?php endif; ?>

<!--back to admin dashboard-->
<a href="sacco_admin_dashboard.php">Back to Admin Dashboard</a>
</body>
</html>

<?php
// Close the database connection
mysqli_close($conn);
?>
