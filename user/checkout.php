<?php
// Set page title for the layout
$pageTitle = "Checkout Page";

// Content for the layout
ob_start();

// database connection
include '../auth/database.php';

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




<div class="container mt-5">
    <div class="row">
        <div class="col-md-6 mb-4">
            <?php if ($scheduleDetails) : ?>
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h3>Schedule Details</h3>
                    </div>
                    <div class="card-body">
                        <p><strong>Departure Location:</strong> <?php echo $scheduleDetails['departure_location']; ?></p>
                        <p><strong>Destination:</strong> <?php echo $scheduleDetails['destination']; ?></p>
                        <p><strong>Departure Time:</strong> <?php echo $scheduleDetails['departure_time']; ?></p>
                        <p><strong>Price per Seat:</strong> <?php echo $scheduleDetails['price']; ?></p>
                        <p><strong>Vehicle Make:</strong> <?php echo $scheduleDetails['make']; ?></p>
                        <p><strong>Vehicle Model:</strong> <?php echo $scheduleDetails['model']; ?></p>
                        <p><strong>Vehicle Capacity:</strong> <?php echo $scheduleDetails['capacity']; ?></p>
                        <p><strong>Sacco Name:</strong> <?php echo $scheduleDetails['sacco_name']; ?></p>
                    </div>
                </div>
            <?php else : ?>
                <div class="alert alert-warning">No details found for the provided schedule ID.</div>
            <?php endif; ?>
        </div>

        <div class="col-md-6 mb-4">
            <?php if ($scheduleDetails) : ?>
                <div class="card">
                    <div class="card-header bg-success text-white">
                        <h3>Selected Seats</h3>
                    </div>
                    <div class="card-body">
                        <p><?php echo ($selectedSeats ? 'Seats: ' . $selectedSeats : 'No seats selected.'); ?></p>
                    </div>
                </div>

                <div class="card mt-4">
                    <div class="card-header bg-info text-white">
                        <h3>Total Price</h3>
                    </div>
                    <div class="card-body">
                        <p><?php echo ($totalPrice ? 'Total Price: $' . $totalPrice : 'No total price calculated.'); ?></p>
                    </div>
                </div>

                <div class="mt-4">
                    <!-- Add payment form or any additional content here -->
                    <form method="post" action="process_booking.php">
                        <!-- Additional form fields (e.g., payment information) can be added here -->
                        <input type="hidden" name="schedule_id" value="<?php echo $scheduleDetails['id']; ?>">
                        <input type="hidden" name="seats" value="<?php echo $selectedSeats; ?>">
<!--                        <input type="submit" class="btn btn-primary mt-3" value="Book Now">-->
                    </form>

                    <!-- Add the "Pay" button to trigger the modal -->
                    <button type="button" class="btn btn-success mt-3" data-toggle="modal" data-target="#bookModal">Pay</button>


                    <!-- Back to ticketing page or any other desired page -->
                    <a href="ticketing_page.php?schedule_id=<?php echo $scheduleDetails['id']; ?>" class="btn btn-secondary mt-3">Back to Ticketing</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>





<!-- Add a Bootstrap modal -->
<div class="modal" id="bookModal" tabindex="-1" role="dialog" aria-labelledby="bookModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="bookModalLabel">Book Now</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Please enter your phone number:</p>
                <!-- Phone number input field -->
                <input type="text" class="form-control mb-3" id="phoneNumber" placeholder="Enter your phone number" required>

                <!-- Loading spinner with message -->
                <div class="text-center mb-3" id="loadingSpinner" style="display: none;">
                    <div class="spinner-border" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                    <div class="mt-2">Waiting for payment...</div>
                </div>

                <!-- Payment received message -->
                <div class="text-center mb-3" id="paymentReceivedMessage" style="display: none;">
                    <div class="alert alert-success" role="alert">
                        Payment received! Redirecting...
                    </div>
                </div>

                <!-- Booking form -->
                <form id="bookingForm" method="post" action="process_booking.php">
                    <input type="hidden" name="schedule_id" value="<?php echo $scheduleDetails['id']; ?>">
                    <input type="hidden" name="seats" value="<?php echo $selectedSeats; ?>">
                    <button type="button" class="btn btn-primary" onclick="showLoadingSpinner()">Confirm Booking</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>

</script>
<?php
// Get the buffered content and assign it to $content
$pageContent = ob_get_clean();

// Include the layout
include('../layout.php');
?>
