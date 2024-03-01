<?php
session_start();

// Set page title for the layout
$pageTitle = "Driver Dashboard";

// Content for the layout
ob_start();

// Check if the user is logged in
if (!isset($_SESSION["user"])) {
    // Redirect to the login page or handle the case where the user is not logged in
    header("Location: login.php");
    exit();
}

// Include your database connection code here
include '../auth/database.php'; // Update with your actual database connection file

// Retrieve the driver's information from the User table
$driverId = $_SESSION["user"]["id"];
$driverQuery = "SELECT u.*, v.id AS vehicle_id, v.make, v.model, v.registration_plate
                FROM User u
                LEFT JOIN Vehicle v ON u.id = v.driver_id
                WHERE u.id = '$driverId'";

$driverResult = mysqli_query($conn, $driverQuery);

// Check for errors in the query
if (!$driverResult) {
    die("Error fetching driver information: " . mysqli_error($conn));
}

// Fetch the driver's information
$driverInfo = mysqli_fetch_assoc($driverResult);

// Check if the driver is associated with a vehicle
if (!$driverInfo['make']) {
    // Redirect to a page with appropriate access or show an error message
    $errorMessage = "You are not currently associated with any vehicle.";
    // You can customize this message as needed.
    // exit(); // You may or may not need to exit here depending on your flow.
}

// Process the form submission to toggle the is_done status
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['toggle_is_done'])) {
    $scheduleIdToToggle = $_POST['toggle_is_done'];

    // Toggle the is_done status
    $toggleIsDoneQuery = "UPDATE TravelSchedule SET is_done = 1 - is_done WHERE id = '$scheduleIdToToggle'";
    if (mysqli_query($conn, $toggleIsDoneQuery)) {
        // Success message
        // You may want to refresh the page or redirect to update the displayed schedule list
        $successMessage = "Is Done status toggled successfully!";
    } else {
        // Error message
        $errorMessage = "Error toggling Is Done status: " . mysqli_error($conn);
    }
}

// Retrieve all travel schedules associated with the driver's vehicle along with remaining seats count
$schedulesQuery = "SELECT ts.*, s.name AS sacco_name,
                        v.capacity - COUNT(t.seat_number) AS remaining_seats
                  FROM TravelSchedule ts
                  INNER JOIN Vehicle v ON ts.vehicle_id = v.id
                  LEFT JOIN Ticket t ON ts.id = t.travel_schedule_id
                  LEFT JOIN Sacco s ON v.sacco_id = s.id
                  WHERE v.driver_id = '{$driverId}'
                  GROUP BY ts.id";

$schedulesResult = mysqli_query($conn, $schedulesQuery);

// Check for errors in the query
if (!$schedulesResult) {
    die("Error fetching travel schedules: " . mysqli_error($conn));
}
?>

<div class="container mt-4">
    <!-- Error Messages -->
    <?php if (isset($errorMessage) && !empty($errorMessage)) : ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?php echo $errorMessage; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <!-- Success Messages -->
    <?php if (isset($successMessage) && !empty($successMessage)) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo $successMessage; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <h2>Driver Dashboard</h2>

    <p class="lead">Welcome, <?php echo $driverInfo['first_name'] . ' ' . $driverInfo['last_name']; ?>!</p>

    <h3>Your Vehicle Information:</h3>
    <ul class="list-group">
        <li class="list-group-item">Make: <?php echo $driverInfo['make']; ?></li>
        <li class="list-group-item">Model: <?php echo $driverInfo['model']; ?></li>
        <li class="list-group-item">Registration Plate: <?php echo $driverInfo['registration_plate']; ?></li>
    </ul>

    <h3>Travel Schedules for Your Vehicle:</h3>
    <?php if (mysqli_num_rows($schedulesResult) > 0) : ?>
        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
            <tr>
                <th>Departure Location</th>
                <th>Destination</th>
                <th>Departure Time</th>
                <th>Price</th>
                <th>Sacco Name</th>
                <th>Remaining Seats</th>
                <th>Is Done</th>
                <th>Action</th>
                <th>View Bookings</th>
            </tr>
            </thead>
            <tbody>
            <?php while ($schedule = mysqli_fetch_assoc($schedulesResult)) : ?>
                <tr>
                    <td><?php echo $schedule['departure_location']; ?></td>
                    <td><?php echo $schedule['destination']; ?></td>
                    <td><?php echo $schedule['departure_time']; ?></td>
                    <td><?php echo $schedule['price']; ?></td>
                    <td><?php echo $schedule['sacco_name']; ?></td>
                    <td><?php echo $schedule['remaining_seats']; ?></td>
                    <td>
                        <?php echo $schedule['is_done'] ? 'Yes' : 'No'; ?>
                    </td>
                    <td>
                        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                            <input type="hidden" name="toggle_is_done" value="<?php echo $schedule['id']; ?>">
                            <input type="submit" class="btn btn-sm btn-<?php echo $schedule['is_done'] ? 'warning' : 'success'; ?>" value="<?php echo $schedule['is_done'] ? 'Mark as Not Done' : 'Mark as Done'; ?>">
                        </form>
                    </td>
                    <td>
                        <a href="view_bookings.php?schedule_id=<?php echo $schedule['id']; ?>" class="btn btn-sm btn-info">View Bookings</a>
                    </td>
                </tr>
            <?php endwhile; ?>
            </tbody>
        </table>
    <?php else : ?>
        <p>No travel schedules found for your vehicle.</p>
    <?php endif; ?>

    <!-- Logout link -->
    <a href="../auth/logout.php" class="btn btn-danger">Logout</a>

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
