<?php
session_start();
if (isset($_SESSION["user"])) {
    header("Location: ../index.php");
}

// Check for registration success message
if (isset($_SESSION["registration_success"])) {
    echo "<div>{$_SESSION["registration_success"]}</div>";
    unset($_SESSION["registration_success"]); // Remove the message from the session to avoid displaying it again
}

// Include the layout file
$pageTitle = "Login Form";
ob_start(); // Start output buffering to capture the content

// Your page-specific content goes here
?>
<div>
    <?php
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
                echo "<div>Password does not match</div>";
            }
        } else {
            echo "<div>Email does not match</div>";
        }
    }
    ?>
    <form action="login.php" method="post">
        <div>
            <input type="email" placeholder="Enter Email:" name="email">
        </div>
        <div>
            <input type="password" placeholder="Enter Password:" name="password">
        </div>
        <div>
            <input type="submit" value="Login" name="login">
        </div>
    </form>
    <div><p>Not registered yet <a href="registration.php">Register Here</a></p></div>
</div>

<?php
$pageContent = ob_get_clean(); // Get the captured content
include "../layout.php"; // Include the layout file
?>
