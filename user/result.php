<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Result Page</title>
</head>
<body>
<h1>Booking Result</h1>
<?php
// Retrieve result message from the URL parameter
$resultMessage = isset($_GET['message']) ? $_GET['message'] : 'No result message.';
echo "<p>$resultMessage</p>";


?>


<p><a href="schedules.php">Book another seat</a></p>





</body>
</html>
