<?php
// Function to sanitize input
function sanitizeInput($input) {
    return htmlspecialchars(strip_tags(trim($input)));
}

// Set page title for the layout
$pageTitle = "Registration Form";

// Content for the layout
ob_start();

session_start();
if (isset($_SESSION["user"])) {
    header("Location: ../index.php");
}

// Include database configuration
include '../auth/database.php'; // Update with your actual database configuration

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve user inputs and sanitize them
    $first_name = sanitizeInput($_POST['first_name']);
    $last_name = sanitizeInput($_POST['last_name']);
    $email = sanitizeInput($_POST['email']);
    $password = sanitizeInput($_POST['password']);
    $role = 'driver'; // Assuming 'driver' is the default role
    $driverLicense = sanitizeInput($_POST["driver_license"]);

    // Hash the password (For better security, consider using password_hash())
    $hashed_password = md5($password);

    // Insert user data into the User table
    $insert_user_query = "INSERT INTO User (first_name, last_name, email, password, role, driver_license)
                          VALUES ('$first_name', '$last_name', '$email', '$hashed_password', '$role', '$driverLicense')";

    if ($conn->query($insert_user_query) === TRUE) {
        // Redirect to the login page after successful registration
        header("Location: ../auth/login.php");
        exit();
    } else {
        echo "Error: " . $insert_user_query . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Driver Registration</title>
</head>
<body>
<h2>Driver Registration</h2>
<form method="post" action="register_driver.php">
    <label for="first_name">First Name:</label>
    <input type="text" name="first_name" required><br>

    <label for="last_name">Last Name:</label>
    <input type="text" name="last_name" required><br>

    <label for="email">Email:</label>
    <input type="email" name="email" required><br>

    <label for="password">Password:</label>
    <input type="password" name="password" required><br>

    <label for="driver_license">Driver License:</label>
    <input type="text" name="driver_license" required>

    <label for="role">Role: Driver</label>

    <input type="submit" value="Register">
</form>
</body>
</html>

<?php
// Get the buffered content and assign it to $content
$pageContent = ob_get_clean();

// Include the layout
include('../layout.php');
?>
