<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION["user"])) {
    header("Location: ../login.php"); // Redirect to the login page if not logged in
    exit();
}

// Include your database connection code
include 'auth/database.php';

// Retrieve the user ID from the session
$user_id = $_SESSION['user']['id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the updated user details from the form
    $updatedFirstName = $_POST['updateFirstName'];
    $updatedLastName = $_POST['updateLastName'];

    // Update the user details in the database
    $update_query = "UPDATE user SET first_name='$updatedFirstName', last_name='$updatedLastName' WHERE id=$user_id";

    $result = mysqli_query($conn, $update_query);

    if ($result) {
        // Redirect back to the user profile page after successful update
        header("Location: profile.php");
        exit();
    } else {
        die("Error updating user details: " . mysqli_error($conn));
    }
} else {
    // Redirect to the user profile page if accessed without a form submission
    header("Location: user_profile.php");
    exit();
}
?>
