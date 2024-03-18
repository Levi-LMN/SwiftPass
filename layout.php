
<?php
// Define the base URL or root path
$baseUrl = '/swiftpass'; // Adjust this based on your project structure

// Define an array of page names and their corresponding paths
$pages = [
    'Home' => '/',
    'About us' => '/user/about-us.php', // Adjust the path accordingly
    'Contact us' => '/user/contact-us.php', // Adjust the path accordingly
    'login' => '/auth/login.php', // Adjust the path accordingly
    'register' => '/auth/register.php', // Adjust the path accordingly
    // Add other pages as needed
];

// Define the active page based on the current file name
$currentFile = $_SERVER["SCRIPT_NAME"];
$currentPage = basename($currentFile);
?>

<?php
// Check if the user is logged in
$loggedIn = isset($_SESSION["user"]);

// Retrieve the total number of bookings
$totalBookings = 0; // Default value

if ($loggedIn) {
    // You may need to include your database connection code here
    include 'auth/database.php';

    // Query to get the total number of bookings for the logged-in user
    $userId = $_SESSION['user']['id'];
    $totalBookingsQuery = "SELECT COUNT(*) as total FROM Ticket WHERE user_id = '$userId'";
    $totalBookingsResult = mysqli_query($conn, $totalBookingsQuery);

    // Check for errors in the query
    if ($totalBookingsResult) {
        $totalBookingsData = mysqli_fetch_assoc($totalBookingsResult);
        $totalBookings = $totalBookingsData['total'];
    }
}
?>

<?php
// Check if the "user" session variable exists
$loggedIn = isset($_SESSION["user"]);


$navItems = [
    'Home' => '/',
    'About us' => '/user/about.php', // Adjust the path accordingly
    'Contact us' => '/user/contact_us.php', // Adjust the path accordingly,
    'User\'s account' => [
        'User\'s profile' => '/profile.php', // Adjust the path accordingly
        'History' => '/user/user_bookings.php', // Adjust the path accordingly
        'Logout' => '/auth/logout.php', // Adjust the path accordingly
    ],
    'Tickets' => '/user/user_bookings.php', // Adjust the path accordingly
    'FAQs' => '/user/FAQs.php'
];
?>


<!-- layout.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<!--    font awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        <?php include "style.css" ?>
    </style>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>



</head>
<body>
<header>
    <!-- Navbar -->

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark w-100 position-fixed border-bottom border-white" style="z-index: 1000">
        <div class="container-fluid">
            <a class="navbar-brand" href="/swiftpass">SwiftPass</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <!-- Dynamic navigation based on login status -->
<?php
foreach ($navItems as $pageTitle => $item) {
    if (is_array($item)) {
        // Handle dropdown menu
        if ($loggedIn) {
            echo "<li class='nav-item dropdown'>
                    <a class='nav-link dropdown-toggle' href='#' role='button' data-bs-toggle='dropdown' aria-expanded='false'>
                        $pageTitle
                    </a>
                    <ul class='dropdown-menu'>";
            foreach ($item as $subPageTitle => $subPagePath) {
                echo "<li><a class='dropdown-item' href='$baseUrl$subPagePath'>$subPageTitle</a></li>";
            }
            echo "</ul></li>";
        }
    } else {
        // Handle regular menu item
        $isActive = ($currentPage === $item) ? 'active' : '';
        if ($loggedIn || $pageTitle === 'SwiftPass') {
            // Check if the current item is 'User\'s account'
            if ($pageTitle === 'User\'s account') {
                // Get the user's name from the session
                $userName = $_SESSION["user_full_name"];
                echo "<li class='nav-item'>
                        <a class='nav-link $isActive' href='$baseUrl$item'>
                            $userName
                        </a>
                      </li>";
            } elseif ($pageTitle === 'Tickets') {
                echo "<li class='nav-item'>
                        <a class='nav-link $isActive' href='$baseUrl$item'>
                            <i class='fas fa-ticket-alt'></i> <sup>$totalBookings</sup>$pageTitle
                        </a>
                      </li>";
            } else {
                echo "<li class='nav-item'>
                        <a class='nav-link $isActive' href='$baseUrl$item'>$pageTitle</a>
                      </li>";
            }
        }
    }
}

                    ?>

                </ul>
                <!-- Search form -->
                <form class="d-flex" role="search" method="GET" action="<?php echo $baseUrl; ?>/search_schedule.php">
                    <input class="form-control me-2" type="search" name="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>


            </div>
        </div>
    </nav>
    <br>
    <br>
    <br>


</header>

<main>
    <!-- This is where the content of individual pages will be inserted -->
    <?php echo $pageContent; ?>
</main>


<br>
<br>
<br>

<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="footer-col">
                <h4>Swiftpass</h4>
                <ul>
                    <li><a href="Aboutus.html">About Us</a></li>
                    <li><a href="#">Bus routes</a></li>
                    <li><a href="#"></a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Get Help</h4>
                <ul>
                    <li><a href="#">FAQ'S</a></li>
                    <li><a href="#">Payment Options</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Online Services</h4>
                <ul>
                    <li><a href="#">Make a booking</a></li>
                    <li><a href="#">Bus Hire</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>follow us</h4>
                <div class="social-links">
                    <a href=""><ion-icon name="logo-facebook"></ion-icon></a>
                    <a href=""><ion-icon name="logo-instagram"></ion-icon></a>
                    <a href=""><ion-icon name="logo-twitter"></ion-icon></a>
                    <a href=""><ion-icon name="logo-linkedin"></ion-icon></a>

                </div>
            </div>
        </div>
        <div class="copyright">
            <p>&copy; 2024 Swiftpass. All rights reserved.</p>
        </div>
    </div>
</footer>

<!-- =========ion icons========= -->
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

<!--fetching script.js using php-->
<script>
    <?php include "script.js" ?>
</script>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.9/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
