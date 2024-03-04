<?php
// Set page title for the layout
$pageTitle = "Dashboard";

// Content for the layout
ob_start();

session_start();
$loggedIn = isset($_SESSION["user"]) && is_array($_SESSION["user"]);

// Retrieve the user's name from the session if logged in
$userName = $loggedIn ? ($_SESSION["user"]["first_name"] . " " . $_SESSION["user"]["last_name"]) : "";
?>

<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Contact Us Today!</h5>
        </div>
        <div class="card-body">
            <form class="form-horizontal" action=" " method="post" id="contact_form">

                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-4 control-label">First Name</label>
                    <div class="col-md-8">
                        <input name="first_name" placeholder="First Name" class="form-control" type="text">
                    </div>
                </div>

                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-4 control-label">Last Name</label>
                    <div class="col-md-8">
                        <input name="last_name" placeholder="Last Name" class="form-control" type="text">
                    </div>
                </div>

                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-4 control-label">E-Mail</label>
                    <div class="col-md-8">
                        <input name="email" placeholder="E-Mail Address" class="form-control" type="text">
                    </div>
                </div>

                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-4 control-label">Phone #</label>
                    <div class="col-md-8">
                        <input name="phone" placeholder="(845)555-1212" class="form-control" type="text">
                    </div>
                </div>

                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-4 control-label">Address</label>
                    <div class="col-md-8">
                        <input name="address" placeholder="Address" class="form-control" type="text">
                    </div>
                </div>

                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-4 control-label">City</label>
                    <div class="col-md-8">
                        <input name="city" placeholder="City" class="form-control" type="text">
                    </div>
                </div>

                <!-- Select Basic -->
                <div class="form-group">
                    <label class="col-md-4 control-label">State</label>
                    <div class="col-md-8">
                        <select name="state" class="form-control selectpicker">
                            <option value=" ">Please select your state</option>
                            <option>Alabama</option>
                            <option>Alaska</option>
                            <option>Arizona</option>
                            <!-- Add more options as needed -->
                        </select>
                    </div>
                </div>

                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-4 control-label">Zip Code</label>
                    <div class="col-md-8">
                        <input name="zip" placeholder="Zip Code" class="form-control" type="text">
                    </div>
                </div>

                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-4 control-label">Website or Domain Name</label>
                    <div class="col-md-8">
                        <input name="website" placeholder="Website or Domain Name" class="form-control" type="text">
                    </div>
                </div>

                <!-- Radio checks -->
                <div class="form-group">
                    <label class="col-md-4 control-label">Do you have hosting?</label>
                    <div class="col-md-8">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="hosting" value="yes">
                            <label class="form-check-label">Yes</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="hosting" value="no">
                            <label class="form-check-label">No</label>
                        </div>
                    </div>
                </div>

                <!-- Text area -->
                <div class="form-group">
                    <label class="col-md-4 control-label">Project Description</label>
                    <div class="col-md-8">
                        <textarea class="form-control" name="comment" placeholder="Project Description"></textarea>
                    </div>
                </div>

                <!-- Success message -->
                <div class="alert alert-success" role="alert" id="success_message">Success <i class="glyphicon glyphicon-thumbs-up"></i> Thanks for contacting us, we will get back to you shortly.</div>

                <!-- Button -->
                <div class="form-group">
                    <div class="col-md-8 offset-md-4">
                        <button type="submit" class="btn btn-warning">Send <span class="glyphicon glyphicon-send"></span></button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>

<?php
// Get the buffered content and assign it to $content
$pageContent = ob_get_clean();

// Include the layout
include('../layout.php');
?>
