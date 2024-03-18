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
ini_set('display_errors', 1);
error_reporting(E_ALL);
// Set page title for the layout
$pageTitle = "Registration Form";

// Content for the layout
ob_start();
?>


<?php
// Include database configuration
include 'database.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve user inputs
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role']; // Selected role from the dropdown

    // Hash the password
    $hashed_password = md5($password);

    // Insert user data into the User table
    $insert_user_query = "INSERT INTO user (first_name, last_name, email, password, role)
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





<div>
    <h2>Registration Form</h2>
    <form action="registration.php" method="post">
        <div>
            <label for="first_name">Enter First Name:</label>
            <input type="text" name="first_name" placeholder="First Name" required>
        </div>
        <div>
            <label for="last_name">Enter Last Name:</label>
            <input type="text" name="last_name" placeholder="Last Name" required>
        </div>
        <div>
            <label for="email">Enter Email:</label>
            <input type="email" name="email" placeholder="Email" required>
        </div>
        <div>
            <label for="password">Enter Password:</label>
            <input type="password" name="password" placeholder="Your password" required>
        </div>
        <div>
            <label for="repeat_password">Repeat Password:</label>
            <input type="password" name="repeat_password" placeholder="Repeat Password">
        </div>
        <div>
            <select name="role">
                <option value="admin">Admin</option>
                <option value="user">User</option>
                <option value="sacco admin">Sacco admin</option>
                <option value="driver">Driver</option>
            </select>
        </div>
        <div>
            <button type="submit" name="submit">Register</button>
        </div>
    </form>
    <div>
        <p>Already Registered? <a href="login.php">Login Here</a></p>
    </div>
</div>

<?php
// Get the buffered content and assign it to $content
$pageContent = ob_get_clean();

// Include the layout
include('../layout.php');
?>
