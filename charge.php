<?php
require 'vendor/autoload.php';
include("connection.php");

//  Stripe Secret Key
\Stripe\Stripe::setApiKey('stripe secret key');

// Validate POST data
if (!isset($_POST['stripeToken'], $_POST['amount'], $_POST['scheduleid'])) {
    die('Missing required information.');
}

$stripeToken = $_POST['stripeToken'];
$amount = intval($_POST['amount']);
$scheduleid = intval($_POST['scheduleid']);
$apponum = intval($_POST['apponum']);
$appodate = $_POST['date'];

try {
    // Create Stripe charge
    $charge = \Stripe\Charge::create([
        'amount' => $amount,
        'currency' => 'aud',
        'description' => 'Doctor Appointment Payment - Schedule ID: ' . $scheduleid,
        'source' => $stripeToken,
    ]);

    if ($charge->status === 'succeeded') {
        
        $database->autocommit(FALSE);
        
        try {
            
            session_start();
            $useremail = $_SESSION["user"];
            
            
            $sqlmain = "select * from patient where pemail=?";
            $stmt = $database->prepare($sqlmain);
            $stmt->bind_param("s", $useremail);
            $stmt->execute();
            $result = $stmt->get_result();
            $userfetch = $result->fetch_assoc();
            $userid = $userfetch["pid"];
            
            // Create the appointment
            $stmt = $database->prepare("INSERT INTO appointment(pid, apponum, scheduleid, appodate) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("iiis", $userid, $apponum, $scheduleid, $appodate);
            $stmt->execute();
            $appointment_id = $database->insert_id;
            
            // Create payments table if it doesn't exist
            $database->query("CREATE TABLE IF NOT EXISTS payments (
                id INT AUTO_INCREMENT PRIMARY KEY,
                appointment_id INT,
                stripe_charge_id VARCHAR(255),
                amount INT,
                status VARCHAR(50),
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )");
            
            // Save payment info
            $stmt = $database->prepare("INSERT INTO payments(appointment_id, stripe_charge_id, amount, status, created_at) VALUES (?, ?, ?, ?, NOW())");
            $status = 'paid';
            $stripe_charge_id = $charge->id;
            $stmt->bind_param("isis", $appointment_id, $stripe_charge_id, $amount, $status);
            $stmt->execute();

            // Commit transaction
            $database->commit();
            $database->autocommit(TRUE);
            
            // Redirect to appointments page with success message
            header("Location: patient/appointment.php?success=1");
            exit();
            
        } catch (Exception $e) {
            // Rollback transaction on error
            $database->rollback();
            $database->autocommit(TRUE);
            throw $e;
        }

    } else {
        echo "<h3>Payment failed. Please try again.</h3>";
        echo '<a href="javascript:history.back()">Go Back</a>';
    }

} catch (\Stripe\Exception\CardException $e) {
    echo '<h3>Payment error: ' . htmlspecialchars($e->getMessage()) . '</h3>';
    echo '<a href="javascript:history.back()">Go Back</a>';
} catch (Exception $e) {
    echo '<h3>System error: ' . htmlspecialchars($e->getMessage()) . '</h3>';
    echo '<a href="javascript:history.back()">Go Back</a>';
}
?>