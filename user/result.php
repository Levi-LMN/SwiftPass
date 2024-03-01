<?php
// Check if the user is logged in
session_start();
// Set page title for the layout
$pageTitle = "Swifpass Booking Result";

// Content for the layout
ob_start();
?>

<div class="container mt-5">
    <h1 class="display-4">Booking Result</h1>

    <?php
    // Retrieve result message and details from the URL parameters
    $resultMessage = isset($_GET['message']) ? $_GET['message'] : 'No result message.';
    $ticketDetails = isset($_GET['ticket_details']) ? $_GET['ticket_details'] : '';

    echo "<p class='lead'>$resultMessage</p>";

    if (!empty($ticketDetails)) {
        $tickets = explode(', ', $ticketDetails);

        echo '<h3>Details:</h3>';
        echo '<ul class="list-group">';

        foreach ($tickets as $ticket) {
            $ticketInfo = explode(': ', $ticket);
            $seatInfo = explode(', ', $ticketInfo[1]);

            echo '<li class="list-group-item">';
            echo "<strong>{$ticketInfo[0]}</strong>:";
            echo '<ul class="list-group list-group-flush">';

            foreach ($seatInfo as $seat) {
                list($seatNumber, $ticketNumber, $price) = explode(' - ', $seat);
                echo '<li class="list-group-item">';
                echo "Seat $seatNumber: Ticket Number - $ticketNumber, Price - $price";
                echo '</li>';
            }

            echo '</ul>';
            echo '</li>';
        }

        echo '</ul>';
    }
    ?>

    <p class="mt-3"><a href="schedules.php" class="btn btn-primary">Book Another Seat</a></p>
</div>

<?php
// Get the buffered content and assign it to $content
$pageContent = ob_get_clean();

// Include the layout
include('../layout.php');
?>
