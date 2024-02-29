<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: ../index.php");
    exit();
}

include '../auth/database.php'; // Update with your actual file path

// Check if the logged-in user has admin privileges
$user = $_SESSION['user'];
if ($user['role'] !== 'admin') {
    header("Location: ../index.php");
    exit();
}

// Fetch all users from the User table
$get_users_query = "SELECT * FROM User";
$result = mysqli_query($conn, $get_users_query);

// Check if there are users
if ($result && mysqli_num_rows($result) > 0) {
    $users = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
    $users = []; // No users found
}

// Handle form submission to update user roles
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($_POST['roles'] as $userId => $newRole) {
        $update_role_query = "UPDATE User SET role='$newRole' WHERE id=$userId";
        mysqli_query($conn, $update_role_query);
    }

    // Redirect to the same page after updating roles
    header("Location: change_user_roles.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change User Roles</title>
</head>
<body>
<h2>Change User Roles</h2>

<?php if (empty($users)) : ?>
    <p>No users found.</p>
<?php else : ?>
    <form method="post" action="change_user_roles.php">
        <table border="1">
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Current Role</th>
                <th>New Role</th>
            </tr>
            <?php foreach ($users as $user) : ?>
                <tr>
                    <td><?php echo $user['id']; ?></td>
                    <td><?php echo $user['first_name']; ?></td>
                    <td><?php echo $user['last_name']; ?></td>
                    <td><?php echo $user['email']; ?></td>
                    <td><?php echo $user['role']; ?></td>
                    <td>
                        <select name="roles[<?php echo $user['id']; ?>]">
                            <option value="admin" <?php echo ($user['role'] === 'admin') ? 'selected' : ''; ?>>Admin</option>
                            <option value="sacco admin" <?php echo ($user['role'] === 'sacco admin') ? 'selected' : ''; ?>>Sacco Admin</option>
                            <option value="driver" <?php echo ($user['role'] === 'driver') ? 'selected' : ''; ?>>Driver</option>
                            <option value="user" <?php echo ($user['role'] === 'user') ? 'selected' : ''; ?>>User</option>
                            <!-- Add more roles as needed -->
                        </select>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>

        <input type="submit" value="Update Roles">
    </form>
<?php endif; ?>

<!--back to admin dashboard-->
<br>
<a href="admin_dashboard.php">Back to admin dashboard</a>
</body>
</html>
