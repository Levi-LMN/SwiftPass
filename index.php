<?php
//user dashboard page
// Set page title for the layout
$pageTitle = "Dashboard";

// Content for the layout
ob_start();

session_start();
$loggedIn = isset($_SESSION["user"]) && is_array($_SESSION["user"]);

// Retrieve the user's name from the session if logged in
$userName = $loggedIn ? ($_SESSION["user"]["first_name"] . " " . $_SESSION["user"]["last_name"]) : "";

// Redirect to the appropriate dashboard based on user role
if ($loggedIn) {
    $userRole = $_SESSION["user"]["role"];
    if ($userRole == 'admin') {
        header("Location: admin/admin_dashboard.php");
        exit();
    } elseif ($userRole == 'sacco admin') {
        header("Location: sacco/sacco_admin_dashboard.php");
        exit();
    } elseif ($userRole == 'driver') {
        header("Location: driver/driver_dashboard.php");
        exit();
    }
}
?>
<!-- Rest of your dashboard content goes here -->



<!-- carousel -->
<div class="carousel" style="margin-top: -20px; font-family: Poppins,serif; font-size: 12px; ">
    <!-- list item -->
    <div class="list">
        <div class="item">
            <img src="https://img.freepik.com/free-photo/traffic-vehicle-urban-reflections-city_1112-973.jpg?w=996&t=st=1709198573~exp=1709199173~hmac=411baf48b2329915de6005ec89148ef08c979f039c4908dfb84678c76c5d2d93">
            <div class="content">
                <div class="author">GiorgioGT</div>
                <div class="title">SWIFTPASS</div>
                <div class="topic">VARIOUS CLASS</div>
                <div class="des">
                    <!-- lorem 50 -->
                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ut sequi, rem magnam nesciunt minima placeat, itaque eum neque officiis unde, eaque optio ratione aliquid assumenda facere ab et quasi ducimus aut doloribus non numquam. Explicabo, laboriosam nisi reprehenderit tempora at laborum natus unde. Ut, exercitationem eum aperiam illo illum laudantium?
                </div>
                <div class="buttons">
                    <button>SEE MORE</button>
                    <button>SUBSCRIBE</button>
                </div>
            </div>
        </div>
        <div class="item">
            <img src="https://img.freepik.com/free-photo/interior-public-bus-transport_53876-63434.jpg?size=626&ext=jpg&ga=GA1.1.1345868282.1709198552&semt=ais">
            <div class="content">
                <div class="author">giorgioGT</div>
                <div class="title">SWIFTPASS</div>
                <div class="topic">Inside</div>
                <div class="des">
                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ut sequi, rem magnam nesciunt minima placeat, itaque eum neque officiis unde, eaque optio ratione aliquid assumenda facere ab et quasi ducimus aut doloribus non numquam. Explicabo, laboriosam nisi reprehenderit tempora at laborum natus unde. Ut, exercitationem eum aperiam illo illum laudantium?
                </div>
                <div class="buttons">
                    <button>SEE MORE</button>
                    <button>SUBSCRIBE</button>
                </div>
            </div>
        </div>
        <div class="item">
            <img src="https://img.freepik.com/premium-photo/bus-with-geometric-shapes-decoration_161488-522.jpg?size=626&ext=jpg&ga=GA1.1.1345868282.1709198552&semt=ais">
            <div class="content">
                <div class="author">giorgioGT</div>
                <div class="title">SWIFTPASS</div>
                <div class="topic">white bus</div>
                <div class="des">
                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ut sequi, rem magnam nesciunt minima placeat, itaque eum neque officiis unde, eaque optio ratione aliquid assumenda facere ab et quasi ducimus aut doloribus non numquam. Explicabo, laboriosam nisi reprehenderit tempora at laborum natus unde. Ut, exercitationem eum aperiam illo illum laudantium?
                </div>
                <div class="buttons">
                    <button>SEE MORE</button>
                    <button>SUBSCRIBE</button>
                </div>
            </div>
        </div>
        <div class="item">
            <img src="https://img.freepik.com/free-photo/close-up-hand-holding-bus-bar_23-2148921682.jpg?w=996&t=st=1709199620~exp=1709200220~hmac=8b43ea30de7150429067595d232cfa09d6139315c71fd5a89325e2246cef5a4b">
            <div class="content">
                <div class="author">giorgioGT</div>
                <div class="title">SWIFTPASS</div>
                <div class="topic">Hand holding bus bar</div>
                <div class="des">
                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ut sequi, rem magnam nesciunt minima placeat, itaque eum neque officiis unde, eaque optio ratione aliquid assumenda facere ab et quasi ducimus aut doloribus non numquam. Explicabo, laboriosam nisi reprehenderit tempora at laborum natus unde. Ut, exercitationem eum aperiam illo illum laudantium?
                </div>
                <div class="buttons">
                    <button>SEE MORE</button>
                    <button>SUBSCRIBE</button>
                </div>
            </div>
        </div>
    </div>
    <!-- list thumnail -->
    <div class="thumbnail">
        <div class="item">
            <img src="https://raw.githubusercontent.com/HoanghoDev/slider_1/main/image/img1.jpg">
            <div class="content">
                <div class="title">
                    Name Slider
                </div>
                <div class="description">
                    Description
                </div>
            </div>
        </div>
        <div class="item">
            <img src="https://raw.githubusercontent.com/HoanghoDev/slider_1/main/image/img2.jpg">
            <div class="content">
                <div class="title">
                    Name Slider
                </div>
                <div class="description">
                    Description
                </div>
            </div>
        </div>
        <div class="item">
            <img src="https://raw.githubusercontent.com/HoanghoDev/slider_1/main/image/img3.jpg">
            <div class="content">
                <div class="title">
                    Name Slider
                </div>
                <div class="description">
                    Description
                </div>
            </div>
        </div>
        <div class="item">
            <img src="https://img.freepik.com/free-photo/close-up-hand-holding-bus-bar_23-2148921682.jpg?w=996&t=st=1709199620~exp=1709200220~hmac=8b43ea30de7150429067595d232cfa09d6139315c71fd5a89325e2246cef5a4b">
            <div class="content">
                <div class="title">
                    Hand holding bus bar
                </div>
                <div class="description">
                    Description
                </div>
            </div>
        </div>
    </div>
    <!-- next prev -->

    <div class="arrows">
        <button id="prev"><</button>
        <button id="next">></button>
    </div>
    <!-- time running -->
    <div class="time"></div>
</div>
<!-- end carousel -->



<div>

    <?php if ($loggedIn): ?>
        <div class="jumbotron">
            <h2>Welcome, <?php echo $userName; ?>!</h2>
            <p class="lead">This is your personalized dashboard.</p>
            <hr class="my-4">
        </div>
        <div class="text-center mt-5">
            <a href="auth/logout.php" class="btn btn-warning">Logout</a>

        </div>

    <?php else: ?>



        <div class="jumbotron">
            <h1 class="display-4">Welcome to Swiftpass!</h1>
            <p class="lead">Explore our features by signing up or logging in.</p>
            <a href="auth/login.php" class="btn btn-warning">Login</a>
            <br><br><br>
            <a href="auth/registration.php" class="btn btn-warning">Register</a>
        </div>


    <?php endif; ?>
</div>


<!--view all schedules-->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2>View All Travel Schedules</h2>
            <p>View all travel schedules available in the system.</p>
            <a href="user/schedules.php" class="btn btn-primary">View Schedules</a>
        </div>
    </div>
</div>

<!--user bookings-->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2>Your Bookings</h2>
            <p>View all your bookings.</p>
            <a href="user/user_bookings.php" class="btn btn-primary">View Bookings</a>
        </div>
    </div>
</div>


<?php
// Get the buffered content and assign it to $content
$pageContent = ob_get_clean();

// Include the layout
include('layout.php');
?>
