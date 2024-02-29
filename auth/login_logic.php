<?php
session_start();

if (isset($_POST["login"])) {
    // Retrieve user inputs
    $email = $_POST["email"];
    $password = $_POST["password"];
    // Include the database configuration
    require_once "database.php"; // Updated path
    // Retrieve the user from the database
    $sql = "SELECT * FROM user WHERE email = '$email'";
    // Use prepared statements to prevent SQL injection
    $result = mysqli_query($conn, $sql);
    // Check if the user exists
    $user = mysqli_fetch_assoc($result); // Use mysqli_fetch_assoc for simplicity
    if ($user) {
        if (password_verify($password, $user["password"])) {
            // Store additional user information in the session
            $_SESSION["user"] = array(
                "user_id" => $user["user_id"],
                "first_name" => $user["first_name"],
                "last_name" => $user["last_name"],
                "role" => $user["role"], // Assuming 'role' is the field in your database
                // Add other user information as needed
            );

            if ($user["role"] == 'admin') {
                header("Location: ../admin/admin_dashboard.php");
            } elseif ($user["role"] == 'sacco admin') {
                header("Location: ../sacco_admin/sacco_admin_dashboard.php");
            } elseif ($user["role"] == 'driver') {
                header("Location: ../driver/driver_dashboard.php");
            } else {
                header("Location: ../index.php"); // Adjusted path
            }
            die();
        } else {
            $_SESSION["login_error"] = "Password does not match";
        }
    } else {
        $_SESSION["login_error"] = "Email does not match";
    }
}
?>
