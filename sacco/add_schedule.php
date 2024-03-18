<?php
session_start();

// Set page title for the layout
$pageTitle = "Add vehicle";

// Content for the layout
ob_start();

// Check if the user is logged in and has the role 'sacco admin'
if (!isset($_SESSION["user"]) || $_SESSION["user"]["role"] !== 'sacco admin') {
    // Redirect to the login page
    header("Location: login.php");
    exit();
}

// Database connection
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

// Check if the Sacco admin is associated with a Sacco
if (!$adminInfo['sacco_name']) {
    // Show an error message
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

<div>
    <div>
        <h2>Add Travel Schedule</h2>
    </div>
    <div>
        <p>Welcome, <?php echo $adminInfo['first_name'] . ' ' . $adminInfo['last_name']; ?>!</p>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div>
                <label>Departure Location:</label>
                <input type="text" name="departure_location" required>
            </div>

            <div>
                <label>Destination:</label>
                <input type="text" name="destination" required>
            </div>

            <div>
                <label>Departure Time:</label>
                <input type="datetime-local" name="departure_time" required>
            </div>

            <div>
                <label>Price:</label>
                <input type="number" name="price" required>
            </div>

            <div>
                <label>Select Vehicle:</label>
                <select name="vehicle_id" required>
                    <!-- Placeholder option -->
                    <option value="" disabled selected>Select Vehicle</option>

                    <?php while ($vehicle = mysqli_fetch_assoc($vehiclesResult)) : ?>
                        <option value="<?php echo $vehicle['id']; ?>">
                            <?php echo $vehicle['make'] . ' ' . $vehicle['model'] . (isset($vehicle['registration_plate']) ? ' - ' . $vehicle['registration_plate'] : ''); ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>

            <button type="submit">Add Travel Schedule</button>
        </form>
    </div>
    <div>
        <a href="sacco_admin_dashboard.php">Back to Admin Dashboard</a>
    </div>
</div>

<?php
// Get the buffered content and assign it to $content
$pageContent = ob_get_clean();

// Include the layout
include('../layout.php');
?>
