<?php
// Set page title for the layout
$pageTitle = "All users";

// Content for the layout
ob_start();
?>

<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: ../index.php");
    exit();
}

require_once "../auth/database.php";

if(isset($_GET['delete_user'])){
    $user_id = mysqli_real_escape_string($conn, $_GET['delete_user']);
    // Perform the deletion query using prepared statement
    $delete_sql = "DELETE FROM user WHERE id = ?";
    $stmt = mysqli_prepare($conn, $delete_sql);
    mysqli_stmt_bind_param($stmt, "i", $user_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}


$sql = "SELECT * FROM user";
$result = mysqli_query($conn, $sql);
?>


<div class="container">
    <h2>User List</h2>
    <?php
    if (mysqli_num_rows($result) > 0) {
        echo "<table class='table'>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>";

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['first_name']}</td>
                    <td>{$row['last_name']}</td>
                    <td>{$row['email']}</td>
                    <td>{$row['role']}</td>
                    <td>
                        <a href='?delete_user={$row['id']}' class='btn btn-danger btn-sm'>Delete</a>
                    </td>
                  </tr>";
        }

        echo "</tbody></table>";
    } else {
        echo "<div class='alert alert-info'>No users found</div>";
    }

    mysqli_close($conn);
    ?>
    <br>
    <a href="../auth/logout.php" class="btn btn-danger">Logout</a>
    <br>
    <a href="admin_dashboard.php" class="btn btn-danger">Back to admin dashboard</a>
</div>

<?php
//// Get the buffered content and assign it to $content
//$pageContent = ob_get_clean();
//
//// Include the layout
//include('../layout.php');
//?>
