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



<?php
// Include database configuration
include 'database.php'; // Update with your actual database configuration

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve user inputs
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role']; // Selected role from the dropdown

    // Hash the password (For better security, consider using password_hash())
    $hashed_password = md5($password);

    // Insert user data into the User table
    $insert_user_query = "INSERT INTO User (first_name, last_name, email, password, role)
                          VALUES ('$first_name', '$last_name', '$email', '$hashed_password', '$role')";

    if ($conn->query($insert_user_query) === TRUE) {
        // Redirect to the login page after successful registration
        header("Location: login.php");
        exit();
    } else {
        echo "Error: " . $insert_user_query . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>


<!--<form method="post" action="registration.php">-->
<!--    <label for="first_name">First Name:</label>-->
<!--    <input type="text" name="first_name" required><br>-->
<!---->
<!--    <label for="last_name">Last Name:</label>-->
<!--    <input type="text" name="last_name" required><br>-->
<!---->
<!--    <label for="email">Email:</label>-->
<!--    <input type="email" name="email" required><br>-->
<!---->
<!--    <label for="password">Password:</label>-->
<!--    <input type="password" name="password" required><br>-->
<!---->
<!--    <label for="role">Role:</label>-->
<!--    <select name="role" required>-->
<!--        <option value="user">User</option>-->
<!--        <option value="admin">Admin</option>-->
<!--        <option value="sacco admin">Sacco Admin</option>-->
<!--        <option value="driver">driver</option>-->
<!--         Add more options as needed -->
<!--    </select><br>-->
<!---->
<!--    <input type="submit" value="Register">-->
<!--</form>-->


<div class="container mt-5 d-flex justify-content-center align-items-center">
    <div class="card shadow-lg p-3 mb-5 bg-white rounded" style="width: 600px;">
        <div class="card-body">
            <h5 class="card-title text-center mb-4">Registration Form</h5>
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
