<?php
// Include your database connection code here
include '../auth/database.php'; // Update with your actual database connection file

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $saccoName = $_POST['sacco_name'];
    $selectedAdminId = $_POST['admin_id'];

    // Insert data into Sacco table
    $insertSaccoQuery = "INSERT INTO Sacco (name) VALUES ('$saccoName')";

    if (mysqli_query($conn, $insertSaccoQuery)) {
        // Get the ID of the inserted Sacco
        $saccoId = mysqli_insert_id($conn);

        // Update Sacco ID for the selected admin in the User table
        $updateAdminQuery = "UPDATE User SET sacco_id = '$saccoId' WHERE id = '$selectedAdminId'";

        if (mysqli_query($conn, $updateAdminQuery)) {
            echo "Sacco and admin added successfully!";
        } else {
            echo "Error updating Sacco admin: " . mysqli_error($conn);
        }
    } else {
        echo "Error adding Sacco: " . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
} else {
    // Redirect to the add_sacco.php page if the form is not submitted
    header("Location: add_sacco.php");
    exit();
}
?>
