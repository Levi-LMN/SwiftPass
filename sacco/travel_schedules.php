<?php
session_start();

// Check if the user is logged in and has the role 'sacco admin'
if (!isset($_SESSION["user"]) || $_SESSION["user"]["role"] !== 'sacco admin') {
    // Redirect to the login page or handle the case where the user is not logged in or not a sacco admin
    header("Location: ../auth/login.php");
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

// Check if the Sacco admin is associated with a Sacco
if (!$adminInfo['sacco_name']) {
    // Redirect to a page with appropriate access or show an error message
    echo "You are not currently associated with any Sacco.";
    exit();
}

// Process the delete request
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_schedule'])) {
    $scheduleId = $_POST['schedule_id'];

    // Perform the deletion
    $deleteScheduleQuery = "DELETE FROM TravelSchedule WHERE id = '$scheduleId'";
    if (mysqli_query($conn, $deleteScheduleQuery)) {
        echo "Travel schedule deleted successfully!";
    } else {
        echo "Error deleting travel schedule: " . mysqli_error($conn);
    }
}

// Retrieve all travel schedules associated with the Sacco along with the remaining seats count
$schedulesQuery = "SELECT ts.*, v.make, v.model, v.registration_plate,
                        v.capacity - COUNT(t.seat_number) AS remaining_seats
                  FROM TravelSchedule ts
                  INNER JOIN Vehicle v ON ts.vehicle_id = v.id
                  LEFT JOIN Ticket t ON ts.id = t.travel_schedule_id
                  WHERE v.sacco_id = '{$adminInfo['sacco_id']}'
                  GROUP BY ts.id";

$schedulesResult = mysqli_query($conn, $schedulesQuery);

// Check for errors in the query
if (!$schedulesResult) {
    die("Error fetching travel schedules: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Travel Schedules</title>
</head>
<body>
<h2>View Travel Schedules</h2>
<p>Welcome, <?php echo $adminInfo['first_name'] . ' ' . $adminInfo['last_name']; ?>!</p>

<h3>All Travel Schedules for <?php echo $adminInfo['sacco_name']; ?>:</h3>
<?php if (mysqli_num_rows($schedulesResult) > 0) : ?>
    <table border="1">
        <tr>
            <th>Departure Location</th>
            <th>Destination</th>
            <th>Departure Time</th>
            <th>Price</th>
            <th>Vehicle Make</th>
            <th>Vehicle Model</th>
            <th>Vehicle Number Plate</th>
            <th>Remaining Seats</th>
            <th>Action</th>
        </tr>

        <?php while ($schedule = mysqli_fetch_assoc($schedulesResult)) : ?>
            <tr>
                <td><?php echo $schedule['departure_location']; ?></td>
                <td><?php echo $schedule['destination']; ?></td>
                <td><?php echo $schedule['departure_time']; ?></td>
                <td><?php echo $schedule['price']; ?></td>
                <td><?php echo $schedule['make']; ?></td>
                <td><?php echo $schedule['model']; ?></td>
                <td><?php echo $schedule['registration_plate']; ?></td>
                <td><?php echo $schedule['remaining_seats']; ?></td>
                <td>
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <input type="hidden" name="schedule_id" value="<?php echo $schedule['id']; ?>">
                        <input type="submit" name="delete_schedule" value="Delete">
                    </form>
                </td>
            </tr>
        <?php endwhile; ?>

    </table>
<?php else : ?>
    <p>No travel schedules found for <?php echo $adminInfo['sacco_name']; ?>.</p>
<?php endif; ?>

<!--back to admin dashboard-->
<a href="sacco_admin_dashboard.php">Back to Admin Dashboard</a>
</body>
</html>
