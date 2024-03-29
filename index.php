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




<div>

    <?php if ($loggedIn): ?>
        <div class="jumbotron">
            <h2>Welcome, <?php echo $userName; ?>!</h2>
            <center>
            <p class="lead">This is your personalized dashboard.</p>
            </center>
            <hr class="my-4">
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














<div style="text-align: center;">
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
</div>

<div class="container mt-5" id="explore">
    <h2 class="text-center mb-4">Explore Kenya's Popular Destination Routes</h2>
    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow">
                <img src="https://pngfre.com/wp-content/uploads/bus-23-1-1024x589.png" class="card-img-top" alt="route 1 Image">
                <div class="card-body">
                    <h5 class="card-title mb-3">Nairobi to Mombasa</h5>
                    <p class="card-text">Discover the beauty of coastal landscapes and vibrant city life on our Nairobi to Mombasa route.</p>
                </div>
                <div class="card-footer bg-transparent border-0">
                    <small class="text-muted">Date: February 25, 2024</small>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow">
                <img src="https://assets.volvo.com/is/image/VolvoInformationTechnologyAB/BS%20VI%20Bus%20Single%20Axcel_Single%20Bus?wid=1400&fit=constrain" class="card-img-top" alt="route 2 Image">
                <div class="card-body">
                    <h5 class="card-title mb-3">Nakuru to Kisumu</h5>
                    <p class="card-text">Embark on a scenic journey from Nakuru to Kisumu, surrounded by the breathtaking views of the Great Rift Valley.</p>
                </div>
                <div class="card-footer bg-transparent border-0">
                    <small class="text-muted">Date: March 10, 2024</small>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow">
                <img src="data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wCEAAoHCBQSEhgSEhYSEhUYEhIYEhIYGRkYERISGBgZGRgUGBgcIC4lHB4rHxgYJjgmKy8xNTU1GiQ7QDszPy42NTEBDAwMEA8QHBISGjQrISs0NDE0MTQ0MTQ0NDQ0MTQ0OjQxPTQ0NDQ0NDQxNDE0NDQ0NDQ0NDQ0NDQ0NDQ0MTQ0NP/AABEIAKkBKwMBIgACEQEDEQH/xAAcAAEAAQUBAQAAAAAAAAAAAAAABAECAwUHBgj/xABGEAACAQIDAwgGBwUGBwEAAAABAgADEQQSIQUxUQYTIjJBYXGBB0KRobHBFFJictHh8BVDU4KSJDOywtLxIzREc5Oiwxb/xAAXAQEBAQEAAAAAAAAAAAAAAAAAAQID/8QAIhEBAQACAQQBBQAAAAAAAAAAAAECESESMUFREwMyYXGB/9oADAMBAAIRAxEAPwDs0REBERAREQEREBERAREQEREBERAREQEREBERAREQEREBERAREQEREBERAREQEREBERAREQEREBERARE83yn5W0MEjFnQuNAt9A32j8hrA3WMxlOiuao6oOy+89wG8+U0WJ5ZUF6iu3jZQfifdOS7T5bLVYu7u7HgrWA4C9gBNW/KlDuWof6fkTDUxnmutYjly3qU0X7xLfC019flviDuKL4KP815yx+U/CmT4uB8FMl4HbdOp1yKTcHIynwbQe20jcmPt7qryvxbbqhHgqD5Rh+U2MBvzrHxyke8TSbGahVfK1akgsemWzDw6N5grYpM7Ijq9idQb6cfCNtdM7R7vC8tKyj/AIi06nnkJ8xce6bzZ/LDD1dGz0mFsyuL2J71vp37pxXG7ap0zYks31V1I8ewectwfKhD1sy8Lj5i8MXHH2+icPiEcXRlccVIPwmecLwG3lJuj6jtU6jzE9NgOV9dPXFQcG6Xv3++Vm4102J5PB8s0bSojL9pDmHsNiPfN7hNr0KvUqIT9Umzew74TTYRKSsIREQEREBERAREQEREBERAREQEREBERAREQKTCuJQnKHQt9UMC3svOa+kbb+Iq4hNlYEsKlRsrlTZj0czC9xZQu/Xjwnndr+hzEpRWph6y4iv+9pt0F7jTcnW3fa+/TdC3h0Pl/wAqW2fTRaaq1Wqz2DEgLTUDM2m83ZRa43k9k4PtXGPXfM7ZjrlHqrffYfPfMW1zjMNWahi2qO9OysrvzioCFYKrXIGhGgMjc6D0hqIRiej3zJTw2ksNQk7p6VNiaav/AOlviYHnXogAmYUGonrE2IgIJZ2sQbdHKbG9jpumStgKC9M01FteiLXPgLXgRNlbNVFD1bljqKdyFUdl7akxXxlOmzKi00fIWyjNuAJ33tfumdK/O3VGZDvLFd3kRYzz74ZebatUZnYl1XvYmwa3t7pHa6nEQcZZajAEnUG53ksAxv5mY0aDSHa1vEQaRXW4PhvlcWUGTKG0KidV28D0h7901waXBoNvRYblLUXrAMO42Pvv8puMNypQ6PmXx/K88QGl4eGt11jZXK10saVa4HqMcyeFr2Hxnp8Ly9Yf3tAuul3oupIP3GI9x8pwNX7e3j2ybh9o1U6rt56+86wblfR+zuVWDrnKlUK38OoGpv5BwL+V5ur33T5qw/KWoLB1Vx+tbH8Z6DZfLU0+o9Sn3XJXzBuINTxXdonOtmekBjbPzdVe1gcr/wCmex2ft7D1wCjqrH92xCuDwtfXyvCWabWIiEIiICIiAiIgIiICIiAiIgJgxdcU6b1DuRGY+Cgn5TPNRyoZxgsRzSu7/R6oREBZ2YqRZQNSdd0DlPo+q/Sduc/Vuz8ziqq7rU2dwpy2G6zuNddZ22ci9Emxa64uriq1GvRUYZaVPnUZC7M4diobfbINe+dN29jOYwtet/Dw9Z/NELD4QPmzlDX56pVcMWz1a7KxNyytUdkJP3SvsmgoN0SOBno8Ds5aikMWAQIotbgd9x4SNitiBKbVFcmwzFSN97X1B74Gtwi5qgHePfp8575p4PAmzZuDL7jebttvt2IntJgegM12OxSnNTU3ZdWHYLjQXmqfb9XsWmPJj/mkL6S7s7gqpfLmst1NhbQE6QNlXxVDDNmR3qhlYf3ZRlNwbG7WO7eDIFUAYQKddPfmmrxrsWAYgkA7hbfNni2/4SLxKX85G8e1/TRqxHH22mVKhtmBNwRwJ18RBr39VPZpLqoGW4AF7aC9vfKw29PbAZFV6VJyqgZmUEm2l/GYFem7WNNRcnVSwt3AXItNdTcAWI7Tr2+EyUaq5gSbAG94E/EUsOL5GrA96oVvwvcH3SlLBB1zK9Pwa6/Ka93BvqNbyTRPQGvrX91oGX6G/Zlb7rKfgZjam6mxVh4gy6hfN5G/haUp1nDGxYdXS5gA0vV5lrVzmNwp1O9R8bSwutzdB2biR2ecCqPbUGx4jQyfh9qVU3OT3HX85CqhQTbMN2mhGovKpTBNgw7baGDb1ezOW+Jo2Cs4A7A3R/oOk9fs30onQVlVu/VG8yLj3TkyodbW0t28ZeAbjv3Qu30Hs/lthKtruaZP1hdb+K399p6GhWWooZGDKdzA3B858uo5GouO8aGdn9EGLaphKqsxYriDa+pClE09oMDoMREIREQEREBERAREQEREBPL+kivk2XiT9ZKaf+SoiH3NPUTw3pdqW2aV+viKC/0sX/yQOT7G6jnjUPuVY2kLYV/+2PlI2zsatNCrK985NwARrbv7phx2INRHRec1RQigALf1s3b+vaGnww6HiT+EysJlo4V1VbjdvhqbcIENpmw/VPjMLo19x9hlVchPMwI1Zenc9pHxtJ+LPQQdwPsW81ea7j7w+M2WL1CDuYd3VtI3j9tam0kP1B5fKVOGb7J8DLiCttATcdE6ht2nfKwiTcYLZgtmqan6vDxmXC4UA52VVY7lXqrp2XJ1k28m3XHHzVBRUCwRLcLC0sbB0zvRfIW+EygxeG9RH/Z9PsDL4M34y39mLe4ZwdN9ju8pLBl14S4z0gvs5z64PitvgZYcBUuT0De3aR8psgZUGGemNZVw9QnqexlMIjKRmRxpr0Sdbd02oMqDCdEadHAzX06tr6ceMyq4zJY+/vm1vKNSQ71U+IEqdLWBvj8jOrehOtcYtOwPQYeLCoD/AIBOdfREPqgeFx8J0X0O0lR8UF0BWgTrfUGp+MJcdOqREQyREQEREBERAREQEREBOc+my/0ClawtjEYk7rCjWHznRpyr02V6OXC0q7VVQtXcmmAzgqEVeizKp1fjfTTtgcbrYtr2yse8j32ImL6Sfqe0flNlTwuBP/W4lDwbC/6axmejs7BswVdoOSSAAcNVJuTYCysSfKBA+lW3InslV2ge1bDiNbeU9HT5MUWc01xzF1ClkGCxeZAwuCwy9EEEG5mDE7DwVNir7VS435cPXcA8Myki/deBo2xD2uqhx2lTcjxW1xLWxNQpoAPLd7Ztv2ds8G/7Ue43FcJVvfzcTX7XSgBejXq4gk6s1EUlsBa/XY3uN1uOsDVm5ILMCb6Aa6+WgkraJGVL/av7rfCMBgiekR90fM8JTaKkkAC/hw0/KR0mNmNqBpwM2eApZHViBchtD2afHUzFhqOSxIBb/D+czpWDOCNwzC/Yd0JjNd2z+kHgvsj6R3CR3GVitwbEi4N1Nja4PaJRAToASeAF4ddJQxHcPd+EquI+yP15SKTbQ6SitBpM5/7Ky4Vx9VffIl4DQaTOeH1RHOL9WRc0qGhEvOvCUzjhI4aVzaQJOYSoaRaldVsWbLc2G/f8oq4hUtnNrmw8fwhKlZvD9eU6N6Hzd8SdD0MPqN2pqfhOaFtDOj+hQ/8AND7GF+NeGcuzqsRErmREQEREBERASl5Rt0x5oGW8XmLNGaBlvONelpFxOLFFjbJQXI3arsWJPeCCoP3e6dfzTjXpSYrjmcL+7w4L9huH6PllB3+v7ZWsO/Lmj7ErK1ihZb9ZbNccQL/GSMNzlB1elhnurAhnDs/llAUC3cSL75sk2ieHvkvC4/MwBB1PGNuvxStHtXE4nEnVKy0xkCUAG5qmEUKLKAFBsutlAuTYDdNZ+z6/8Kr/AEN+E6L9Mtxlj47xjafF+XhsPsPEOdKbr3sCgHf0rTf4LYqUQM5FRxbQC4DHUKq+se253DWw3zZvj+785bicF/YxiGaoHq1agQqSAtBOiTp2u5J1+oYW4448tXjGsLNZfsA627z2maV3u9+5viIxaBG0BBsASes17m590wVToT9kwty3jtZicRforu7Tx/KZqCZCo7crX8Tb/aRMMlzmO4e89gkxblwL2Njv4kiK54y3lJDS7E0XZbI1gOwaZm4k/CWKlmFyL6f7zoWK5FZKChiUxJW+ViCpJ1WxDWAOosRe6k6C0Rr6ls4c1weIJJViSRuJ36b1P64yUrfrt9si4xcmIFwQTbMNxB1Uj3TOKg4CKmN3GUNKhpR6gAGVlYkXICkZD9U33nwlgqnjDTOCZXWYedBFtc1zc5tCOwZbaeN5bmk2JIPhK5tN8itiV7SosLeqNB2m289++YzjlHbfwBlTcbttnO+FeoR0ecZCCNQwAN9fEHyMtfY7VdmHFhgcrEMnbZVTpDgbsdOE3mwNoUv2ViRVZc+a9NWPSYuV6QH2VVr8LzV7Axf9kOGqVFSlWKI7HNejTzhnZbA3YgEAcTrpvrnbzWtpvemDfUqNNb3InTvQnSb+0OQ2UrRXMQQucNVJQE6EgFSbbsw4yHsXk9sfo3r4jE2y9FmCIbdlkQG3806TgtoUERUpBERQAiqAqqvAAbpC5cabqJrxtFZcMcJWU6JC+liSwbi/dAuiIgIiIFr7j4GRc8kVuq33T8Jqy8CUakoasil5YXhdJZrTlPpHxxWrXwzIjmpTpV6J/eCwCMBbf/dvob6HSxvOkmpNJtnk3hMY61MRTZ3VQqsKlRcoBJFgrAXuTra8LOK+cq9RixzXFja3Dulq1CDoSPAz6Aqci8Ewtlqeb5z7XDSDU9HeBO7nB5Uvkghf64n9PqDc7/1N+MlYba7qekSy9tySfG5nXKno7wf2R3lf9LLNfX9HWGGoqUB3MtQf/b5SEtnl4pMRntku2Y6Aan9DT2ToOOfApSpo71HCUaSBKYC2KhmbpNfezMerPHbf2c+CI+j1MJUUix5nKtRTr1g5LW3agzQV661QAxqobajMGS/aT0r+6TTdsy8pO2tpI9VzQQIpOmY53UAAWzEd3CalnANiM2muttb90y42sHKntVFQFcoBy7if12SCW8PjGjqmtJZxPYAoA3DsHhKU8QQ4aykjUAqGXs3qdD5yJn75erDtzHzl0nXPDZYbEFq6O1rlwTYBV0HYqgAbuydd5PbUo4hW6OQUwoSne/N5dLdt9F4+t3icTwVTK4zeXj+vjPWUcfamyoiBnXK9QA84yk3K3vbXcTa9tL77pNMZZdV20nKF8+KZkBILuwtroXYg98wLTc+qfMgfO82qbOrVGzJTa+7Nl1t4zb4PkjiH3rl8fylJlZ2eXXDN2lR5k/ITIuEP1j5AD43nQcJyDb949vATdYXkXQTrXaDdcl/ZzHcz/rwmSnyZrP1Q7fymdtw2w6FPqovsmwTDqu5QPKDVcTw3o+xT9igd5Im4w/osc9erl8BedYCyuWDTwezfRxSpqUqValRCDdNEBv3jWb7Z3JLB0BZKS/zkv7MxNp6ALKhYNI9PCovVRV8ABMoSZQsuCwMQpy8JMgWVCwMYWb6l1R90fCae03NPqjwHwhKviIhCIiBirdRvun4TVlZtqvVPgZrysCOVmJhJZWYykKg1GtIGJxbr1ULTdGjLGwsDxuN2zil6lIeJM89jtvY87hl8AZ084IcJY2zlO8CFcTxm08c3Wep5AiabEHEP1mqHxvPoFtj0zvRfYJYdhUfqL7IR85Pg6x7GMxHAVfqmfRzcn6B3ovslP/zuH/hp7IHzsmyqrbkb2Sdh+TGIf1G9k+gE2JSXcijymRdnINyj2QOIYXkLWfrC03eE9HI9dm8p1gYNeAl30UQOe0PR5hfXVn/mIPtFpvNnclsJQIanRTMNzMWdh4FybT0/0YQKECElFRuVR5CXhRwkvmJXmYEULLgsk81K83AjBJcEkjm5UJC7RwkuCTPklckIwBJULM+WMsDEFlQJlySuSBjtK5ZkySoSBjtNtT3DwHwmuyzZJuHgIRdERAREQLX3HwMi5ZLluQcIEXLKZZLyDhHNjhAh5JTJJvNjhHNjhAhZJTLJ3NjhKc0vCBCyymWTuaXhHNLwgQcspkk/ml4RzS8IEDJGST+aXhHNLwgQMkplmw5leEcyvCBr8sZZsOZXhHMrwga/LGWbDmV4RzK8IEDJGST+ZXhHMrwgQMkZJP5leEcyvCBByxlk7ml4RzS8IEHLK5ZN5peEc0vCBCyxlk3ml4RzS8IEO0uyyXzY4RzY4QImWTF3DwEpzY4S6BWIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgf/Z" class="card-img-top" alt="route 3 Image">
                <div class="card-body">
                    <h5 class="card-title mb-3">Kisii to Eldoret</h5>
                    <p class="card-text">Experience the cultural richness as you travel from Kisii to Eldoret, a journey filled with diverse traditions and landscapes.</p>
                </div>
                <div class="card-footer bg-transparent border-0">
                    <small class="text-muted">Date: March 18, 2024</small>
                </div>
            </div>
        </div>
    </div>
</div>



<?php
// Get the buffered content and assign it to $content
$pageContent = ob_get_clean();

// Include the layout
include('layout.php');
?>
