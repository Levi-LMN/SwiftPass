<?php
// Set page title for the layout
$pageTitle = "Add Sacco";

// Content for the layout
ob_start();
?>

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

<h2><?php echo $pageTitle; ?></h2>
<form method="post" action="process_add_sacco.php">
    <label for="sacco_name">Sacco Name:</label>
    <input type="text" name="sacco_name" required>
    <div>Please enter the Sacco name.</div>

    <label for="admin_id">Select Sacco Admin:</label>
    <select name="admin_id" required>
        <option value="" selected disabled>Select Sacco Admin</option>
        <?php
        // Display Sacco admins in the dropdown
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<option value='" . $row['id'] . "'>" . $row['first_name'] . " " . $row['last_name'] . "</option>";
        }
        ?>
    </select>
    <div>Please select a Sacco admin.</div>

    <button type="submit">Add Sacco</button>
</form>

<!-- Back to admin dashboard -->
<a href="admin_dashboard.php">Back to Admin Dashboard</a>

<?php
// Close the database connection
mysqli_close($conn);

// Get the buffered content and assign it to $content
$pageContent = ob_get_clean();

// Include the layout
include('../layout.php');
?>
