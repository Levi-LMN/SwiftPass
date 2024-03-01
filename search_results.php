<?php
//session start
session_start();

// Set page title for the layout
$pageTitle = "Dashboard";

// Content for the layout
ob_start();

// Include your database connection logic here
include 'auth/database.php';  // Include the database connection file

// Check if the connection is successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["search"])) {
    $searchTerm = $_GET["search"];

    // Sanitize the input to prevent SQL injection
    $searchTerm = mysqli_real_escape_string($conn, $searchTerm);

    // Query to search for travel schedules based on the departure_location, destination, or sacco name
    $query = "SELECT travelschedule.*, sacco.name AS sacco_name
              FROM travelschedule
              INNER JOIN vehicle ON travelschedule.vehicle_id = vehicle.id
              INNER JOIN sacco ON vehicle.sacco_id = sacco.id
              WHERE travelschedule.departure_location LIKE '%$searchTerm%' 
                 OR travelschedule.destination LIKE '%$searchTerm%'
                 OR sacco.name LIKE '%$searchTerm%'";

    $result = mysqli_query($conn, $query);

    if ($result) {
        ?>
        <div class="container">
            <h1 class="mt-5 mb-4">Search Results</h1>

            <?php
            while ($row = mysqli_fetch_assoc($result)) {
                // Display relevant information from the travelschedule and sacco tables
                ?>
                <div class="card mb-3">
                    <div class="card-body">
                        <p class="card-title">Departure Location: <?php echo $row['departure_location']; ?></p>
                        <p class="card-text">Destination: <?php echo $row['destination']; ?></p>
                        <p class="card-text">Departure Time: <?php echo $row['departure_time']; ?></p>
                        <p class="card-text">Price: KES <?php echo $row['price']; ?></p>
                        <p class="card-text">Sacco: <?php echo $row['sacco_name']; ?></p>
                        <a href="user/booking_details.php?schedule_id=<?php echo $row['id']; ?>" class="btn btn-primary">View Details</a>
                    </div>
                </div>
                <?php
            }
            ?>

        </div>
        <?php
    } else {
        echo "Error executing query: " . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
} else {
    echo "Error executing query: " . mysqli_error($conn);
}

// Get the buffered content and assign it to $content
$pageContent = ob_get_clean();

// Include the layout
include('layout.php');
?>
