<?php
// Set page title for the layout
$pageTitle = "Booking details";

// Content for the layout
ob_start();


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

<div class="container mt-4">
    <div class="row">
        <div class="col-md-6">

            <?php if ($scheduleDetails) : ?>

                <!-- Schedule Details Card -->
                <div class="card">
                    <div class="card-header">
                        <h2>Schedule Details</h2>
                    </div>
                    <div class="card-body">
                        <!-- Your schedule details content here -->
                        <p><strong>Departure Location:</strong> <?php echo $scheduleDetails['departure_location']; ?></p>
                        <p><strong>Destination:</strong> <?php echo $scheduleDetails['destination']; ?></p>
                        <p><strong>Departure Time:</strong> <?php echo $scheduleDetails['departure_time']; ?></p>
                        <p><strong>Price:</strong> <?php echo $scheduleDetails['price']; ?></p>
                        <p><strong>Vehicle Make:</strong> <?php echo $scheduleDetails['make']; ?></p>
                        <p><strong>Vehicle Model:</strong> <?php echo $scheduleDetails['model']; ?></p>
                        <p><strong>Capacity:</strong> <?php echo $scheduleDetails['capacity']; ?></p>
                        <p><strong>Sacco Name:</strong> <?php echo $scheduleDetails['sacco_name']; ?></p>
                    </div>
                </div>

            <?php else : ?>

                <!-- No Details Found Card -->
                <div class="card">
                    <div class="card-body">
                        <p>No details found for the provided schedule ID.</p>
                    </div>
                </div>

            <?php endif; ?>

        </div>

        <div class="col-md-6">

            <!-- Select Your Seat Card -->
            <div class="card mt-4">
                <div class="card-header">
                    <h2>Select Your Seat</h2>
                </div>
                <div class="card-body">
                    <!-- Your seat selection form here -->
                    <form action="" method="post">
                        <div>
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
                        </div>

                        <!-- Add the remaining code as before -->
                    </form>
                </div>
            </div>

            <!-- Remaining Seats Card -->
            <div class="card mt-4">
                <div class="card-header">
                    <h2>Remaining Seats</h2>
                </div>
                <div class="card-body">
                    <p id="remainingSeats">Remaining Seats: <?php echo $remainingSeats; ?></p>
                </div>
            </div>

            <!-- Selected Seats Card -->
            <div class="card mt-4">
                <div class="card-header">
                    <h2>Selected Seats</h2>
                </div>
                <div class="card-body" id="selectedSeats"></div>
                <div class="container mt-3">
                    <div class="row justify-content-center">
                        <div class="col-6">
                            <!-- Add the checkout link and any additional content here -->
                            <a href="checkout.php?schedule_id=<?php echo $scheduleDetails['id']; ?>&seats=" id="checkoutLink" class="btn btn-primary" style="display: none;">Proceed to Checkout</a>
                        </div>
                    </div>
                </div>

            </div>









        </div>
    </div>

    <!-- Back to view all schedules link -->
    <div class="row mt-4">
        <div class="col-md-12">
            <a href="view_all_schedules.php">Back to View All Schedules</a>
        </div>
    </div>
</div>

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


<?php
// Get the buffered content and assign it to $content
$pageContent = ob_get_clean();

// Include the layout
include('../layout.php');
?>
