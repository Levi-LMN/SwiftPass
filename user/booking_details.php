<?php
// Set page title for the layout
$pageTitle = "Booking details";

// Content for the layout
ob_start();
// db connect
include '../auth/database.php';

// Check if the schedule ID is provided in the query parameters
if (!isset($_GET['schedule_id']) || !is_numeric($_GET['schedule_id'])) {
    // Redirect or display an error if the schedule ID is not provided or not valid
    echo "Invalid or missing schedule ID.";
    exit();
}

// Check if the user is logged in
session_start();
if (!isset($_SESSION['user'])) {
    // Redirect or display an error if the user is not logged in
    echo "You are not logged in.";
    exit();
}

$scheduleId = $_GET['schedule_id'];

// Retrieve schedule details from the database
$scheduleQuery = "SELECT ts.*, v.make, v.model, v.registration_plate, s.name AS sacco_name
                  FROM TravelSchedule ts
                  INNER JOIN Vehicle v ON ts.vehicle_id = v.id
                  INNER JOIN Sacco s ON v.sacco_id = s.id
                  WHERE ts.id = '$scheduleId'";
$scheduleResult = mysqli_query($conn, $scheduleQuery);

// Check for errors in the query
if (!$scheduleResult) {
    echo "Error fetching schedule details: " . mysqli_error($conn);
    echo "<br>Query: $scheduleQuery";
}

// Fetch schedule details
$scheduleDetails = mysqli_fetch_assoc($scheduleResult);
?>

<div class="container mt-5">
    <?php if ($scheduleDetails) : ?>
        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h3 class="mb-0">Schedule Details</h3>
                    </div>
                    <div class="card-body">
                        <p class="card-text"><strong>Departure Location:</strong> <?php echo $scheduleDetails['departure_location']; ?></p>
                        <p class="card-text"><strong>Destination:</strong> <?php echo $scheduleDetails['destination']; ?></p>
                        <p class="card-text"><strong>Departure Time:</strong> <?php echo $scheduleDetails['departure_time']; ?></p>
                        <p class="card-text"><strong>Price:</strong> <?php echo $scheduleDetails['price']; ?></p>
                        <p class="card-text"><strong>Vehicle Make:</strong> <?php echo $scheduleDetails['make']; ?></p>
                        <p class="card-text"><strong>Vehicle Model:</strong> <?php echo $scheduleDetails['model']; ?></p>
                        <p class="card-text"><strong>Vehicle Number Plate:</strong> <?php echo $scheduleDetails['registration_plate']; ?></p>
                        <p class="card-text"><strong>Sacco Name:</strong> <?php echo $scheduleDetails['sacco_name']; ?></p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-header bg-success text-white">
                        <h3 class="mb-0">User Details</h3>
                    </div>
                    <div class="card-body">
                        <p class="card-text"><strong>User ID:</strong> <?php echo $_SESSION['user']['id']; ?></p>
                        <p class="card-text"><strong>User Name:</strong> <?php echo $_SESSION['user']['first_name'] . ' ' . $_SESSION['user']['last_name']; ?></p>
                        <p class="card-text"><strong>User Email:</strong> <?php echo $_SESSION['user']['email']; ?></p>
                        <!-- Add booking form or any additional content here -->
                        <!-- Link to go to the ticketing page -->
                        <a class="btn btn-primary" href="ticketing_page.php?schedule_id=<?php echo $scheduleDetails['id']; ?>">Go to Ticketing Page</a>
                    </div>
                </div>
            </div>
        </div>

    <?php else : ?>
        <p class="alert alert-warning">No details found for the provided schedule ID.</p>
    <?php endif; ?>
    <!-- Back to view all schedules page or any other desired page -->
    <a class="btn btn-secondary" href="schedules.php">Back to View All Schedules</a>
</div>

<?php
// Get the buffered content and assign it to $content
$pageContent = ob_get_clean();

// Include the layout
include('../layout.php');
?>
