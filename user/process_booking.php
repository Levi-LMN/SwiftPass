<?php
// Include your database connection code here
include '../auth/database.php'; // Update with your actual database connection file

// Check if the user is logged in
session_start();
if (!isset($_SESSION['user'])) {
    // Redirect or display an error if the user is not logged in
    echo "You are not logged in.";
    exit();
}

// Check if the required form fields are submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['schedule_id']) && isset($_POST['seats'])) {
    $userId = $_SESSION['user']['id'];
    $scheduleId = $_POST['schedule_id'];
    $selectedSeats = $_POST['seats'];

    // Generate a random ticket number
    $ticketNumber = generateTicketNumber();

    // Retrieve schedule details from the database
    $scheduleQuery = "SELECT ts.*, v.make, v.model, s.name AS sacco_name
                      FROM TravelSchedule ts
                      INNER JOIN Vehicle v ON ts.vehicle_id = v.id
                      INNER JOIN Sacco s ON v.sacco_id = s.id
                      WHERE ts.id = '$scheduleId'";
    $scheduleResult = mysqli_query($conn, $scheduleQuery);

    // Check for errors in the query
    if (!$scheduleResult) {
        echo "Error fetching schedule details: " . mysqli_error($conn);
        echo "<br>Query: $scheduleQuery";
        exit();
    }

    // Fetch schedule details
    $scheduleDetails = mysqli_fetch_assoc($scheduleResult);

    // Calculate total price based on the number of selected seats
    $totalPrice = $scheduleDetails['price'] * count(explode(',', $selectedSeats));

// Insert booking details into the Ticket table
    $insertTicketQuery = "INSERT INTO Ticket (ticket_number, user_id, travel_schedule_id, seat_number, price)
                      VALUES ('$ticketNumber', '$userId', '$scheduleId', '$selectedSeats', '$totalPrice')";

    if (mysqli_query($conn, $insertTicketQuery)) {
        echo "Booking successful! Your ticket number is: $ticketNumber";
        // Additional actions after successful booking (e.g., redirect, send confirmation email)
    } else {
        echo "Error booking: " . mysqli_error($conn);
    }
} else {
    // Redirect or display an error if the required form fields are not submitted
    echo "Invalid request.";
}

// Function to generate a random ticket number
function generateTicketNumber() {
    return strtoupper(bin2hex(random_bytes(5)));
}
?>
