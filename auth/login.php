<?php
if (isset($_SESSION["user"])) {
    header("Location: ../index.php");
}

// Check for registration success message
if (isset($_SESSION["registration_success"])) {
    echo "<script>alert('{$_SESSION["registration_success"]}');</script>";
    unset($_SESSION["registration_success"]); // Remove the message from the session to avoid displaying it again
}

// Include the login logic
require_once "login_logic.php";

// Include the layout file
$pageTitle = "Login Form";
ob_start(); // Start output buffering to capture the content

// Your page-specific content goes here
?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-body text-center">
                    <h2 class="card-title mb-4">Login Form</h2>
                    <?php
                    // Display login errors, if any
                    if (isset($_SESSION["login_error"])) {
                        echo "<script>alert('{$_SESSION["login_error"]}');</script>";
                        unset($_SESSION["login_error"]);
                    }
                    ?>
                    <form action="login.php" method="post">
                        <div class="mb-3">
                            <label for="email" class="form-label">Enter Email:</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Your email" required>
                        </div>
                        <div class="mb-3 password-container">
                            <label for="password" class="form-label">Enter Password:</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="password" name="password" placeholder="Your password" required>
                                <div class="password-icon-container input-group-append">
                                    <i class="fas fa-eye" id="togglePassword" onclick="togglePasswordVisibility()"></i>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <input type="submit" class="btn btn-primary btn-block" value="Login" name="login">
                        </div>
                    </form>
                        <div class="mt-3">
                        <p>Not registered yet? <a href="registration.php">Register Here</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$pageContent = ob_get_clean(); // Get the captured content
include "../layout.php"; // Include the layout file
?>
