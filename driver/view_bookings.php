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


<div class="container mt-4">
    <h2>View Bookings for Schedule <?php echo $scheduleDetails['departure_location'] . ' to ' . $scheduleDetails['destination']; ?></h2>

    <div class="row">
        <div class="col-lg-4 mb-4">
            <div class="card h-100 shadow">
                <div class="card-header bg-primary text-white">
                    <h3 class="card-title">Driver Information</h3>
                </div>
                <div class="card-body">
                    <p class="lead">Driver: <?php echo $driverInfo['first_name'] . ' ' . $driverInfo['last_name']; ?></p>
                </div>
            </div>
        </div>

        <div class="col-lg-4 mb-4">
            <div class="card h-100 shadow">
                <div class="card-header bg-success text-white">
                    <h3 class="card-title">Schedule Details</h3>
                </div>
                <div class="card-body">
                    <p class="card-text">Departure Location: <?php echo $scheduleDetails['departure_location']; ?></p>
                    <p class="card-text">Destination: <?php echo $scheduleDetails['destination']; ?></p>
                    <p class="card-text">Departure Time: <?php echo $scheduleDetails['departure_time']; ?></p>
                    <p class="card-text">Price: <?php echo $scheduleDetails['price']; ?></p>
                    <p class="card-text">Vehicle Make: <?php echo $scheduleDetails['vehicle_make']; ?></p>
                    <p class="card-text">Vehicle Model: <?php echo $scheduleDetails['vehicle_model']; ?></p>
                    <p class="card-text">Vehicle Plate: <?php echo $scheduleDetails['vehicle_plate']; ?></p>
                </div>
            </div>
        </div>

        <div class="col-lg-4 mb-4">
            <?php if (mysqli_num_rows($bookingsResult) > 0) : ?>
                <div class="card h-100 shadow">
                    <div class="card-header bg-info text-white">
                        <h3 class="card-title">Bookings</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead class="thead-dark">
                                <tr>
                                    <th>Seat Number</th>
                                    <th>Passenger Name</th>
                                    <!-- Add more columns based on your requirements -->
                                </tr>
                                </thead>
                                <tbody>
                                <?php while ($booking = mysqli_fetch_assoc($bookingsResult)) : ?>
                                    <tr>
                                        <td><?php echo $booking['seat_number']; ?></td>
                                        <td><?php echo $booking['first_name'] . ' ' . $booking['last_name']; ?></td>
                                        <!-- Add more columns based on your requirements -->
                                    </tr>
                                <?php endwhile; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            <?php else : ?>
                <div class="alert alert-warning" role="alert">
                    No bookings found for this schedule.
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Link back to the driver dashboard -->
    <a href="driver_dashboard.php" class="btn btn-primary mt-4">Back to Driver Dashboard</a>
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
