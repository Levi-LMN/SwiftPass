<?php
// Set page title for the layout
$pageTitle = "Dashboard";

// Content for the layout
ob_start();

session_start();
$loggedIn = isset($_SESSION["user"]) && is_array($_SESSION["user"]);

// Retrieve the user's name from the session if logged in
$userName = $loggedIn ? ($_SESSION["user"]["first_name"] . " " . $_SESSION["user"]["last_name"]) : "";
?>


<div class="containerabout">
    <h2 style="color: cornflowerblue; font-size: 30px">About Us</h2>
    <p>Welcome to our transport system! We are dedicated to providing efficient, reliable, and comfortable transportation solutions for our valued passengers. With a focus on safety and convenience, we strive to enhance your travel experience every step of the way.</p>
    <p>Our team is composed of passionate professionals who are committed to delivering exceptional service and ensuring that your journey with us is enjoyable and stress-free. Whether you're commuting to work, exploring the city, or embarking on a new adventure, we're here to make sure you reach your destination with ease.</p>
    <p>At our transport system, we believe in fostering strong connections with our passengers and the communities we serve. We value your feedback and continuously work to improve our services to better meet your needs.</p>
    <p>Thank you for choosing us as your preferred transportation provider. We look forward to serving you and exceeding your expectations!</p>
</div>















<?php
// Get the buffered content and assign it to $content
$pageContent = ob_get_clean();

// Include the layout
include('../layout.php');
?>
