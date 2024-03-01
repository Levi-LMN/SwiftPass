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

// Check if the required form fields are submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['schedule_id']) && isset($_POST['seats'])) {
    $userId = $_SESSION['user']['id'];
    $scheduleId = $_POST['schedule_id'];
    $selectedSeats = explode(',', $_POST['seats']);

    // Initialize total price
    $totalPrice = 0;

    // Initialize an array to store already booked seats
    $alreadyBookedSeats = [];

    // Initialize an array to store booked ticket details
    $bookedTicketDetails = [];

    // Insert each selected seat into the Ticket table
    foreach ($selectedSeats as $seat) {
        // Check if the seat is already booked
        $checkBookingQuery = "SELECT * FROM Ticket WHERE travel_schedule_id = '$scheduleId' AND seat_number = '$seat'";
        $checkBookingResult = mysqli_query($conn, $checkBookingQuery);

        if (mysqli_num_rows($checkBookingResult) > 0) {
            // Seat is already booked, add it to the already booked seats array
            $alreadyBookedSeats[] = $seat;
            continue; // Skip the current iteration and move to the next seat
        }

        // Generate a unique ticket number for each seat
        $ticketNumber = generateUniqueTicketNumber($conn);

        // Retrieve schedule details from the database
        $scheduleQuery = "SELECT ts.*, v.make, v.model, s.name AS sacco_name
                          FROM TravelSchedule ts
                          INNER JOIN Vehicle v ON ts.vehicle_id = v.id
                          INNER JOIN Sacco s ON v.sacco_id = s.id
                          WHERE ts.id = '$scheduleId'";
        $scheduleResult = mysqli_query($conn, $scheduleQuery);

        // Check for errors in the query
        if (!$scheduleResult) {
            $errorMessage = "Error fetching schedule details: " . mysqli_error($conn);
            header("Location: error.php?message=$errorMessage");
            exit();
        }

        // Fetch schedule details
        $scheduleDetails = mysqli_fetch_assoc($scheduleResult);

        // Calculate the price for each seat
        $seatPrice = $scheduleDetails['price'];

        // Insert booking details into the Ticket table for each seat
        $insertTicketQuery = "INSERT INTO Ticket (ticket_number, user_id, travel_schedule_id, seat_number, price)
                              VALUES ('$ticketNumber', '$userId', '$scheduleId', '$seat', '$seatPrice')";

        if (mysqli_query($conn, $insertTicketQuery)) {
            // Increment total price for each seat
            $totalPrice += $seatPrice;

            // Store booked ticket details
            $bookedTicketDetails[] = "Seat $seat: Ticket Number - $ticketNumber, Price - $seatPrice";
        } else {
            $errorMessage = "Error booking for seat $seat: " . mysqli_error($conn);
            header("Location: error.php?message=$errorMessage");
            exit();
        }
    }

    // Redirect to the result page
    $resultMessage = '';
    if (!empty($alreadyBookedSeats)) {
        $resultMessage = "The following seats are already booked: " . implode(', ', $alreadyBookedSeats);
    } else {
        $resultMessage = "Booking successful! Your total ticket price is: $totalPrice. Details: " . implode(', ', $bookedTicketDetails);

        // Additional actions after successful booking (e.g., redirect, send confirmation email)
        $email = $_SESSION['user']['email'];
        // TODO: Send the ticket details to the user's email (implement this part)
        // mail($email, 'Ticket Booking Confirmation', $resultMessage);
    }
    header("Location: result.php?message=$resultMessage");
} else {
    // Redirect or display an error if the required form fields are not submitted
    $errorMessage = "Invalid request.";
    header("Location: error.php?message=$errorMessage");
}

// Function to generate a unique random ticket number
function generateUniqueTicketNumber($conn) {
    do {
        $ticketNumber = generateTicketNumber();
        $checkQuery = "SELECT ticket_number FROM Ticket WHERE ticket_number = '$ticketNumber'";
        $checkResult = mysqli_query($conn, $checkQuery);

        if (!$checkResult) {
            $errorMessage = "Error checking ticket number uniqueness: " . mysqli_error($conn);
            header("Location: error.php?message=$errorMessage");
            exit();
        }

        $row = mysqli_fetch_assoc($checkResult);
    } while ($row);

    return $ticketNumber;
}

// Function to generate a random ticket number
function generateTicketNumber() {
    return strtoupper(bin2hex(random_bytes(5)));
}
?>
