<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/animations.css">  
    <link rel="stylesheet" href="../css/main.css">  
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="../css/doctors.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <title>My Bookings</title>
    <style>
        .btn-primary {
            display: inline-block;
            background-color: var(--primary);
            color: white;
            padding: 8px 16px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: 500;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            margin-top: 15px;
        }

        .btn-primary:hover {
            background-color: var(--primarydark);
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .btn-primary i {
            margin-right: 5px;
        }

        .btn-danger {
            background-color: #dc3545;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s ease;
        }

        .btn-danger:hover {
            background-color: #c82333;
        }

        .btn-secondary {
            background-color: #6c757d;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            margin-left: 10px;
            transition: all 0.3s ease;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
        }

        /* Popup/Modal Styles */
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        .popup {
            background: white;
            border-radius: 10px;
            padding: 0;
            max-width: 500px;
            width: 90%;
            max-height: 90vh;
            overflow-y: auto;
            position: relative;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        }

        .popup-content {
            padding: 30px;
            text-align: center;
        }

        .popup-icon {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0 auto 20px;
            font-size: 40px;
        }

        .popup-icon.success {
            background-color: #d4edda;
            color: #155724;
        }

        .popup-icon.error {
            background-color: #f8d7da;
            color: #721c24;
        }

        .popup-icon.warning {
            background-color: #fff3cd;
            color: #856404;
        }

        .popup h2 {
            margin: 0 0 15px 0;
            font-size: 24px;
            font-weight: 600;
        }

        .popup p {
            margin: 0 0 20px 0;
            color: #666;
            line-height: 1.5;
        }

        .appointment-details {
            background-color: #f8f9fa;
            border-radius: 8px;
            padding: 20px;
            margin: 20px 0;
            text-align: left;
        }

        .detail-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }

        .detail-item:last-child {
            margin-bottom: 0;
        }

        .detail-label {
            font-weight: 600;
            color: #333;
        }

        .detail-value {
            color: #666;
            text-align: right;
            flex: 1;
            margin-left: 20px;
        }

        .popup-actions {
            display: flex;
            gap: 10px;
            justify-content: center;
            margin-top: 25px;
        }

        .close-btn {
            position: absolute;
            top: 15px;
            right: 20px;
            background: none;
            border: none;
            font-size: 30px;
            color: #999;
            cursor: pointer;
            text-decoration: none;
            width: 30px;
            height: 30px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .close-btn:hover {
            color: #333;
        }
    </style>
</head>
<body>
    <?php
    session_start();

    date_default_timezone_set('Australia/Sydney');
    $today = date('d-m-Y');

    if(isset($_SESSION["user"])){
        if(($_SESSION["user"])=="" or $_SESSION['usertype']!='p'){
            header("location: ../login.php");
        }else{
            $useremail=$_SESSION["user"];
        }
    }else{
        header("location: ../login.php");
    }

     $useremail="patient@docappoint.com";
    
    //import database
    include("../connection.php");
    $sqlmain= "select * from patient where pemail=?";
    $stmt = $database->prepare($sqlmain);
    $stmt->bind_param("s",$useremail);
    $stmt->execute();
    $userrow = $stmt->get_result();
    $userfetch=$userrow->fetch_assoc();
    $userid= $userfetch["pid"];
    $username=$userfetch["pname"];

    // Handle appointment deletion - Use the existing delete-appointment.php approach
    $deletion_message = "";
    if($_POST && isset($_POST['delete_appointment'])){
        $appoid = $_POST['appointment_id'];
        
        // Verify the appointment belongs to this user before deletion
        $verify_sql = "SELECT appoid FROM appointment WHERE appoid = ? AND pid = ?";
        $verify_stmt = $database->prepare($verify_sql);
        $verify_stmt->bind_param("ii", $appoid, $userid);
        $verify_stmt->execute();
        $verify_result = $verify_stmt->get_result();
        
        if($verify_result->num_rows > 0){
            // Delete the appointment
            $delete_sql = "DELETE FROM appointment WHERE appoid = ? AND pid = ?";
            $delete_stmt = $database->prepare($delete_sql);
            $delete_stmt->bind_param("ii", $appoid, $userid);
            
            if($delete_stmt->execute() && $delete_stmt->affected_rows > 0){
                $deletion_message = "success";
            } else {
                $deletion_message = "error";
            }
        } else {
            $deletion_message = "unauthorized";
        }
    }

    $sqlmain= "select appointment.appoid,schedule.scheduleid,schedule.title,doctor.docname,patient.pname,schedule.scheduledate,schedule.scheduletime,appointment.apponum,appointment.appodate from schedule inner join appointment on schedule.scheduleid=appointment.scheduleid inner join patient on patient.pid=appointment.pid inner join doctor on schedule.docid=doctor.docid  where  patient.pid=$userid ";

    if($_POST && isset($_POST["sheduledate"]) && !empty($_POST["sheduledate"])){
        $sheduledate=$_POST["sheduledate"];
        $sqlmain.=" and schedule.scheduledate='$sheduledate' ";
    }

    $sqlmain.="order by appointment.appodate asc";
    $result= $database->query($sqlmain);
    ?>
 <div class="container-fluid">
        <!-- Sidebar / Menu -->
        <div class="menu">
            <div class="profile-container">
                <img src="../img/user.png" alt="Profile" width="70" style="border-radius:50%">
                <p class="profile-title"><?php echo substr($username,0,13); ?></p>
                <p class="profile-subtitle"><?php echo substr($useremail,0,22); ?></p>
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
                        <a href="appointment.php" class="non-style-link-menu">
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
            <!-- Top navigation -->
            <div class="nav-bar">
                <div>
                    <p style="font-size: 23px; font-weight: 600;">My Appointments</p>
                </div>
                <div style="display: flex; align-items: center;">
                    <div style="margin-right: 15px;">
                        <p style="font-size: 0.8rem; color: var(--light-text); margin: 0;">Today's Date</p>
                        <p style="font-size: 1rem; font-weight: 500; margin: 0;"><?php echo $today; ?></p>
                    </div>
                    <div style="width: 40px; height: 40px; background: var(--primary); border-radius: 50%; display: flex; justify-content: center; align-items: center; color: white;">
                        <i class="fas fa-calendar-day"></i>
                    </div>
                </div>
            </div>

            <!-- Search Section -->
            <div class="search-section card">
                <div class="card-body">
                    <form action="" method="post" class="search-form">
                        <div class="search-input-container">
                            <input type="date" name="sheduledate" class="search-input" placeholder="Filter by appointment date">
                            <button type="submit" class="search-btn">
                                <i class="fas fa-filter"></i> Filter
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Appointments List Section -->
            <div class="doctors-section card">
                <div class="section-header">
                    <div style="display: flex; align-items: center;">
                        <div class="section-header-icon">
                            <i class="fas fa-calendar-check"></i>
                        </div>
                        <span style="margin-left: 10px;">My Appointments</span>
                    </div>
                    <div>
                        <?php 
                            echo "<p style='font-size: 0.9rem; color: var(--light-text);'>" . $result->num_rows . " appointment(s) found</p>";
                        ?>
                    </div>
                </div>
                
                <div class="doctors-list">
                    <?php
                    if($result->num_rows==0){
                        echo '<div class="empty-state">
                                <img src="../img/notfound.svg" alt="No appointments found" width="100px">
                                <p>No appointments found matching your search criteria!</p>
                                <a href="appointment.php" class="btn-view-sessions" style="display: inline-block; margin-top: 15px;">Show All Appointments</a>
                              </div>';
                    } else {
                        echo '<div class="doctors-grid" style="grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));">';
                        
                        for ($x=0; $x<($result->num_rows);$x++){
                            $row=$result->fetch_assoc();
                            if (!isset($row)){
                                break;
                            };
                            $scheduleid=$row["scheduleid"];
                            $title=$row["title"];
                            $docname=$row["docname"];
                            $scheduledate=$row["scheduledate"];
                            $scheduletime=$row["scheduletime"];
                            $apponum=$row["apponum"];
                            $appodate=$row["appodate"];
                            $appoid=$row["appoid"];

                            if($scheduleid==""){
                                break;
                            }
                            
                            echo '<div class="doctor-card">
                                    <div class="doctor-avatar" style="background-color: var(--lighter);">
                                        <div class="avatar-placeholder">
                                            <i class="fas fa-calendar-check"></i>
                                        </div>
                                    </div>
                                    <div class="doctor-details">
                                        <h3 class="doctor-name">'.htmlspecialchars(substr($title, 0, 28)).'</h3>
                                        <p class="doctor-specialty">Dr. '.htmlspecialchars(substr($docname, 0, 20)).'</p>
                                        <div class="doctor-contact">
                                            <div class="contact-item">
                                                <i class="fas fa-calendar-alt"></i>
                                                <span>'.$scheduledate.' @ '.substr($scheduletime, 0, 5).'</span>
                                            </div>
                                            <div class="contact-item">
                                                <i class="fas fa-ticket-alt"></i>
                                                <span>Appointment #'.$apponum.'</span>
                                            </div>
                                            <div class="contact-item">
                                                <i class="fas fa-clock"></i>
                                                <span>Booked on: '.substr($appodate, 0, 10).'</span>
                                            </div>
                                            <div class="contact-item">
                                                <i class="fas fa-hashtag"></i>
                                                <span>Ref: OC-000-'.$appoid.'</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="doctor-actions">
                                        <button onclick="showCancelPopup('.$appoid.', \''.htmlspecialchars(addslashes($title)).'\', \''.htmlspecialchars(addslashes($docname)).'\')" class="btn-view-sessions" style="background-color: var(--danger);">
                                            <i class="fas fa-times"></i> Cancel Booking
                                        </button>
                                    </div>
                                </div>';
                        }
                        
                        echo '</div>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Cancel Confirmation Popup -->
    <div id="cancelPopup" class="overlay" style="display: none;">
        <div class="popup">
            <div class="popup-content">
                <div class="popup-icon warning">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
                <h2>Cancel Confirmation</h2>
                <p>Are you sure you want to cancel this appointment?</p>
                <div class="appointment-details">
                    <div class="detail-item">
                        <span class="detail-label">Session:</span>
                        <span class="detail-value" id="popup-title"></span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Doctor:</span>
                        <span class="detail-value" id="popup-doctor"></span>
                    </div>
                </div>
                <div class="popup-actions">
                    <form method="post" style="display: inline;">
                        <input type="hidden" name="appointment_id" id="appointment-id-input">
                        <input type="hidden" name="delete_appointment" value="1">
                        <button type="submit" class="btn-danger">
                            <i class="fas fa-check"></i> Yes, Cancel
                        </button>
                    </form>
                    <button onclick="hideCancelPopup()" class="btn-secondary">
                        <i class="fas fa-times"></i> No, Keep
                    </button>
                </div>
                <button class="close-btn" onclick="hideCancelPopup()">&times;</button>
            </div>
        </div>
    </div>

    <?php
    // Show success/error messages after deletion
    if($deletion_message == "success"){
        echo '
        <div id="popup1" class="overlay">
            <div class="popup">
                <div class="popup-content">
                    <div class="popup-icon success">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <h2>Appointment Cancelled</h2>
                    <p>Your appointment has been successfully cancelled.</p>
                    <div class="popup-actions">
                        <a href="appointment.php" class="btn-primary">
                            <i class="fas fa-check"></i> OK
                        </a>
                    </div>
                    <a class="close-btn" href="appointment.php">&times;</a>
                </div>
            </div>
        </div>
        ';
    } elseif($deletion_message == "error"){
        echo '
        <div id="popup1" class="overlay">
            <div class="popup">
                <div class="popup-content">
                    <div class="popup-icon error">
                        <i class="fas fa-times-circle"></i>
                    </div>
                    <h2>Error</h2>
                    <p>There was an error cancelling your appointment. Please try again.</p>
                    <div class="popup-actions">
                        <a href="appointment.php" class="btn-primary">
                            <i class="fas fa-check"></i> OK
                        </a>
                    </div>
                    <a class="close-btn" href="appointment.php">&times;</a>
                </div>
            </div>
        </div>
        ';
    } elseif($deletion_message == "unauthorized"){
        echo '
        <div id="popup1" class="overlay">
            <div class="popup">
                <div class="popup-content">
                    <div class="popup-icon error">
                        <i class="fas fa-exclamation-triangle"></i>
                    </div>
                    <h2>Unauthorized</h2>
                    <p>You are not authorized to cancel this appointment.</p>
                    <div class="popup-actions">
                        <a href="appointment.php" class="btn-primary">
                            <i class="fas fa-check"></i> OK
                        </a>
                    </div>
                    <a class="close-btn" href="appointment.php">&times;</a>
                </div>
            </div>
        </div>
        ';
    }

    // Handle other GET parameters for booking confirmations
    if(isset($_GET['action'])){
        $action = $_GET['action'];
        $id = isset($_GET["id"]) ? $_GET["id"] : '';
        
        if($action=='booking-added'){
            echo '
            <div id="popup1" class="overlay">
                <div class="popup">
                    <div class="popup-content">
                        <div class="popup-icon success">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <h2>Booking Successful</h2>
                        <p>Your Appointment number is '.$id.'</p>
                        <div class="popup-actions">
                            <a href="appointment.php" class="btn-primary">
                                <i class="fas fa-check"></i> OK
                            </a>
                        </div>
                        <a class="close-btn" href="appointment.php">&times;</a>
                    </div>
                </div>
            </div>
            ';
        } elseif($action=='booking-removed'){
            echo '
            <div id="popup1" class="overlay">
                <div class="popup">
                    <div class="popup-content">
                        <div class="popup-icon success">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <h2>Appointment Cancelled</h2>
                        <p>Your appointment has been successfully cancelled.</p>
                        <div class="popup-actions">
                            <a href="appointment.php" class="btn-primary">
                                <i class="fas fa-check"></i> OK
                            </a>
                        </div>
                        <a class="close-btn" href="appointment.php">&times;</a>
                    </div>
                </div>
            </div>
            ';
        } elseif($action=='booking-error'){
            echo '
            <div id="popup1" class="overlay">
                <div class="popup">
                    <div class="popup-content">
                        <div class="popup-icon error">
                            <i class="fas fa-times-circle"></i>
                        </div>
                        <h2>Error</h2>
                        <p>There was an error cancelling your appointment. Please try again.</p>
                        <div class="popup-actions">
                            <a href="appointment.php" class="btn-primary">
                                <i class="fas fa-check"></i> OK
                            </a>
                        </div>
                        <a class="close-btn" href="appointment.php">&times;</a>
                    </div>
                </div>
            </div>
            ';
        } elseif($action=='unauthorized'){
            echo '
            <div id="popup1" class="overlay">
                <div class="popup">
                    <div class="popup-content">
                        <div class="popup-icon error">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                        <h2>Unauthorized</h2>
                        <p>You are not authorized to perform this action.</p>
                        <div class="popup-actions">
                            <a href="appointment.php" class="btn-primary">
                                <i class="fas fa-check"></i> OK
                            </a>
                        </div>
                        <a class="close-btn" href="appointment.php">&times;</a>
                    </div>
                </div>
            </div>
            ';
        }
    }
    ?>

    <script>
        function showCancelPopup(appointmentId, title, doctor) {
            console.log('showCancelPopup called with:', appointmentId, title, doctor); // Debug log
            
            document.getElementById('appointment-id-input').value = appointmentId;
            document.getElementById('popup-title').textContent = title.substring(0, 40);
            document.getElementById('popup-doctor').textContent = doctor.substring(0, 40);
            
            const popup = document.getElementById('cancelPopup');
            popup.style.display = 'flex';
            
            console.log('Popup should now be visible'); // Debug log
        }

        function hideCancelPopup() {
            document.getElementById('cancelPopup').style.display = 'none';
        }

        // Close popup when clicking outside of it
        document.addEventListener('DOMContentLoaded', function() {
            const cancelPopup = document.getElementById('cancelPopup');
            if (cancelPopup) {
                cancelPopup.addEventListener('click', function(e) {
                    if (e.target === this) {
                        hideCancelPopup();
                    }
                });
            }
        });

        // Test function to check if JavaScript is working
        console.log('JavaScript loaded successfully');
    </script>
</body>
</html>