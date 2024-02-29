<?php
// Start the session (if not already started)
session_start();

// Check if the user is logged in with a valid session
if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.php"); // Redirect to login page if not logged in
    exit();
}

// Include database configuration
include 'database.php'; // Update with your actual database configuration

// Retrieve user information based on the session user_id
$user_id = $_SESSION['user_id'];
$get_user_query = "SELECT * FROM User WHERE id='$user_id'";
$result = $conn->query($get_user_query);

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    $_SESSION['user_role'] = $user['role']; // Store the user's role in the session
} else {
    // Invalid user, redirect to login
    header("Location: ../index.php");
    exit();
}

// Close the database connection
$conn->close();
?>
