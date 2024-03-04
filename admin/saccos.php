<?php
// Include your database connection code
include '../auth/database.php';

// SQL query to retrieve Saccos and their assigned Sacco admins
$sql = "SELECT s.id AS sacco_id, s.name AS sacco_name, u.id AS admin_id, u.first_name AS admin_first_name, u.last_name AS admin_last_name
        FROM sacco s
        LEFT JOIN user u ON s.id = u.sacco_id
        WHERE u.role = 'sacco admin'";

// Execute the SQL query
$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

// Set page title for the layout
$pageTitle = "All saccos";

// Content for the layout
ob_start();
?>

<div class="container mt-5">
    <h2>Saccos and their Assigned Sacco Admins</h2>

    <?php
    // Check if there are results
    if ($result && mysqli_num_rows($result) > 0) {
        ?>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Sacco ID</th>
                <th>Sacco Name</th>
                <th>Admin ID</th>
                <th>Admin Name</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
            // Output data of each row
            while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <tr>
                    <td><?php echo $row["sacco_id"]; ?></td>
                    <td><?php echo $row["sacco_name"]; ?></td>
                    <td><?php echo $row["admin_id"]; ?></td>
                    <td><?php echo $row["admin_first_name"] . " " . $row["admin_last_name"]; ?></td>
                    <td>
                        <form action="delete_sacco.php" method="post">
                            <input type="hidden" name="sacco_id" value="<?php echo $row['sacco_id']; ?>">
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this Sacco?')">Delete</button>
                        </form>
                    </td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
        <?php
    } else {
        echo "<p>No results found</p>";
    }
    ?>
</div>

<?php
mysqli_close($conn);

// Get the buffered content and assign it to $content
$pageContent = ob_get_clean();

// Include the layout
include('../layout.php');
?>
