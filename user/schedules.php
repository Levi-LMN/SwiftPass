<?php
// Include your database connection code here
include '../auth/database.php'; // Update with your actual database connection file

// Retrieve all travel schedules with the count of booked seats
$schedulesQuery = "SELECT ts.*, v.make, v.model, s.name AS sacco_name,
                        v.capacity - COUNT(t.seat_number) AS remaining_seats
                  FROM TravelSchedule ts
                  INNER JOIN Vehicle v ON ts.vehicle_id = v.id
                  INNER JOIN Sacco s ON v.sacco_id = s.id
                  LEFT JOIN Ticket t ON ts.id = t.travel_schedule_id
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
    <title>View All Travel Schedules</title>
</head>
<body>
<h2>All Travel Schedules</h2>

<?php if (mysqli_num_rows($schedulesResult) > 0) : ?>
    <table border="1">
        <tr>
            <th>Departure Location</th>
            <th>Destination</th>
            <th>Departure Time</th>
            <th>Price</th>
            <th>Vehicle Make</th>
            <th>Vehicle Model</th>
            <th>Sacco Name</th>
            <th>Remaining Seats</th> <!-- Add a new column for remaining seats -->
            <th>Action</th> <!-- Add a new column for actions -->
        </tr>
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
                    <!-- Add a link to the booking page with the schedule ID -->
                    <a href="booking_details.php?schedule_id=<?php echo $schedule['id']; ?>">Book Now</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
<?php else : ?>
    <p>No travel schedules found.</p>
<?php endif; ?>

<!-- Add links or buttons for additional actions or navigation -->

</body>
</html>
