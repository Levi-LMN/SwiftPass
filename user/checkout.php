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


    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo $pageTitle; ?></title>
           <link rel="stylesheet" href="../static/user/checkout.css">
    </head>
    <body>
    <div class="container">
        <div class="left-column">
            <?php if ($scheduleDetails) : ?>
                <div class="card">
                    <div class="card-header">
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

        <div class="right-column">
            <?php if ($scheduleDetails) : ?>
                <div class="card">
                    <div class="card-header">
                        <h3>Selected Seats</h3>
                    </div>
                    <div class="card-body">
                        <p><?php echo ($selectedSeats ? 'Seats: ' . $selectedSeats : 'No seats selected.'); ?></p>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h3>Total Price</h3>
                    </div>
                    <div class="card-body">
                        <p><?php echo ($totalPrice ? 'Total Price: $' . $totalPrice : 'No total price calculated.'); ?></p>
                    </div>
                </div>

                <form method="post" action="process_booking.php">
                    <input type="hidden" name="schedule_id" value="<?php echo $scheduleDetails['id']; ?>">
                    <input type="hidden" name="seats" value="<?php echo $selectedSeats; ?>">
<!--                    <button type="submit" class="btn btn-primary mt-3">Book Now</button>-->
                </form>
                <button type="button" class="btn btn-success mt-3" onclick="showModal()">Pay</button>
                <a href="ticketing_page.php?schedule_id=<?php echo $scheduleDetails['id']; ?>" class="btn btn-secondary mt-3">Back to Ticketing</a>
            <?php endif; ?>
        </div>
    </div>

    <div id="bookModal" class="modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Book Now</h5>
                    <a href="#" class="close">&times;</a>
                </div>
                <div class="modal-body">
                    <p>Please enter your phone number:</p>
                    <input type="text" class="form-control mb-3" id="phoneNumber" placeholder="Enter your phone number" required>
                    <div class="text-center mb-3" id="loadingSpinner" style="display: none;">
                        <div class="spinner">
                            <svg class="path" viewBox="0 0 64 64">
                                <circle class="spinner" cx="32" cy="32" r="28" fill="none" stroke-width="4"></circle>
                            </svg>
                        </div>
                        <div class="mt-2">Waiting for payment...</div>
                    </div>
                    <div class="text-center mb-3" id="paymentReceivedMessage" style="display: none;">
                        <div class="alert alert-success" role="alert">
                            Payment received! Redirecting...
                        </div>
                    </div>
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
        function showModal() {
            document.getElementById('bookModal').style.display = 'block';
        }

        document.querySelectorAll('.close').forEach(function(el) {
            el.onclick = function() {
                document.getElementById('bookModal').style.display = 'none';
            }
        });

        function showLoadingSpinner() {
            const phoneNumber = document.getElementById('phoneNumber').value;
            if (!phoneNumber) {
                alert("Please enter your phone number.");
                return;
            }
            document.querySelector('#bookModal button[type="button"]').disabled = true;
            document.getElementById('loadingSpinner').style.display = 'block';
            document.getElementById('bookingForm').style.display = 'none';
            setTimeout(() => {
                document.getElementById('loadingSpinner').style.display = 'none';
                document.getElementById('paymentReceivedMessage').style.display = 'block';
                const phoneNumberInput = document.createElement('input');
                phoneNumberInput.type = 'hidden';
                phoneNumberInput.name = 'phone_number';
                phoneNumberInput.value = phoneNumber;
                document.getElementById('bookingForm').appendChild(phoneNumberInput);
                setTimeout(() => {
                    document.getElementById('bookingForm').submit();
                }, 2000);
            }, 5000);
        }
    </script>
    </body>
    </html>



<?php
// Get the buffered content and assign it to $content
$pageContent = ob_get_clean();

// Include the layout
include('../layout.php');
?>