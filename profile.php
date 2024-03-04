<?php
session_start();

// Set page title for the layout
$pageTitle = "Profile";

// Content for the layout
ob_start();

// Check if the user is logged in
if (!isset($_SESSION["user"])) {
    header("Location: ../login.php"); // Redirect to the login page if not logged in
    exit();
}

// Include your database connection code
include 'auth/database.php';

// Retrieve the user ID from the session
$user_id = $_SESSION['user']['id'];

// Fetch user details from the database based on the user ID
// Example: SELECT * FROM user WHERE id = $user_id
// Use your database connection and query accordingly
$query = "SELECT * FROM user WHERE id = $user_id";
$result = mysqli_query($conn, $query);

// Check if the query was successful
if ($result) {
    // Fetch user details as an associative array
    $user = mysqli_fetch_assoc($result);
} else {
    die("Error fetching user details: " . mysqli_error($conn));
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <title>User Profile</title>
    <style>
        .body{
            background-color: black;
        }
        /* Custom styles for the profile card */
        .profile-card {
            perspective: 1000px;
            position: relative;
            color: #eeeeee;
            background-color: #eeeeee;
        }

        .card-inner {
            transform-style: preserve-3d;
            transition: transform 0.6s;
        }

        .profile-card.flipped .card-inner {
            transform: rotateY(180deg);
        }

        .card-side {
            position: absolute;
            width: 100%;
            height: 100%;
            backface-visibility: hidden;
        }

        .profile-card .card-front {
            transform: rotateY(0deg);
        }

        .profile-card .card-back {
            transform: rotateY(180deg);
        }

        .profile-card .card-header {
            background-color: #343a40;
            color: #fff;
            border-bottom: none;
            text-align: center;
            padding: 20px 0;
        }

        .profile-card .card-body {
            text-align: center;
        }

        .profile-card .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            transition: background-color 0.3s ease;
        }

        .profile-card .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        /* Update Modal styles */
        .modal-header {
            background-color: #343a40;
            color: #fff;
            border-bottom: none;
            text-align: center;
            padding: 15px 0;
        }

        .modal-footer {
            border-top: none;
        }
    </style>
</head>

<body class="body">

<div class="container mt-5">
    <div class="card profile-card" id="profileCard">
        <div class="card-inner">
            <!-- Front side of the card (User Details) -->
            <div class="card-side card-front">
                <div class="card-header">
                    <h1>User Profile</h1>
                </div>
                <div class="card-body" >
                    <!-- Display user details -->
                    <p class="card-text" style="color: white"><strong>Name:</strong> <?php echo $user['first_name'] . ' ' . $user['last_name']; ?></p>
                    <p class="card-text" style="color: white"><strong>Email:</strong> <?php echo $user['email']; ?></p>
                    <!-- Button to flip the card -->
                    <button type="button" class="btn btn-primary" onclick="flipCard()">Update Details</button>
                </div>
            </div>

            <!-- Back side of the card (Update Details Form) -->
            <div class="card-side card-back">
                <div class="modal-header">
                    <h4 class="modal-title">Update User Details</h4>
                </div>
                <div class="modal-body">
                    <!-- Add a form for updating user details -->
                    <form action="update_profile.php" method="post">
                        <!-- Add input fields for the user to update their details -->
                        <div class="form-group">
                            <label for="updateFirstName">First Name:</label>
                            <input type="text" class="form-control" id="updateFirstName" name="updateFirstName" value="<?php echo $user['first_name']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="updateLastName">Last Name:</label>
                            <input type="text" class="form-control" id="updateLastName" name="updateLastName" value="<?php echo $user['last_name']; ?>">
                        </div>
                        <!-- Add other fields as needed -->

                        <!-- Modal Footer with Update button -->
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <button type="button" class="btn btn-secondary" onclick="flipCard()">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS and Popper.js -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

<script>
    function flipCard() {
        var card = document.getElementById('profileCard');
        card.classList.toggle('flipped');
    }
</script>

</body>

</html>



<?php
// Get the buffered content and assign it to $content
$pageContent = ob_get_clean();

// Include the layout
include('layout.php');
?>
