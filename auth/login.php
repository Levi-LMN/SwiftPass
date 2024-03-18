<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
// Set page title for the layout
$pageTitle = "Login Form";

// Content for the layout
ob_start();
?>

<?php
session_start();
if (isset($_SESSION["user"])) {
    header("Location: ../index.php");
    exit();
}

include 'database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $hashed_password = md5($password);

    $check_user_query = "SELECT * FROM user WHERE email='$email' AND password='$hashed_password'";
    $result = mysqli_query($conn, $check_user_query);

    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

        // Set user information in the session
        $_SESSION['user'] = $user;

        if ($user["role"] == 'admin') {
            $_SESSION['user'] = $user;
            header("Location: ../admin/admin_dashboard.php");
            exit();
        } elseif ($user["role"] == 'sacco admin') {
            $_SESSION['user'] = $user;
            header("Location: ../sacco/sacco_admin_dashboard.php");
            exit();
        } elseif ($user["role"] == 'driver') {
            $_SESSION['user'] = $user;
            header("Location: ../driver/driver_dashboard.php");
            exit();
        } else {
            header("Location: ../index.php");
            exit();
        }
    } else {
        echo "Invalid email or password. Please try again.";
    }
}

// Set page title for the layout
$pageTitle = "Login Form";

// Content for the layout
ob_start();
?>

<div>
    <h2>Login Form</h2>
    <form action="login.php" method="post">
        <div>
            <label for="email">Enter Email:</label>
            <input type="email" id="email" name="email" placeholder="Your email" required>
        </div>
        <div>
            <label for="password">Enter Password:</label>
            <input type="password" id="password" name="password" placeholder="Your password" required>
        </div>

        <div>
            <input type="submit" value="Login" name="login">
        </div>
    </form>
    <div>
        <p>Not registered yet? <a href="registration.php">Register Here</a></p>
    </div>
</div>

<?php
// Get the buffered content and assign it to $content
$pageContent = ob_get_clean();

// Include the layout
include('../layout.php');
?>
