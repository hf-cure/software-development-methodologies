<?php
session_start();

if (isset($_SESSION["user"])) {
    if (($_SESSION["user"]) == "" or $_SESSION['usertype'] != 'p') {
        header("location: ../login.php");
    } else {
        $useremail = $_SESSION["user"];
    }
} else {
    header("location: ../login.php");
}

//import database
include("../connection.php");

$sqlmain = "select * from patient where pemail=?";
$stmt = $database->prepare($sqlmain);
$stmt->bind_param("s", $useremail);
$stmt->execute();
$result = $stmt->get_result();
$userfetch = $result->fetch_assoc();
$userid = $userfetch["pid"];
$username = $userfetch["pname"];


date_default_timezone_set('Australia/Sydney');
$today = date('d-m-Y'); // For display
$todayMysql = date('Y-m-d'); // For database
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/animations.css">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="../css/booking.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <title>Booking Confirmation</title>
    <style>
        /* Stripe Element Custom Styling */
            #card-element {
                border: 1px solid #ced4da;
                border-radius: 0.375rem;
                padding: 10px;
                background-color: #fff;
                height: 45px;
            }

            #card-element.StripeElement--focus {
                border-color: #86b7fe;
                box-shadow: 0 0 0 0.25rem rgba(13,110,253,.25);
            }

            #card-element.StripeElement--invalid {
                border-color: #dc3545;
            }

            #card-errors {
                font-size: 0.9rem;
                margin-top: 0.25rem;
            }
                     body {
            margin: 0;
            padding: 0;
        }
        
        .container-fluid {
            padding: 0;
            margin: 0;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <!-- Sidebar / Menu -->
        <div class="menu">
            <div class="profile-container">
                <img src="../img/user.png" alt="Profile" width="70" style="border-radius:50%">
                <p class="profile-title"><?php echo substr($username, 0, 13); ?></p>
                <p class="profile-subtitle"><?php echo substr($useremail, 0, 22); ?></p>
                <a href="../logout.php"><button class="logout-btn">Log out</button></a>
            </div>

            <table class="menu-container" border="0">
                <tr class="menu-row">
                    <td class="menu-btn">
                        <a href="index.php" class="non-style-link-menu">
                            <i class="fas fa-home menu-icon"></i>
                            <p class="menu-text">Dashboard</p>
                        </a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn">
                        <a href="doctors.php" class="non-style-link-menu">
                            <i class="fas fa-user-md menu-icon"></i>
                            <p class="menu-text">All Doctors</p>
                        </a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn">
                        <a href="schedule.php" class="non-style-link-menu">
                            <i class="fas fa-calendar-alt menu-icon"></i>
                            <p class="menu-text">Scheduled Sessions</p>
                        </a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-active">
                        <a href="appointment.php" class="non-style-link-menu non-style-link-menu-active">
                            <i class="fas fa-calendar-check menu-icon"></i>
                            <p class="menu-text">My Appointments</p>
                        </a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn">
                        <a href="payments.php" class="non-style-link-menu">
                            <i class="fas fa-credit-card menu-icon"></i>
                            <p class="menu-text">Payment Invoices</p>
                        </a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn">
                        <a href="settings.php" class="non-style-link-menu">
                            <i class="fas fa-cog menu-icon"></i>
                            <p class="menu-text">Settings</p>
                        </a>
                    </td>
                </tr>
            </table>
        </div>

        <!-- Main Content Area -->
        <div class="dash-body">
            <!-- Top Navigation -->
            <div class="nav-bar">

                <div class="search-section">
                    <form action="schedule.php" method="post" class="header-search">
                        <input type="search" name="search" class="input-text header-searchbar"
                            placeholder="Search Doctor name or Email or Date (YYYY-MM-DD)" list="doctors">

                        <?php
                        echo '<datalist id="doctors">';
                        $list11 = $database->query("select DISTINCT * from doctor;");
                        $list12 = $database->query("select DISTINCT * from schedule GROUP BY title;");

                        for ($y = 0; $y < $list11->num_rows; $y++) {
                            $row00 = $list11->fetch_assoc();
                            $d = $row00["docname"];
                            echo "<option value='$d'><br/>";
                        }

                        for ($y = 0; $y < $list12->num_rows; $y++) {
                            $row00 = $list12->fetch_assoc();
                            $d = $row00["title"];
                            echo "<option value='$d'><br/>";
                        }
                        echo '</datalist>';
                        ?>

                        <button type="Submit" class="search-btn">
                            <i class="fas fa-search"></i> Search
                        </button>
                    </form>
                </div>
                <div class="date-section">
                    <div>
                        <p style="font-size: 0.8rem; color: var(--light-text); margin: 0;">Today's Date</p>
                        <p style="font-size: 1rem; font-weight: 500; margin: 0;"><?php echo $today; ?></p>
                    </div>
                    <div style="width: 40px; height: 40px; background: var(--primary); border-radius: 50%; display: flex; justify-content: center; align-items: center; color: white; margin-left: 15px;">
                        <i class="fas fa-calendar-day"></i>
                    </div>
                </div>
            </div>

            <!-- Booking Content -->
            <div class="booking-content">
                <?php
                if (isset($_GET["id"])) {
                    $id = $_GET["id"];

                    $sqlmain = "select * from schedule inner join doctor on schedule.docid=doctor.docid where schedule.scheduleid=? order by schedule.scheduledate desc";
                    $stmt = $database->prepare($sqlmain);
                    $stmt->bind_param("i", $id);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $row = $result->fetch_assoc();

                    $scheduleid = $row["scheduleid"];
                    $title = $row["title"];
                    $docname = $row["docname"];
                    $docemail = $row["docemail"];
                    $scheduledate = $row["scheduledate"];
                    $scheduletime = $row["scheduletime"];

                    $sql2 = "select * from appointment where scheduleid=$id";
                    $result12 = $database->query($sql2);
                    $apponum = ($result12->num_rows) + 1;

                    echo  '<div class="booking-card-container">' .
                        '    <div class="booking-card">' .
                        '        <div class="session-details">' .
                        '            <div class="card-header">' .
                        '                <i class="fas fa-calendar-alt header-icon"></i>' .
                        '                <h3>Session Details</h3>' .
                        '            </div>' .
                        '            <div class="card-body">' .
                        '                <div class="info-row">' .
                        '                    <span class="info-label">Doctor:</span>' .
                        '                    <span class="info-value">' . $docname . '</span>' .
                        '                </div>' .
                        '                <div class="info-row">' .
                        '                    <span class="info-label">Email:</span>' .
                        '                    <span class="info-value">' . $docemail . '</span>' .
                        '                </div>' .
                        '                <div class="info-row">' .
                        '                    <span class="info-label">Session Title:</span>' .
                        '                    <span class="info-value">' . $title . '</span>' .
                        '                </div>' .
                        '                <div class="info-row">' .
                        '                    <span class="info-label">Date:</span>' .
                        '                    <span class="info-value">' . $scheduledate . '</span>' .
                        '                </div>' .
                        '                <div class="info-row">' .
                        '                    <span class="info-label">Time:</span>' .
                        '                    <span class="info-value">' . $scheduletime . '</span>' .
                        '                </div>' .
                        '                <div class="info-row">' .
                        '                    <span class="info-label">Fee:</span>' .
                        '                    <span class="info-value fee">$50</span>' .
                        '                </div>' .
                        '            </div>' .
                        '        </div>' .
                        '        ' .
                        '        <div class="booking-confirmation">' .
                        '            <div class="card-header">' .
                        '                <i class="fas fa-ticket-alt header-icon"></i>' .
                        '                <h3>Appointment Details</h3>' .
                        '            </div>' .
                        '            <div class="appo-number-container">' .
                        '                <p>Your Appointment Number</p>' .
                        '                <div class="appo-number">' . $apponum . '</div>' .
                        '            </div>' .
                        '            <form action="booking-complete.php" method="post" id="bookingForm">' .
                        '                <input type="hidden" name="scheduleid" value="' . $scheduleid . '">' .
                        '                <input type="hidden" name="apponum" value="' . $apponum . '">' .
                        '                <input type="hidden" name="date" value="' . $todayMysql . '">' .
                        '                <input type="hidden" name="booknow" value="1">' .
                        '              <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#paymentChoiceModal">Confirm Booking</button>' .
                        '            </form>' .
                        '        </div>' .
                        '    </div>' .
                        '</div>';
                }
                ?>
            </div>
        </div>
    </div>

    <script src="https://js.stripe.com/v3/"></script>

    <!-- Payment Choice Modal -->
    <div class="modal fade" id="paymentChoiceModal" tabindex="-1" aria-labelledby="paymentChoiceLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Choose Payment Option</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Please select your payment method to proceed:</p>
                    <button type="button" class="btn btn-outline-primary w-100 mb-2" id="oneOffPay">One-Off Payment</button>
                    <button type="button" class="btn btn-outline-secondary w-100" disabled>Regular Payment Plan (Coming Soon)</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="stripePaymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content shadow-lg rounded-4">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="paymentModalLabel">Secure Payment</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="payment-form">
                        <input type="hidden" name="scheduleid" value="<?php echo isset($scheduleid) ? $scheduleid : ''; ?>">
                        <input type="hidden" name="apponum" value="<?php echo isset($apponum) ? $apponum : ''; ?>">
                        <input type="hidden" name="date" value="<?php echo $todayMysql; ?>">
                        <input type="hidden" name="amount" value="5000">

                        <label for="card-element" class="form-label">Enter your card details</label>
                        <div id="card-element" class="form-control p-3 rounded border"></div>
                        <div id="card-errors" role="alert" class="text-danger mt-2"></div>

                        <button type="submit" class="btn btn-success w-100 mt-4" id="payButton">Pay A$50</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        const stripe = Stripe('pk_test_51RRESkPPlpPZ2rI4RS2ezyBjTLEnlSBIldJOx3mTf9VfAOZJvRZZNfvWcSLqEsAgXFK15gEP5dkQu6kSqPOi9UjX00Weoa5sZG');
        const elements = stripe.elements();

        const card = elements.create('card', {
            hidePostalCode: true,
            style: {
                base: {
                    fontSize: '16px',
                    color: '#32325d',
                    '::placeholder': {
                        color: '#a0aec0'
                    }
                }
            }
        });
        card.mount('#card-element');

        // Show one-off payment modal
        document.getElementById('oneOffPay').addEventListener('click', function() {
            bootstrap.Modal.getInstance(document.getElementById('paymentChoiceModal')).hide();
            const stripeModal = new bootstrap.Modal(document.getElementById('stripePaymentModal'));
            stripeModal.show();
        });

        // Handle payment form submission
        const form = document.getElementById('payment-form');
        const payButton = document.getElementById('payButton');
        
        form.addEventListener('submit', async (event) => {
            event.preventDefault();
            
            // Disable the button to prevent multiple submissions
            payButton.disabled = true;
            payButton.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Processing...';
            
            // Clear previous errors
            document.getElementById('card-errors').textContent = '';

            try {
                const { token, error } = await stripe.createToken(card);
                
                if (error) {
                    document.getElementById('card-errors').textContent = error.message;
                    payButton.disabled = false;
                    payButton.innerHTML = 'Pay A$50';
                } else {
                    // Create a form to submit to charge.php
                    const chargeForm = document.createElement('form');
                    chargeForm.method = 'POST';
                    chargeForm.action = '../charge.php';
                    
                    // Add hidden inputs
                    const inputs = {
                        'stripeToken': token.id,
                        'amount': document.querySelector('input[name="amount"]').value,
                        'scheduleid': document.querySelector('input[name="scheduleid"]').value,
                        'apponum': document.querySelector('input[name="apponum"]').value,
                        'date': document.querySelector('input[name="date"]').value
                    };
                    
                    for (const [name, value] of Object.entries(inputs)) {
                        const input = document.createElement('input');
                        input.type = 'hidden';
                        input.name = name;
                        input.value = value;
                        chargeForm.appendChild(input);
                    }
                    
                    document.body.appendChild(chargeForm);
                    chargeForm.submit();
                }
            } catch (err) {
                console.error('Payment error:', err);
                document.getElementById('card-errors').textContent = 'An unexpected error occurred.';
                payButton.disabled = false;
                payButton.innerHTML = 'Pay A$50';
            }
        });
    </script>

</body>

</html>