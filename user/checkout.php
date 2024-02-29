<?php
// Include your database connection code here
include '../auth/database.php'; // Update with your actual database connection file

// Check if the schedule ID and selected seats are provided in the query parameters
if (!isset($_GET['schedule_id']) || !is_numeric($_GET['schedule_id']) || !isset($_GET['seats'])) {
    // Redirect or display an error if the parameters are not provided or not valid
    echo "Invalid or missing parameters.";
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
$selectedSeats = $_GET['seats'];

// Validate the schedule ID
if (!filter_var($scheduleId, FILTER_VALIDATE_INT)) {
    echo "Invalid schedule ID.";
    exit();
}

// Retrieve schedule details from the database
$scheduleQuery = "SELECT ts.*, v.make, v.model, v.capacity, s.name AS sacco_name
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

// Calculate total price based on the number of selected seats
$totalPrice = $scheduleDetails['price'] * count(explode(',', $selectedSeats));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout Page</title>
</head>
<body>
<h2>Checkout</h2>

<?php if ($scheduleDetails) : ?>
    <h3>Schedule Details</h3>
    <p><strong>Departure Location:</strong> <?php echo $scheduleDetails['departure_location']; ?></p>
    <p><strong>Destination:</strong> <?php echo $scheduleDetails['destination']; ?></p>
    <p><strong>Departure Time:</strong> <?php echo $scheduleDetails['departure_time']; ?></p>
    <p><strong>Price per Seat:</strong> <?php echo $scheduleDetails['price']; ?></p>
    <p><strong>Vehicle Make:</strong> <?php echo $scheduleDetails['make']; ?></p>
    <p><strong>Vehicle Model:</strong> <?php echo $scheduleDetails['model']; ?></p>
    <p><strong>Vehicle Capacity:</strong> <?php echo $scheduleDetails['capacity']; ?></p>
    <p><strong>Sacco Name:</strong> <?php echo $scheduleDetails['sacco_name']; ?></p>

    <h3>Selected Seats</h3>
    <p><?php echo ($selectedSeats ? 'Seats: ' . $selectedSeats : 'No seats selected.'); ?></p>

    <h3>Total Price</h3>
    <p><?php echo ($totalPrice ? 'Total Price: $' . $totalPrice : 'No total price calculated.'); ?></p>

    <!-- Add payment form or any additional content here -->
    <form method="post" action="process_booking.php">
        <!-- Additional form fields (e.g., payment information) can be added here -->
        <input type="hidden" name="schedule_id" value="<?php echo $scheduleDetails['id']; ?>">
        <input type="hidden" name="seats" value="<?php echo $selectedSeats; ?>">
        <input type="submit" value="Book Now">
    </form>

<?php else : ?>
    <p>No details found for the provided schedule ID.</p>
<?php endif; ?>

<!--back to ticketing page or any other desired page-->
<a href="ticketing.php?schedule_id=<?php echo $scheduleDetails['id']; ?>">Back to Ticketing</a>
</body>
</html>
