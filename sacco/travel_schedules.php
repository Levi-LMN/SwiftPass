<?php
session_start();

// Set page title for the layout
$pageTitle = "View Travel Schedules";

// Content for the layout
ob_start();

// database connection
include '../auth/database.php';

// Process the delete request
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_schedule'])) {
    $scheduleId = $_POST['schedule_id'];

    // Delete related tickets first
    $deleteTicketsQuery = "DELETE FROM Ticket WHERE travel_schedule_id = '$scheduleId'";
    if (mysqli_query($conn, $deleteTicketsQuery)) {
        // Now, perform the deletion of the travel schedule
        $deleteScheduleQuery = "DELETE FROM TravelSchedule WHERE id = '$scheduleId'";
        if (mysqli_query($conn, $deleteScheduleQuery)) {
            echo "Travel schedule and related tickets deleted successfully!";
        } else {
            echo "Error deleting travel schedule: " . mysqli_error($conn);
        }
    } else {
        echo "Error deleting related tickets: " . mysqli_error($conn);
    }
}

// Process the toggle request
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['toggle_is_done'])) {
    $scheduleIdToToggle = $_POST['toggle_is_done'];

    // Toggle the is_done status
    $toggleIsDoneQuery = "UPDATE TravelSchedule SET is_done = 1 - is_done WHERE id = '$scheduleIdToToggle'";
    if (mysqli_query($conn, $toggleIsDoneQuery)) {
        echo "Schedule status toggled successfully!";
    } else {
        echo "Error toggling Is Done status: " . mysqli_error($conn);
    }
}

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

// Fetch active travel schedules
$activeSchedulesQuery = "SELECT ts.*, v.make, v.model, v.registration_plate,
                        v.capacity - COUNT(t.seat_number) AS remaining_seats
                  FROM TravelSchedule ts
                  INNER JOIN Vehicle v ON ts.vehicle_id = v.id
                  LEFT JOIN Ticket t ON ts.id = t.travel_schedule_id
                  WHERE v.sacco_id = '{$adminInfo['sacco_id']}'
                    AND ts.is_done = 0
                  GROUP BY ts.id";

$activeSchedulesResult = mysqli_query($conn, $activeSchedulesQuery);

// Check for errors in the query
if (!$activeSchedulesResult) {
    die("Error fetching active travel schedules: " . mysqli_error($conn));
}

// Fetch completed travel schedules
$completedSchedulesQuery = "SELECT ts.*, v.make, v.model, v.registration_plate,
                        v.capacity - COUNT(t.seat_number) AS remaining_seats
                  FROM TravelSchedule ts
                  INNER JOIN Vehicle v ON ts.vehicle_id = v.id
                  LEFT JOIN Ticket t ON ts.id = t.travel_schedule_id
                  WHERE v.sacco_id = '{$adminInfo['sacco_id']}'
                    AND ts.is_done = 1
                  GROUP BY ts.id";

$completedSchedulesResult = mysqli_query($conn, $completedSchedulesQuery);

// Check for errors in the query
if (!$completedSchedulesResult) {
    die("Error fetching completed travel schedules: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?></title>
</head>
<body>
<h2><?php echo $pageTitle; ?></h2>
<p>Welcome, <?php echo $adminInfo['first_name'] . ' ' . $adminInfo['last_name']; ?>!</p>

<div>
    <h3>Active Travel Schedules for <?php echo $adminInfo['sacco_name']; ?>:</h3>
    <?php if (mysqli_num_rows($activeSchedulesResult) > 0) : ?>
        <table>
            <thead>
            <tr>
                <th>Departure Location</th>
                <th>Destination</th>
                <th>Departure Time</th>
                <th>Price</th>
                <th>Vehicle Make</th>
                <th>Vehicle Model</th>
                <th>Vehicle Number Plate</th>
                <th>Remaining Seats</th>
                <th>Is Done</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php while ($schedule = mysqli_fetch_assoc($activeSchedulesResult)) : ?>
                <tr>
                    <td><?php echo $schedule['departure_location']; ?></td>
                    <td><?php echo $schedule['destination']; ?></td>
                    <td><?php echo $schedule['departure_time']; ?></td>
                    <td><?php echo $schedule['price']; ?></td>
                    <td><?php echo $schedule['make']; ?></td>
                    <td><?php echo $schedule['model']; ?></td>
                    <td><?php echo $schedule['registration_plate']; ?></td>
                    <td><?php echo $schedule['remaining_seats']; ?></td>
                    <td><?php echo $schedule['is_done'] ? 'Yes' : 'No'; ?></td>
                    <td>
                        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                            <input type="hidden" name="toggle_is_done" value="<?php echo $schedule['id']; ?>">
                            <button type="submit">
                                <?php echo $schedule['is_done'] ? 'Mark as Not Done' : 'Mark as Done'; ?>
                            </button>
                        </form>
                        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                            <input type="hidden" name="schedule_id" value="<?php echo $schedule['id']; ?>">
                            <button type="submit" name="delete_schedule">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
            </tbody>
        </table>
    <?php else : ?>
        <p>No active travel schedules found for <?php echo $adminInfo['sacco_name']; ?>.</p>
    <?php endif; ?>
</div>

<div>
    <h3>Completed Travel Schedules for <?php echo $adminInfo['sacco_name']; ?>:</h3>
    <?php if (mysqli_num_rows($completedSchedulesResult) > 0) : ?>
        <table>
            <thead>
            <tr>
                <th>Departure Location</th>
                <th>Destination</th>
                <th>Departure Time</th>
                <th>Price</th>
                <th>Vehicle Make</th>
                <th>Vehicle Model</th>
                <th>Vehicle Number Plate</th>
                <th>Remaining Seats</th>
                <th>Is Done</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php while ($schedule = mysqli_fetch_assoc($completedSchedulesResult)) : ?>
                <tr>
                    <td><?php echo $schedule['departure_location']; ?></td>
                    <td><?php echo $schedule['destination']; ?></td>
                    <td><?php echo $schedule['departure_time']; ?></td>
                    <td><?php echo $schedule['price']; ?></td>
                    <td><?php echo $schedule['make']; ?></td>
                    <td><?php echo $schedule['model']; ?></td>
                    <td><?php echo $schedule['registration_plate']; ?></td>
                    <td><?php echo $schedule['remaining_seats']; ?></td>
                    <td><?php echo $schedule['is_done'] ? 'Yes' : 'No'; ?></td>
                    <td>
                        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                            <input type="hidden" name="toggle_is_done" value="<?php echo $schedule['id']; ?>">
                            <button type="submit">
                                <?php echo $schedule['is_done'] ? 'Mark as Not Done' : 'Mark as Done'; ?>
                            </button>
                        </form>
                        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                            <input type="hidden" name="schedule_id" value="<?php echo $schedule['id']; ?>">
                            <button type="submit" name="delete_schedule">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
            </tbody>
        </table>
    <?php else : ?>
        <p>No completed travel schedules found for <?php echo $adminInfo['sacco_name']; ?>.</p>
    <?php endif; ?>
</div>

<!-- Back to admin dashboard link -->
<a href="sacco_admin_dashboard.php">Back to Admin Dashboard</a>

</body>
</html>

<?php
// Get the buffered content and assign it to $content
$pageContent = ob_get_clean();

// Include the layout
include('../layout.php');
?>
