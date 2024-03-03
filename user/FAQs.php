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

    <section>
        <div class="">
            <ul class="faq-list">
                <li>
                    <h4 class="faq-heading">  How do I book a seat on a matatu? </h4>
                    <p class="read faq-text">
                        You can easily book a seat on a matatu through our mobile app or website. Simply select
                        your desired route, choose the date and time of travel, and proceed with the booking
                        process. You can pay securely online or choose cash on delivery option.
                    </p>
                </li>
                <li>
                    <h4 class="faq-heading"> What routes do your matatus cover in Nairobi? </h4>
                    <p class="read faq-text">
                        Our matatus cover a wide range of routes within Nairobi, including popular
                        destinations such as CBD, Westlands, Kasarani, Lang'ata, and more. You can check the
                        list of available routes on our app or website.
                    </p>
                </li>
                <li>
                    <h4 class="faq-heading">Are your matatus safe and well-maintained? </h4>
                    <p class="read faq-text">
                        es, safety and maintenance are our top priorities. All our matatus undergo regular
                        maintenance checks and adhere to strict safety standards. We ensure that our drivers
                        are trained professionals with valid licenses and our vehicles are equipped with
                        necessary safety features.
                    </p>
                </li>
                <li>
                    <h4 class="faq-heading">
                        Can I track the location of the matatu I booked?
                    </h4>
                    <p class="read faq-text">
                        Yes, you can track the real-time location of the matatu you booked through our app.
                        This feature allows you to know the exact location of your matatu and estimated time
                        of arrival, providing you with peace of mind and convenience.
                    </p>
                </li>
                <li>
                    <h4 class="faq-heading">
                        What payment methods do you accept for booking?
                    </h4>
                    <p class="read faq-text">
                        We accept various payment methods for booking, including credit/debit cards,
                        mobile money, and cash on delivery. Choose the payment method that is most convenient
                        for you during the booking process.
                    </p>
                </li>
                <li>
                    <h4 class="faq-heading">
                        How can I contact customer support for assistance?
                    </h4>
                    <p class="read faq-text">
                        If you have any questions or need assistance, our customer support team
                        is available 24/7 to help you. You can reach us through our hotline number,
                        email, or live chat feature on our app or website. We are committed to providing
                        prompt and reliable customer service to ensure a smooth travel experience for
                        our passengers.
                    </p>
                </li>
            </ul>
        </div>
    </section>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Get all elements with the class "faq-heading"
            var faqHeadings = document.querySelectorAll(".faq-heading");

            // Add a click event listener to each FAQ heading
            faqHeadings.forEach(function (heading) {
                heading.addEventListener("click", function () {
                    // Toggle the class "active" on the clicked heading
                    this.classList.toggle("active");

                    // Get the corresponding FAQ text element
                    var faqText = this.nextElementSibling;

                    // Toggle the class "show" on the FAQ text element
                    faqText.classList.toggle("show");
                });
            });
        });
    </script>

    <style>
        /* Style to hide FAQ text by default */
        .faq-text {
            display: none;
        }

        /* Style to show FAQ text when the "show" class is present */
        .show {
            display: block;
        }

        /* Style to indicate the active state of the FAQ heading */
        .faq-heading.active {
            color: #007bff; /* You can customize the color as needed */
        }
    </style>





<?php
// Get the buffered content and assign it to $content
$pageContent = ob_get_clean();

// Include the layout
include('../layout.php');
?>