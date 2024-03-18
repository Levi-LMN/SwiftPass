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

<div>
    <?php if ($scheduleDetails) : ?>
        <div>
            <div>
                <div>
                    <div>
                        <h3>Schedule Details</h3>
                    </div>
                    <div>
                        <p><strong>Departure Location:</strong> <?php echo $scheduleDetails['departure_location']; ?></p>
                        <p><strong>Destination:</strong> <?php echo $scheduleDetails['destination']; ?></p>
                        <p><strong>Departure Time:</strong> <?php echo $scheduleDetails['departure_time']; ?></p>
                        <p><strong>Price:</strong> <?php echo $scheduleDetails['price']; ?></p>
                        <p><strong>Vehicle Make:</strong> <?php echo $scheduleDetails['make']; ?></p>
                        <p><strong>Vehicle Model:</strong> <?php echo $scheduleDetails['model']; ?></p>
                        <p><strong>Vehicle Number Plate:</strong> <?php echo $scheduleDetails['registration_plate']; ?></p>
                        <p><strong>Sacco Name:</strong> <?php echo $scheduleDetails['sacco_name']; ?></p>
                    </div>
                </div>
            </div>

            <div>
                <div>
                    <div>
                        <h3>User Details</h3>
                    </div>
                    <div>
                        <p><strong>User ID:</strong> <?php echo $_SESSION['user']['id']; ?></p>
                        <p><strong>User Name:</strong> <?php echo $_SESSION['user']['first_name'] . ' ' . $_SESSION['user']['last_name']; ?></p>
                        <p><strong>User Email:</strong> <?php echo $_SESSION['user']['email']; ?></p>
                        <!-- Add booking form or any additional content here -->
                        <!-- Link to go to the ticketing page -->
                        <a href="ticketing_page.php?schedule_id=<?php echo $scheduleDetails['id']; ?>">Go to Ticketing Page</a>
                    </div>
                </div>
            </div>
        </div>

    <?php else : ?>
        <p>No details found for the provided schedule ID.</p>
    <?php endif; ?>
    <!-- Back to view all schedules page or any other desired page -->
    <a href="schedules.php">Back to View All Schedules</a>
</div>

<?php
// Get the buffered content and assign it to $content
$pageContent = ob_get_clean();

// Include the layout
include('../layout.php');
?>
