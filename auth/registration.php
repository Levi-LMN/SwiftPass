<?php
// Set page title for the layout
$pageTitle = "Registration Form";

// Content for the layout
ob_start();
?>

<?php
session_start();
if (isset($_SESSION["user"])) {
    header("Location: ../index.php");
}
?>



<div class="container mt-5 d-flex justify-content-center align-items-center">
    <div class="card shadow-lg p-3 mb-5 bg-white rounded" style="width: 600px;">
        <div class="card-body">
            <h5 class="card-title text-center mb-4">Registration Form</h5>
            <?php
            if (isset($_POST["submit"])) {
                $first_name = $_POST["first_name"];
                $last_name = $_POST["last_name"];
                $email = $_POST["email"];
                $password = $_POST["password"];
                $passwordRepeat = $_POST["repeat_password"];
                $role = $_POST["role"];

                // Hash the password
                $passwordHash = password_hash($password, PASSWORD_DEFAULT);

                $errors = array();

                if (empty($first_name) OR empty($last_name) OR empty($email) OR empty($password) OR empty($passwordRepeat) OR empty($role)) {
                    array_push($errors, "All fields are required");
                }
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    array_push($errors, "Email is not valid");
                }
                if (strlen($password) < 4) {
                    array_push($errors, "Password must be at least 4 characters long");
                }
                if ($password !== $passwordRepeat) {
                    array_push($errors, "Password does not match");
                }

                require_once "database.php";
                $sql = "SELECT * FROM users WHERE email = '$email'";
                $result = mysqli_query($conn, $sql);
                $rowCount = mysqli_num_rows($result);

                if ($rowCount > 0) {
                    array_push($errors, "Email already exists!");
                }

                if (count($errors) > 0) {
                    foreach ($errors as $error) {
                        echo "<div class='alert alert-danger'>$error</div>";
                    }
                } else {
                    $sql = "INSERT INTO users (first_name, last_name, email, password, role) VALUES (?, ?, ?, ?, ?)";
                    $stmt = mysqli_stmt_init($conn);
                    $prepareStmt = mysqli_stmt_prepare($stmt, $sql);
                    if ($prepareStmt) {
                        mysqli_stmt_bind_param($stmt, "sssss", $first_name, $last_name, $email, $passwordHash, $role);
                        mysqli_stmt_execute($stmt);
                        echo "<div class='alert alert-success'>You are registered successfully, you can now login</div>";

                        // Store success message in session
                        $_SESSION["registration_success"] = "You are registered successfully";

                        // Show success message using JavaScript alert
                        echo "<script>alert('You are registered successfully. You can now login.');</script>";

                        // Redirect to login page after a delay
                        echo "<script>setTimeout(function(){ window.location.href = 'login.php'; }, 2000);</script>";

                        exit(); // Make sure to exit after the header to prevent further execution
                    } else {
                        die("Something went wrong");
                    }
                }
            }
            ?>
            <form action="registration.php" method="post">
                <div class="mb-3">
                    <label for="first_name" class="form-label">Enter First Name:</label>

                        <input type="text" class="form-control" name="first_name" placeholder="First Name" required>

                </div>
                <div class="mb-3">
                    <label for="last_name" class="form-label">Enter Last Name:</label>

                        <input type="text" class="form-control" name="last_name" placeholder="Last Name" required>

                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Enter Email:</label>

                        <input type="email" class="form-control" name="email" placeholder="Email" required>

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
                    <label for="repeat_password"></label><input type="password" class="form-control" id="repeat_password" name="repeat_password" placeholder="Repeat Password">
                </div>




                <div class="mb-3">

                        <select class="form-select" name="role">
                            <option value="admin">Admin</option>
                            <option value="user">User</option>
                            <option value="sacco admin">Sacco admin</option>
                            <option value="driver">Driver</option>
                        </select>

                </div>
                <div class="form-btn d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary" name="submit">Register</button>
                </div>

            </form>
            <div class="mt-3 text-center">
                <p>Already Registered? <a href="login.php">Login Here</a></p>
            </div>
        </div>
        <div class="card-footer text-muted text-center">
<!--           how we collect and store your data and by signing up you agree.. swiftpass-->
            By signing up you agree to our <a href="http://example.com/">Terms of Service</a> and <a href="http://example.com/">Privacy Policy</a>
        </div>
    </div>
</div>





<?php
// Get the buffered content and assign it to $content
$pageContent = ob_get_clean();

// Include the layout
include('../layout.php');
?>
