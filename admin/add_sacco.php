<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION["user"])) {
    // Redirect to the login page or handle the case where the user is not logged in
    header("Location: login.php");
    exit();
}

// Include database configuration
include '../auth/database.php'; // Update with your actual database configuration

// Fetch Sacco admins from the User table with the role "sacco admin"
$adminsQuery = "SELECT id, first_name, last_name FROM User WHERE role = 'sacco admin'";
$result = mysqli_query($conn, $adminsQuery);

// Check for errors in the query
if (!$result) {
    die("Error fetching Sacco admins: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Sacco</title>
</head>
<body>
<h2>Add Sacco</h2>
<form method="post" action="process_add_sacco.php"> <!-- Create a separate processing file for form submissions -->
    <label for="sacco_name">Sacco Name:</label>
    <input type="text" name="sacco_name" required><br>

    <label for="admin_id">Select Sacco Admin:</label>
    <select name="admin_id" required>
        <?php
        // Display Sacco admins in the dropdown
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<option value='" . $row['id'] . "'>" . $row['first_name'] . " " . $row['last_name'] . "</option>";
        }
        ?>
    </select><br>

    <input type="submit" value="Add Sacco">
</form>

<!--back to admin dashboard-->
<a href="admin_dashboard.php">Back to Admin Dashboard</a>
</body>
</html>

<?php
// Close the database connection
mysqli_close($conn);
?>
