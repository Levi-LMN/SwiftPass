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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <style>
        /* Prefix all CSS selectors with .contact-us to avoid conflicts */
        .contact-us body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .contact-us .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .contact-us h1 {
            text-align: center;
        }
        .contact-us .contact-form {
            margin-top: 20px;
        }
        .contact-us .form-group {
            margin-bottom: 20px;
        }
        .contact-us label {
            font-weight: bold;
        }
        .contact-us input[type="text"],
        .contact-us input[type="email"],
        .contact-us textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .contact-us textarea {
            height: 150px;
            resize: vertical;
        }
        .contact-us input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
        }
        .contact-us input[type="submit"]:hover {
            background-color: #0056b3;
        }
        .contact-us .success-message {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
            border-radius: 4px;
            padding: 10px;
            margin-top: 20px;
            display: none;
        }
    </style>
</head>
<body>

<div class="contact-us">
    <div class="container">
        <h1>Contact Us</h1>

        <!-- Success message section -->
        <div class="success-message" id="success-message">
            Thank you for contacting us! We will get back to you soon.
        </div>

        <div class="contact-form">
            <form action="#" method="post">
                <div class="form-group">
                    <label for="name">Your Name:</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="email">Your Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="message">Message:</label>
                    <textarea id="message" name="message" required></textarea>
                </div>
                <div class="form-group">
                    <input type="submit" value="Submit" id="submit-btn">
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Include jQuery for easier handling of DOM manipulation -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        // Submit form handling
        $(".contact-us form").submit(function(event){
            // Prevent default form submission
            event.preventDefault();

            // You can add your form submission logic here
            // For demonstration, let's show the success message
            $(".contact-us .success-message").fadeIn(); // Show the success message
            $(".contact-us form")[0].reset(); // Reset the form fields
        });
    });
</script>

</body>
</html>



<?php
// Get the buffered content and assign it to $content
$pageContent = ob_get_clean();

// Include the layout
include('../layout.php');
?>
