<?php
// Include your database connection logic here
include 'auth/database.php';  // Include the database connection file

// Check if the connection is successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["q"])) {
    $searchTerm = $_GET["q"];

    // Debug: Echo out the search term
    echo "Search Term: " . $searchTerm . "<br>";

    // Sanitize the input to prevent SQL injection
    $searchTerm = mysqli_real_escape_string($conn, $searchTerm);

    // Debug: Echo out the sanitized search term
    echo "Sanitized Search Term: " . $searchTerm . "<br>";

    // Query to search for travel schedules based on the departure_location, destination, or sacco name
    $query = "SELECT travelschedule.* FROM travelschedule
              INNER JOIN vehicle ON travelschedule.vehicle_id = vehicle.id
              INNER JOIN sacco ON vehicle.sacco_id = sacco.id
              WHERE travelschedule.departure_location LIKE '%$searchTerm%' 
                 OR travelschedule.destination LIKE '%$searchTerm%'
                 OR sacco.name LIKE '%$searchTerm%'";

    // Debug: Echo out the query
    echo "Query: " . $query . "<br>";

    $result = mysqli_query($conn, $query);

    if ($result) {
        // Check if there are any results
        if (mysqli_num_rows($result) > 0) {
            // Redirect to the search_results.php page with the search term as a parameter
            header("Location: search_results.php?search=" . urlencode($searchTerm));
            exit();
        } else {
            echo "No results found.";
        }
    } else {
        echo "Error executing query: " . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
}
?>
