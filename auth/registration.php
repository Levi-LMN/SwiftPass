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

<div >
    <?php
    if (isset($_POST["submit"])) {
        $fullName = $_POST["fullname"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $passwordRepeat = $_POST["repeat_password"];

        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        $errors = array();

        if (empty($fullName) OR empty($email) OR empty($password) OR empty($passwordRepeat)) {
            array_push($errors,"All fields are required");
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            array_push($errors, "Email is not valid");
        }
        if (strlen($password)<8) {
            array_push($errors,"Password must be at least 8 characters long");
        }
        if ($password!==$passwordRepeat) {
            array_push($errors,"Password does not match");
        }
        require_once "database.php";
        $sql = "SELECT * FROM users WHERE email = '$email'";
        $result = mysqli_query($conn, $sql);
        $rowCount = mysqli_num_rows($result);
        if ($rowCount>0) {
            array_push($errors,"Email already exists!");
        }
        if (count($errors)>0) {
            foreach ($errors as  $error) {
                echo "<div class='alert alert-danger'>$error</div>";
            }
        } else {

            $sql = "INSERT INTO users (full_name, email, password) VALUES (?, ?, ?)";
            $stmt = mysqli_stmt_init($conn);
            $prepareStmt = mysqli_stmt_prepare($stmt,$sql);
            if ($prepareStmt) {
                mysqli_stmt_bind_param($stmt,"sss",$fullName, $email, $passwordHash);
                mysqli_stmt_execute($stmt);
                echo "<div class='alert alert-success'>You are registered successfully</div>";

                // Store success message in session
                $_SESSION["registration_success"] = "You are registered successfully";

                // Redirect to login page
                header("Location: login.php");
                exit(); // Make sure to exit after the header to prevent further execution
            } else {
                die("Something went wrong");
            }
        }
    }
    ?>
    <form action="registration.php" method="post">
        <div >
            <input type="text"  name="fullname" placeholder="Full Name:">
        </div>
        <div >
            <input type="email"  name="email" placeholder="Email:">
        </div>
        <div >
            <input type="password"  name="password" placeholder="Password:">
        </div>
        <div >
            <input type="password"  name="repeat_password" placeholder="Repeat Password:">
        </div>
        <div class="form-btn">
            <input type="submit"  value="Register" name="submit">
        </div>
    </form>
    <div>
        <div><p>Already Registered <a href="login.php">Login Here</a></p></div>
    </div>
</div>

<?php
// Get the buffered content and assign it to $content
$pageContent = ob_get_clean();

// Include the layout
include('../layout.php');
?>
