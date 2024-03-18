<?php
// Check if the user is logged in
session_start();
// Set page title for the layout
$pageTitle = "Swifpass Booking Result";

// Content for the layout
ob_start();
?>

<div>
    <h1>Booking Result</h1>

    <?php
    // Retrieve result message and details from the URL parameters
    $resultMessage = isset($_GET['message']) ? $_GET['message'] : 'No result message.';
    $ticketDetails = isset($_GET['ticket_details']) ? $_GET['ticket_details'] : '';

    echo "<p>$resultMessage</p>";

    if (!empty($ticketDetails)) {
        $tickets = explode(', ', $ticketDetails);

        echo '<h3>Details:</h3>';
        echo '<ul>';

        foreach ($tickets as $ticket) {
            $ticketInfo = explode(': ', $ticket);
            $seatInfo = explode(', ', $ticketInfo[1]);

            echo '<li>';
            echo "<strong>{$ticketInfo[0]}</strong>:";
            echo '<ul>';

            foreach ($seatInfo as $seat) {
                list($seatNumber, $ticketNumber, $price) = explode(' - ', $seat);
                echo '<li>';
                echo "Seat $seatNumber: Ticket Number - $ticketNumber, Price - $price";
                echo '</li>';
            }

            echo '</ul>';
            echo '</li>';
        }

        echo '</ul>';
    }
    ?>

    <p><a href="schedules.php">Book Another Seat</a></p>
</div>


<?php
// Get the buffered content and assign it to $content
$pageContent = ob_get_clean();

// Include the layout
include('../layout.php');
?>
