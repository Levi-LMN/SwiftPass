<?php
// Include your database connection code here
include '../auth/database.php'; // Update with your actual database connection file

// Check if the user is logged in
session_start();
if (!isset($_SESSION['user'])) {
    // Redirect or display an error if the user is not logged in
    header("Location: error.php?message=You are not logged in.");
    exit();
}

// Get the user ID from the session
$userId = $_SESSION['user']['id'];

// Retrieve the user's bookings from the Ticket table
$bookingsQuery = "SELECT t.*, ts.departure_time, v.make, v.model, s.name AS sacco_name
                  FROM Ticket t
                  INNER JOIN TravelSchedule ts ON t.travel_schedule_id = ts.id
                  INNER JOIN Vehicle v ON ts.vehicle_id = v.id
                  INNER JOIN Sacco s ON v.sacco_id = s.id
                  WHERE t.user_id = '$userId'
                  ORDER BY ts.departure_time ASC";

$bookingsResult = mysqli_query($conn, $bookingsQuery);

// Check for errors in the query
if (!$bookingsResult) {
    $errorMessage = "Error fetching bookings: " . mysqli_error($conn);
    header("Location: error.php?message=$errorMessage");
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Bookings</title>
    <!-- Add any additional styles or meta tags here -->
</head>
<body>
<h1>Your Bookings</h1>

<?php
if (mysqli_num_rows($bookingsResult) > 0) {
    // Display the user's bookings
    while ($booking = mysqli_fetch_assoc($bookingsResult)) {
        echo "<p>";
        echo "Ticket Number: {$booking['ticket_number']}<br>";
        echo "Departure Time: {$booking['departure_time']}<br>";
        echo "Vehicle: {$booking['make']} {$booking['model']}<br>";
        echo "Sacco: {$booking['sacco_name']}<br>";
        echo "Seat Number: {$booking['seat_number']}<br>";
        echo "Price: {$booking['price']}<br>";
        echo "</p>";
    }
} else {
    echo "<p>No bookings found.</p>";
}
?>

<!-- Add any additional content or links here -->

</body>
</html>
