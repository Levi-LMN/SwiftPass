<?php
session_start();

// Set page title for the layout
$pageTitle = "Sacco Administrator Dashboard";

// Content for the layout
ob_start();

// Check if the user is logged in
if (!isset($_SESSION["user"])) {
    // Redirect to the login page or handle the case where the user is not logged in
    header("Location: login.php");
    exit();
}

// Include your database connection code here
include '../auth/database.php'; // Update with your actual database connection file

// Retrieve the Sacco admin's information from the User table
$adminId = $_SESSION["user"]["id"]; // Assuming "id" is the unique identifier for the user
$adminQuery = "SELECT u.*, s.name AS sacco_name
                FROM User u
                LEFT JOIN Sacco s ON u.sacco_id = s.id
                WHERE u.id = '$adminId'";

$adminResult = mysqli_query($conn, $adminQuery);

// Check for errors in the query
if (!$adminResult) {
    die("Error fetching Sacco admin information: " . mysqli_error($conn));
}

// Fetch the Sacco admin's information
$adminInfo = mysqli_fetch_assoc($adminResult);
?>


<div class="container mt-4">
    <h2 class="mb-4">Sacco Admin Dashboard</h2>
    <p class="mb-4">Welcome, <?php echo $adminInfo['first_name'] . ' ' . $adminInfo['last_name']; ?>!</p>

    <?php if ($adminInfo['sacco_name']) : ?>
        <p class="mb-4">You are associated with the Sacco: <?php echo $adminInfo['sacco_name']; ?></p>
        <div class="row row-cols-1 row-cols-md-2 g-4">
            <div class="col">
                <div class="card border-primary h-100 rounded shadow">
                    <div class="card-body text-center">
                        <h5 class="card-title mb-3">Add Vehicle</h5>
                        <p class="card-text">Add a new vehicle to the Sacco fleet.</p>
                        <a href="add_vehicle.php" class="btn btn-primary">Go to Add Vehicle</a>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card border-success h-100 rounded shadow">
                    <div class="card-body text-center">
                        <h5 class="card-title mb-3">View Vehicles</h5>
                        <p class="card-text">View and manage the existing vehicles in the Sacco.</p>
                        <a href="view_vehicles.php" class="btn btn-success">Go to View Vehicles</a>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card border-info h-100 rounded shadow">
                    <div class="card-body text-center">
                        <h5 class="card-title mb-3">Add Schedule</h5>
                        <p class="card-text">Create a new travel schedule for the Sacco.</p>
                        <a href="add_schedule.php" class="btn btn-info">Go to Add Schedule</a>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card border-warning h-100 rounded shadow">
                    <div class="card-body text-center">
                        <h5 class="card-title mb-3">View Travel Schedules</h5>
                        <p class="card-text">View and manage the existing travel schedules in the Sacco.</p>
                        <a href="travel_schedules.php" class="btn btn-warning">Go to View Travel Schedules</a>
                    </div>
                </div>
            </div>
        </div>
    <?php else : ?>
        <p class="mb-4">You are not currently associated with any Sacco.</p>
    <?php endif; ?>

    <!-- Logout link -->
    <a href="logout.php" class="btn btn-danger mt-4">Logout</a>
</div>



<?php
// Close the database connection
mysqli_close($conn);
?>
<?php
// Get the buffered content and assign it to $content
$pageContent = ob_get_clean();

// Include the layout
include('../layout.php');
?>
