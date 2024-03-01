<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: ../index.php");
    exit();
}
// Set page title for the layout
$pageTitle = "Dashboard";

// Content for the layout
ob_start();

$user = $_SESSION['user'];

if ($user["role"] != 'admin') {
    header("Location: ../index.php");
    exit();
}
?>


<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2 class="mb-4">Hello <?php echo $user['first_name']; ?>, welcome to the admin panel</h2>
            <!-- Other content for the admin dashboard -->
            <hr>
            <div class="row">
                <!--logout-->
                <div class="col-md-6 col-lg-3 mb-4">
                    <div class="card border-primary h-100">
                        <div class="card-body d-flex flex-column justify-content-between">
                            <h5 class="card-title">Logout</h5>
                            <p class="card-text">Click here to logout from the admin panel.</p>
                            <a href="../auth/logout.php" class="btn btn-primary mt-auto">Logout</a>
                        </div>
                    </div>
                </div>
                <!--all users-->
                <div class="col-md-6 col-lg-3 mb-4">
                    <div class="card border-success h-100">
                        <div class="card-body d-flex flex-column justify-content-between">
                            <h5 class="card-title">All Users</h5>
                            <p class="card-text">View all users registered in the system.</p>
                            <a href="users.php" class="btn btn-success mt-auto">All Users</a>
                        </div>
                    </div>
                </div>
                <!--change user roles-->
                <div class="col-md-6 col-lg-3 mb-4">
                    <div class="card border-info h-100">
                        <div class="card-body d-flex flex-column justify-content-between">
                            <h5 class="card-title">Change User Roles</h5>
                            <p class="card-text">Change the roles of existing users.</p>
                            <a href="change_user_roles.php" class="btn btn-info mt-auto">Change User Roles</a>
                        </div>
                    </div>
                </div>
                <!--add sacco-->
                <div class="col-md-6 col-lg-3 mb-4">
                    <div class="card border-warning h-100">
                        <div class="card-body d-flex flex-column justify-content-between">
                            <h5 class="card-title">Add Sacco</h5>
                            <p class="card-text">Add a new Sacco to the system.</p>
                            <a href="add_sacco.php" class="btn btn-warning mt-auto">Add Sacco</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
// Get the buffered content and assign it to $content
$pageContent = ob_get_clean();

// Include the layout
include('../layout.php');
?>
