<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error Page</title>
</head>
<body>
<h1>Error</h1>
<?php
// Retrieve error message from the URL parameter
$errorMessage = isset($_GET['message']) ? $_GET['message'] : 'An error occurred.';
echo "<p>$errorMessage</p>";
?>
<p><a href="../index.php">Go back to the main page</a></p>
</body>
</html>
