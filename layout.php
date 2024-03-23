<?php
// Define the base URL or root path
$baseUrl = '/swiftpass'; // Adjust this based on your project structure

// Define an array of page names and their corresponding paths
$pages = [
    'Home' => '/',
    'About us' => '/user/about.php', // Adjust the path accordingly
    'Contact us' => '/user/contact-us.php', // Adjust the path accordingly
    'login' => '/auth/login.php', // Adjust the path accordingly
    'register' => '/auth/register.php', // Adjust the path accordingly
    // Add other pages as needed
];

// Define the active page based on the current file name
$currentFile = $_SERVER["SCRIPT_NAME"];
$currentPage = basename($currentFile);

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

    <style>
        <?php include "style.css" ?>
    </style>
</head>
<body>

<div class="navbar">
    <a href="<?php echo $baseUrl; ?>" class="navbar-brand">Swiftpass</a>
    <div class="navbar-links">
        <?php foreach ($navItems as $label => $link) : ?>
            <?php if (is_array($link)) : ?>
                <div class="dropdown">
                    <button class="dropbtn"><?php echo $label; ?></button>
                    <div class="dropdown-content">
                        <?php foreach ($link as $subLabel => $subLink) : ?>
                            <a href="<?php echo $baseUrl . $subLink; ?>"><?php echo $subLabel; ?></a>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php else : ?>
                <a href="<?php echo $baseUrl . $link; ?>"><?php echo $label; ?></a>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
</div>

<main>
    <!-- This is where the content of individual pages will be inserted -->
    <?php echo $pageContent; ?>
</main>

<br>
<br>
<br>

<footer>
    <div class="footer-container">
        <p>&copy; 2024 Swiftpass. All rights reserved.</p>
        <ul class="footer-links">
            <?php foreach ($pages as $label => $link) : ?>
                <li><a href="<?php echo $baseUrl . $link; ?>"><?php echo $label; ?></a></li>
            <?php endforeach; ?>
            <li><a href="<?php echo $baseUrl; ?>/privacy-policy.php">Privacy Policy</a></li> <!-- Example of an external link -->
        </ul>
    </div>
</footer>


</body>
</html>
