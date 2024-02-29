<?php
// Include your database connection code here
include '../auth/database.php'; // Update with your actual database connection file

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

// Retrieve booked seats for the specific schedule
$bookedSeatsQuery = "SELECT seat_number FROM Ticket WHERE travel_schedule_id = '$scheduleId'";
$bookedSeatsResult = mysqli_query($conn, $bookedSeatsQuery);

// Check for errors in the query
if (!$bookedSeatsResult) {
    echo "Error fetching booked seats: " . mysqli_error($conn);
    echo "<br>Query: $bookedSeatsQuery";
    exit();
}

// Fetch booked seats
$bookedSeats = [];
while ($row = mysqli_fetch_assoc($bookedSeatsResult)) {
    $bookedSeats[] = $row['seat_number'];
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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticketing Page</title>
    <style>
        .seat {
            width: 40px;
            height: 40px;
            margin: 5px;
            display: inline-block;
            border: 1px solid #ccc;
            text-align: center;
            line-height: 40px;
            cursor: pointer;
        }

        .selected {
            background-color: #3498db;
            color: #fff;
        }

        .booked {
            background-color: #e74c3c;
            color: #fff;
        }
    </style>
</head>
<body>
<h2>Select Your Seat</h2>

<?php if ($scheduleDetails) : ?>
    <h3>Schedule Details</h3>
    <p><strong>Departure Location:</strong> <?php echo $scheduleDetails['departure_location']; ?></p>
    <p><strong>Destination:</strong> <?php echo $scheduleDetails['destination']; ?></p>
    <p><strong>Departure Time:</strong> <?php echo $scheduleDetails['departure_time']; ?></p>
    <p><strong>Price:</strong> <?php echo $scheduleDetails['price']; ?></p>
    <p><strong>Vehicle Make:</strong> <?php echo $scheduleDetails['make']; ?></p>
    <p><strong>Vehicle Model:</strong> <?php echo $scheduleDetails['model']; ?></p>
    <p><strong>Vehicle Capacity:</strong> <?php echo $scheduleDetails['capacity']; ?></p>
    <p><strong>Sacco Name:</strong> <?php echo $scheduleDetails['sacco_name']; ?></p>

    <h3>Already Booked Seats</h3>
    <div id="bookedSeats">
        <?php
        foreach ($bookedSeats as $bookedSeat) {
            echo '<div class="seat booked">' . $bookedSeat . '</div>';
        }
        ?>
    </div>

    <h3>Select Your Seat</h3>
    <div id="seatMap">
        <?php
        // Assume the seats are labeled from 1 to the vehicle's capacity
        for ($seat = 1; $seat <= $scheduleDetails['capacity']; $seat++) {
            // Check if the seat is not booked
            $isBooked = in_array($seat, $bookedSeats);
            $seatClass = $isBooked ? 'booked' : '';

            echo '<div class="seat ' . $seatClass . '" data-seat="' . $seat . '">' . $seat . '</div>';
        }
        ?>
    </div>

<?php else : ?>
    <p>No details found for the provided schedule ID.</p>
<?php endif; ?>

<!-- Your additional content here -->
<h3>Selected Seats</h3>
<div id="selectedSeats"></div>

<!-- Add the checkout link and any additional content here -->
<a href="checkout.php?schedule_id=<?php echo $scheduleDetails['id']; ?>&seats=" id="checkoutLink">Proceed to Checkout</a>

<script>
    // JavaScript to handle seat selection
    document.addEventListener('DOMContentLoaded', function () {
        var seats = document.querySelectorAll('.seat');
        var selectedSeatsContainer = document.getElementById('selectedSeats');

        seats.forEach(function (seat) {
            seat.addEventListener('click', function () {
                this.classList.toggle('selected');
                updateSelectedSeats();
            });
        });

        function updateSelectedSeats() {
            var selectedSeats = document.querySelectorAll('.seat.selected');
            var selectedSeatsText = Array.from(selectedSeats).map(function (seat) {
                return seat.dataset.seat;
            }).join(', ');

            selectedSeatsContainer.innerText = 'Selected Seats: ' + (selectedSeatsText || 'None');
        }
    });
</script>
</body>
</html>
