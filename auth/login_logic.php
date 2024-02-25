<?php
session_start();

if (isset($_POST["login"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];
    require_once "database.php"; // Updated path
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
    if ($user) {
        if (password_verify($password, $user["password"])) {
            // Store additional user information in the session (e.g., full name)
            $_SESSION["user"] = "yes";
            $_SESSION["user_full_name"] = $user["full_name"]; // Adjusted based on your database structure
            header("Location: ../index.php"); // Adjusted path
            die();
        } else {
            $_SESSION["login_error"] = "Password does not match";
        }
    } else {
        $_SESSION["login_error"] = "Email does not match";
    }
}
?>
