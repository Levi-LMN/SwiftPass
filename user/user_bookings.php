<?php
// Set page title for the layout
$pageTitle = "User bookings Page";

// Content for the layout
ob_start();
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

<div class="container mt-5">
    <h1 class="mb-4">Your Bookings</h1>

    <?php
    if (mysqli_num_rows($bookingsResult) > 0) {
        // Group bookings by schedule
        $groupedBookings = [];
        while ($booking = mysqli_fetch_assoc($bookingsResult)) {
            $scheduleId = $booking['travel_schedule_id'];

            // Fetch departure location and destination from travelschedule table
            $scheduleQuery = "SELECT departure_location, destination, departure_time FROM travelschedule WHERE id = $scheduleId";
            $scheduleResult = mysqli_query($conn, $scheduleQuery);
            $scheduleData = mysqli_fetch_assoc($scheduleResult);

            $booking['departure_location'] = $scheduleData['departure_location'] ?? 'N/A';
            $booking['destination'] = $scheduleData['destination'] ?? 'N/A';

            $groupedBookings[$booking['departure_time']][] = $booking;
        }

        // Display each group
        foreach ($groupedBookings as $schedule => $bookings) {
            $formattedSchedule = date("l jS F Y g:i A", strtotime($schedule));

            echo "<div class='mb-4'>";
            echo "<h2 class='mb-3'>Schedule: $formattedSchedule</h2>";
            echo "<p class='mb-3'>From: {$bookings[0]['departure_location']} | To: {$bookings[0]['destination']}</p>";

            $counter = 0; // Counter for tracking the number of bookings in the current row

            echo "<div class='row'>";

            foreach ($bookings as $booking) {
                echo "<div class='col-md-4 mb-4'>";
                echo "<div class='card h-100 shadow border-primary'>";
                echo "<div class='card-body'>";
                echo "<h5 class='card-title font-weight-bold mb-3'>Ticket Number: {$booking['ticket_number']}</h5>";
                echo "<ul class='list-unstyled'>";
                echo "<li>Departure Time: {$booking['departure_time']}</li>";
                echo "<li>Vehicle: {$booking['make']} {$booking['model']}</li>";
                echo "<li>Sacco: {$booking['sacco_name']}</li>";
                echo "<li>Seat Number: {$booking['seat_number']}</li>";
                echo "<li>Price: {$booking['price']}</li>";
                echo "</ul>";
                echo "</div>";
                echo "</div>";
                echo "</div>";

                // End the row for every third booking
                if ($counter % 3 == 2 || $counter == count($bookings) - 1) {
                    echo "</div>"; // Close the row
                    echo "<div class='row'>"; // Start a new row
                }

                $counter++;
            }

            echo "</div>"; // Close the div containing the schedule
            echo "</div>"; // Close the div for each schedule
        }
    } else {
        echo "<p>No bookings found.</p>";
    }
    ?>
</div>





<!-- Add any additional content or links here -->
<?php
// Get the buffered content and assign it to $content
$pageContent = ob_get_clean();

// Include the layout
include('../layout.php');
?>
