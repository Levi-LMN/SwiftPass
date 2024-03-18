<?php
session_start();

// Set page title for the layout
$pageTitle = "View bookings";

// Content for the layout
ob_start();

// Check if the user is logged in
if (!isset($_SESSION["user"])) {
    // Redirect to the login page
    header("Location: login.php");
    exit();
}

// database connection
include '../auth/database.php';

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
    // error
    echo "You are not currently associated with any vehicle.";
    exit();
}

// Retrieve the schedule ID from the URL
$scheduleId = isset($_GET['schedule_id']) ? $_GET['schedule_id'] : null;

// Retrieve information about the selected schedule
$scheduleQuery = "SELECT ts.*, v.make AS vehicle_make, v.model AS vehicle_model, v.registration_plate AS vehicle_plate
                  FROM TravelSchedule ts
                  INNER JOIN Vehicle v ON ts.vehicle_id = v.id
                  WHERE ts.id = '$scheduleId'";

$scheduleResult = mysqli_query($conn, $scheduleQuery);

// Check for errors in the query
if (!$scheduleResult) {
    die("Error fetching schedule details: " . mysqli_error($conn));
}

// Fetch the schedule details
$scheduleDetails = mysqli_fetch_assoc($scheduleResult);

// Retrieve all tickets booked for the specified schedule
$bookingsQuery = "SELECT t.*, u.first_name, u.last_name
                  FROM Ticket t
                  INNER JOIN User u ON t.user_id = u.id
                  WHERE t.travel_schedule_id = '$scheduleId'";

$bookingsResult = mysqli_query($conn, $bookingsQuery);

// Check for errors in the query
if (!$bookingsResult) {
    die("Error fetching bookings: " . mysqli_error($conn));
}
?>

<h2>View Bookings for Schedule <?php echo $scheduleDetails['departure_location'] . ' to ' . $scheduleDetails['destination']; ?></h2>

<table>
    <tr>
        <td>Driver Information</td>
        <td>Driver: <?php echo $driverInfo['first_name'] . ' ' . $driverInfo['last_name']; ?></td>
    </tr>
</table>

<table>
    <tr>
        <td>Schedule Details</td>
        <td>Departure Location: <?php echo $scheduleDetails['departure_location']; ?></td>
        <td>Destination: <?php echo $scheduleDetails['destination']; ?></td>
        <td>Departure Time: <?php echo $scheduleDetails['departure_time']; ?></td>
        <td>Price: <?php echo $scheduleDetails['price']; ?></td>
        <td>Vehicle Make: <?php echo $scheduleDetails['vehicle_make']; ?></td>
        <td>Vehicle Model: <?php echo $scheduleDetails['vehicle_model']; ?></td>
        <td>Vehicle Plate: <?php echo $scheduleDetails['vehicle_plate']; ?></td>
    </tr>
</table>

<?php if (mysqli_num_rows($bookingsResult) > 0) : ?>
    <table>
        <tr>
            <td>Bookings</td>
        </tr>
        <tr>
            <th>Seat Number</th>
            <th>Passenger Name</th>
        </tr>
        <?php while ($booking = mysqli_fetch_assoc($bookingsResult)) : ?>
            <tr>
                <td><?php echo $booking['seat_number']; ?></td>
                <td><?php echo $booking['first_name'] . ' ' . $booking['last_name']; ?></td>
            </tr>
        <?php endwhile; ?>
    </table>
<?php else : ?>
    <p>No bookings found for this schedule.</p>
<?php endif; ?>

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
