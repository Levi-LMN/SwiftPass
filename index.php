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

    <?php else: ?>

        <!-- carousel -->
        <div class="carousel" style="margin-top: -20px; font-family: Poppins,serif; font-size: 12px; ">
            <!-- list item -->
            <div class="list">
                <div class="item">
                    <img src="img/matwanaculture-20240301-0002.jpg">
                    <div class="content">
                        <div class="author">GiorgioGT</div>
                        <div class="title">SWIFTPASS</div>
                        <div class="topic">CITY CIRCUIT COMMUTE</div>
                        <div class="des">
                            <!-- lorem 50 -->
                            Hop on board our City Circuit Commute for a seamless journey around Nairobi's bustling metropolis. From the vibrant streets of the Central Business District to the leafy suburbs of Karen and Westlands, explore the heart of the city with convenience and ease.
                        </div>
                        <div class="buttons">
                            <button>SEE MORE</button>
                            <button>SUBSCRIBE</button>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <img src="img/matwanaculture-20240301-0001.jpg">
                    <div class="content">
                        <div class="author">giorgioGT</div>
                        <div class="title">SWIFTPASS</div>
                        <div class="topic">SUBURBAN SHUTTLE SERVICES</div>
                        <div class="des">
                            Experience Nairobi's suburban charm with our Suburban Shuttle Service. Travel to iconic destinations like the Nairobi National Park, Giraffe Centre, and Karen Blixen Museum while enjoying comfortable and reliable transportation.
                        </div>
                        <div class="buttons">
                            <button>SEE MORE</button>
                            <button>SUBSCRIBE</button>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <img src="img/matwanaculture-20240301-0003.jpg">
                    <div class="content">
                        <div class="author">giorgioGT</div>
                        <div class="title">SWIFTPASS</div>
                        <div class="topic">MATATU MAGIC</div>
                        <div class="des">
                            Embark on a thrilling adventure through Nairobi's vibrant neighborhoods with our Matatu Magic Tour. Discover hidden gems, local markets, and cultural hotspots as you ride in style aboard Nairobi's iconic minibusses.
                        </div>
                        <div class="buttons">
                            <button>SEE MORE</button>
                            <button>SUBSCRIBE</button>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <img src="img/matwanaculture-20240301-0004.jpg">
                    <div class="content">
                        <div class="author">giorgioGT</div>
                        <div class="title">SWIFTPASS</div>
                        <div class="topic">EXPRESSWAY EXCURSION</div>
                        <div class="des">
                            Take the fast lane to adventure with our Expressway Excursion. Zoom along Nairobi's expressways to reach popular destinations such as Jomo Kenyatta International Airport, Thika Road Mall, and Two Rivers Mall in record time.
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
                    <img src="img/matwanaculture-20240301-0002.jpg">
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
                    <img src="img/matwanaculture-20240301-0001.jpg">
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
                    <img src="img/matwanaculture-20240301-0003.jpg">
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
                    <img src="img/matwanaculture-20240301-0004.jpg">
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




<?php
// Get the buffered content and assign it to $content
$pageContent = ob_get_clean();

// Include the layout
include('layout.php');
?>
