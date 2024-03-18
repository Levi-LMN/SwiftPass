<?php
session_start();
$loggedIn = isset($_SESSION["user"]) && is_array($_SESSION["user"]);

// Set page title for the layout
$pageTitle = "Schedules";

// Content for the layout
ob_start();

// db page
include '../auth/database.php';

// Retrieve all travel schedules with the count of booked seats that are not marked as done
$schedulesQuery = "SELECT ts.*, v.make, v.model, s.name AS sacco_name,
                        v.capacity - COUNT(t.seat_number) AS remaining_seats
                  FROM TravelSchedule ts
                  INNER JOIN Vehicle v ON ts.vehicle_id = v.id
                  INNER JOIN Sacco s ON v.sacco_id = s.id
                  LEFT JOIN Ticket t ON ts.id = t.travel_schedule_id
                  WHERE ts.is_done = 0
                  GROUP BY ts.id";

$schedulesResult = mysqli_query($conn, $schedulesQuery);

// Check for errors in the query
if (!$schedulesResult) {
    die("Error fetching travel schedules: " . mysqli_error($conn));
}
?>

<div class="container mt-5">
    <h2 class="mb-4">View All Travel Schedules</h2>

    <?php if (mysqli_num_rows($schedulesResult) > 0) : ?>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Departure Location</th>
                <th>Destination</th>
                <th>Departure Time</th>
                <th>Price</th>
                <th>Vehicle Make</th>
                <th>Vehicle Model</th>
                <th>Sacco Name</th>
                <th>Remaining Seats</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php while ($schedule = mysqli_fetch_assoc($schedulesResult)) : ?>
                <tr>
                    <td><?php echo $schedule['departure_location']; ?></td>
                    <td><?php echo $schedule['destination']; ?></td>
                    <td><?php echo $schedule['departure_time']; ?></td>
                    <td><?php echo $schedule['price']; ?></td>
                    <td><?php echo $schedule['make']; ?></td>
                    <td><?php echo $schedule['model']; ?></td>
                    <td><?php echo $schedule['sacco_name']; ?></td>
                    <td><?php echo $schedule['remaining_seats']; ?></td>
                    <td>
                        <?php if ($schedule['remaining_seats'] > 0) : ?>
                            <a class="btn btn-primary" href="booking_details.php?schedule_id=<?php echo $schedule['id']; ?>">Book Now</a>
                        <?php else : ?>
                            <span class="text-danger">Schedule Full</span>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endwhile; ?>
            </tbody>
        </table>
    <?php else : ?>
        <p>No active travel schedules found.</p>
    <?php endif; ?>
</div>

<?php
// Get the buffered content and assign it to $content
$pageContent = ob_get_clean();

// Include the layout
include('../layout.php');
?>
