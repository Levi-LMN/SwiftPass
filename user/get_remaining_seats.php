<?php
include '../auth/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['schedule_id'])) {
    $scheduleId = $_GET['schedule_id'];

    $bookedSeatsQuery = "SELECT COUNT(*) as booked_seats FROM Ticket WHERE travel_schedule_id = '$scheduleId'";
    $bookedSeatsResult = mysqli_query($conn, $bookedSeatsQuery);

    if (!$bookedSeatsResult) {
        $error = mysqli_error($conn);
        echo json_encode(['error' => "Error fetching booked seats: $error"]);
        exit();
    }

    $bookedSeatsCount = mysqli_fetch_assoc($bookedSeatsResult)['booked_seats'];
    $remainingSeats = max(0, $scheduleDetails['capacity'] - $bookedSeatsCount);

    echo json_encode(['remaining_seats' => $remainingSeats]);
} else {
    echo json_encode(['error' => 'Invalid request']);
}
