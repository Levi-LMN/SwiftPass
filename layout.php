
<?php
// Define the base URL or root path
$baseUrl = '/swiftpass'; // Adjust this based on your project structure

// Define an array of page names and their corresponding paths
$pages = [
    'Home' => '/',
    'About us' => '/about-us.php', // Adjust the path accordingly
    'Contact us' => '/contact-us.php', // Adjust the path accordingly
    // Add other pages as needed
];

// Define the active page based on the current file name
$currentFile = $_SERVER["SCRIPT_NAME"];
$currentPage = basename($currentFile);
?>

<?php
$loggedIn = isset($_SESSION["user"]);

$navItems = [
    'Home' => '/',
    'About us' => '/about-us.php', // Adjust the path accordingly
    'Contact us' => '/contact-us.php', // Adjust the path accordingly,
    'User\'s account' => [
        'User\'s profile' => '/user-profile.php', // Adjust the path accordingly
        'History' => '/user-history.php', // Adjust the path accordingly
        'Logout' => '/logout.php', // Adjust the path accordingly
    ],
    'Tickets' => '/tickets.php', // Adjust the path accordingly
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
    <style>
        <?php include "style.css" ?>
    </style>

</head>
<body>
<header>
    <!-- Navbar -->

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark w-100 position-fixed border-bottom border-white">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">SwiftPass</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <?php
                    // Dynamic navigation based on login status
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
                                echo "<li class='nav-item'>
                        <a class='nav-link $isActive' href='$baseUrl$item'>$pageTitle</a>
                      </li>";
                            }
                        }
                    }

                    // Additional links irrespective of login status
                    echo "<li class='nav-item'>
        <a class='nav-link' href='$baseUrl'>Home page</a>
      </li>";

                    // Add login/register dropdown for not logged in users
                    if (!$loggedIn) {
                        echo "<li class='nav-item dropdown'>
                <a class='nav-link dropdown-toggle' href='#' role='button' data-bs-toggle='dropdown' aria-expanded='false'>
                    Login / Register
                </a>
                <ul class='dropdown-menu'>
                    <li><a class='dropdown-item' href='login.php'>Login</a></li>
                    <li><a class='dropdown-item' href='registration.php'>Register</a></li>
                </ul>
              </li>";
                    }
                    ?>
                </ul>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
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

<footer class="footer bg-dark text-light py-2">
    <div class="container text-center">
        <span>&copy; 2024 <a href="https://github.com/Levi-LMN/SwiftPass">SwiftPass</a> All rights reserved. </span>
    </div>
</footer>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
