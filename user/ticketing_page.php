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

// Fetch originally booked seats
$initialBookedSeats = [];
while ($row = mysqli_fetch_assoc($bookedSeatsResult)) {
    $initialBookedSeats[] = $row['seat_number'];
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

// Calculate remaining seats based on the originally booked seats
$remainingSeats = $scheduleDetails['capacity'] - count($initialBookedSeats);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticketing Page</title>
    <style>
        /* Your existing CSS styles */
    </style>
</head>

<body>
<h2>Select Your Seat</h2>

<?php if ($scheduleDetails) : ?>
    <h3>Schedule Details</h3>
    <!-- Display schedule details as before -->

    <h3>Select Your Seat</h3>
    <form action="" method="post">
        <label for="seatSelect">Choose a Seat:</label>
        <select name="selectedSeat" id="seatSelect">
            <!-- Placeholder option -->
            <option value="" disabled selected>Select Seats</option>

            <?php
            // Assume the seats are labeled from 1 to the vehicle's capacity
            for ($seat = 1; $seat <= $scheduleDetails['capacity']; $seat++) {
                // Check if the seat is originally booked
                if (in_array($seat, $initialBookedSeats)) {
                    echo '<option value="' . $seat . '" disabled>Booked - Seat ' . $seat . '</option>';
                } else {
                    echo '<option value="' . $seat . '">Seat ' . $seat . '</option>';
                }
            }
            ?>
        </select>
        <!-- Add the remaining code as before -->
    </form>


<?php else : ?>
    <p>No details found for the provided schedule ID.</p>
<?php endif; ?>

<!-- Your additional content here -->
<h3>Selected Seats</h3>
<div id="selectedSeats"></div>

<!-- Display the remaining seats -->
<h3>Remaining Seats</h3>
<p id="remainingSeats">
    <?php
    echo "Remaining Seats: $remainingSeats";
    ?>
</p>

<!-- Add the checkout link and any additional content here -->
<a href="checkout.php?schedule_id=<?php echo $scheduleDetails['id']; ?>&seats=" id="checkoutLink" style="display: none;">Proceed to Checkout</a>

<script>
    // JavaScript to handle seat selection
    document.addEventListener('DOMContentLoaded', function () {
        var seatSelect = document.getElementById('seatSelect');
        var selectedSeatsContainer = document.getElementById('selectedSeats');
        var checkoutLink = document.getElementById('checkoutLink');
        var remainingSeatsContainer = document.getElementById('remainingSeats');
        var selectedSeats = [];

        var remainingSeats = <?php echo $remainingSeats; ?>;

        seatSelect.addEventListener('change', function () {
            updateSelectedSeats();
            updateCheckoutLinkVisibility();
        });

        function updateSelectedSeats() {
            var selectedSeat = seatSelect.value;

            if (selectedSeat) {
                selectedSeats.push(selectedSeat);
            }

            selectedSeatsContainer.innerText = 'Selected Seats: ' + (selectedSeats.length > 0 ? selectedSeats.join(', ') : 'None');

            // Update the checkout link with the selected seats
            checkoutLink.href = 'checkout.php?schedule_id=<?php echo $scheduleDetails['id']; ?>&seats=' + encodeURIComponent(selectedSeats.join(','));

            // Update the remaining seats
            remainingSeats = remainingSeats - 1;
            remainingSeatsContainer.innerText = 'Remaining Seats: ' + remainingSeats;
        }

        function updateCheckoutLinkVisibility() {
            var selectedSeat = seatSelect.value;
            checkoutLink.style.display = selectedSeat ? 'block' : 'none';
        }
    });
</script>
</body>

</html>
