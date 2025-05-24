<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Doctor Dashboard</title>
    <style>
        /* Global Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: #f7f8fc;
            font-size: 16px;
            line-height: 1.6;
            color: #333;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        ul {
            list-style: none;
        }

        /* Utility Classes */
        .text-center {
            text-align: center;
        }

        .text-left {
            text-align: left;
        }

        .text-right {
            text-align: right;
        }

        .container {
            width: 100%;
            margin: 0 auto;
            display: flex;
        }

        /* Animation Settings */
        @keyframes transitionIn-X {
            0% {
                transform: translateX(-100%);
                opacity: 0;
            }
            100% {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @keyframes fadeIn {
            0% {
                opacity: 0;
            }
            100% {
                opacity: 1;
            }
        }

        @keyframes slideInFromBottom {
            0% {
                transform: translateY(20px);
                opacity: 0;
            }
            100% {
                transform: translateY(0);
                opacity: 1;
            }
        }

        @keyframes slideInFromTop {
            0% {
                transform: translateY(-20px);
                opacity: 0;
            }
            100% {
                transform: translateY(0);
                opacity: 1;
            }
        }

        /* Menu Styles */
        .menu {
            width: 300px;
            background: #fff;
            min-height: 100vh;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            animation: transitionIn-X 0.5s ease-out;
            position: fixed;
            left: 0;
            top: 0;
        }

        .menu-container {
            width: 100%;
        }

        .profile-container {
            width: 100%;
            padding: 20px;
            border-bottom: 1px solid #f1f1f1;
            animation: slideInFromTop 0.5s ease-out;
        }

        .profile-title {
            font-size: 1.2rem;
            font-weight: 600;
            color: #333;
            margin-bottom: 5px;
        }

        .profile-subtitle {
            font-size: 0.9rem;
            color: #666;
        }

        .menu-row {
            transition: all 0.3s ease;
        }

        .menu-btn {
            padding: 15px 25px;
            display: block;
            transition: all 0.3s ease;
            border-left: 4px solid transparent;
        }

        .menu-btn:hover {
            background-color: #f8f9fa;
            border-left: 4px solid #ff5722;
        }

        .menu-active {
            background-color: #f8f9fa;
            border-left: 4px solid #ff5722;
        }

        .menu-text {
            font-weight: 500;
            font-size: 1rem;
            padding-left: 35px;
            position: relative;
        }

        .menu-text::before {
            content: '';
            position: absolute;
            width: 20px;
            height: 20px;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            background-size: contain;
            background-repeat: no-repeat;
        }

        .menu-icon-dashbord::before {
            background-image: url('../img/icons/dashboard.svg');
        }

        .menu-icon-appoinment::before {
            background-image: url('../img/icons/calendar.svg');
        }

        .menu-icon-session::before {
            background-image: url('../img/icons/session.svg');
        }

        .menu-icon-patient::before {
            background-image: url('../img/icons/patients.svg');
        }

        .menu-icon-settings::before {
            background-image: url('../img/icons/settings.svg');
        }

        /* Button Styles */
        .btn {
            display: inline-block;
            padding: 0.8rem 2rem;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 1rem;
            border-radius: 50px;
            transition: all 0.3s ease-in-out;
            cursor: pointer;
            text-align: center;
            border: none;
        }

        .btn-primary {
            background: linear-gradient(135deg, #ff9800, #ff5722);
            color: #fff;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #ff5722, #ff9800);
            box-shadow: 0 8px 16px rgba(255, 87, 34, 0.2);
            transform: translateY(-4px);
        }

        .btn-primary-soft {
            background: rgba(255, 87, 34, 0.1);
            color: #ff5722;
        }

        .btn-primary-soft:hover {
            background: rgba(255, 87, 34, 0.2);
            transform: translateY(-2px);
        }

        .logout-btn {
            width: 100%;
            margin-top: 15px;
        }

        /* Dash Body Styles */
        .dash-body {
            width: calc(100% - 300px);
            margin-left: 300px;
            padding: 20px;
            animation: fadeIn 0.6s ease-in-out;
        }

        .nav-bar {
            padding: 20px 0;
            border-bottom: 1px solid #f1f1f1;
            margin-bottom: 20px;
            animation: slideInFromTop 0.5s ease-out;
        }

        .heading-sub12 {
            font-size: 1.2rem;
            font-weight: 600;
            color: #ff5722;
        }

        .doctor-header {
            background: linear-gradient(135deg, #ff9800, #ff5722);
            color: #fff;
            padding: 30px;
            border-radius: 15px;
            margin-bottom: 30px;
            box-shadow: 0 10px 20px rgba(255, 87, 34, 0.2);
            animation: fadeIn 0.6s ease-in-out;
        }

        .doctor-header h3 {
            font-size: 1.5rem;
            margin-bottom: 10px;
            font-weight: 400;
        }

        .doctor-header h1 {
            font-size: 2.5rem;
            margin-bottom: 20px;
        }

        .doctor-header p {
            font-size: 1.1rem;
            margin-bottom: 20px;
            opacity: 0.9;
        }

        .filter-container {
            width: 100%;
            margin-bottom: 30px;
            animation: slideInFromBottom 0.6s ease-in-out;
        }

        .dashboard-items {
            background-color: #fff;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            border-radius: 15px;
            transition: all 0.3s ease;
            height: 100%;
        }

        .dashboard-items:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.12);
        }

        .h1-dashboard {
            font-size: 2.5rem;
            font-weight: 700;
            color: #ff5722;
        }

        .h3-dashboard {
            font-size: 1rem;
            color: #666;
            font-weight: 500;
        }

        .btn-icon-back {
            width: 60px;
            height: 60px;
            background-color: rgba(255, 87, 34, 0.1);
            margin-left: auto;
            border-radius: 10px;
            background-position: center;
            background-size: 30px;
            background-repeat: no-repeat;
        }

        /* Table Styles */
        .scroll {
            overflow-y: auto;
            scrollbar-width: thin;
            scrollbar-color: #ff5722 #f1f1f1;
        }

        .scroll::-webkit-scrollbar {
            width: 8px;
        }

        .scroll::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        .scroll::-webkit-scrollbar-thumb {
            background: #ff5722;
            border-radius: 10px;
        }

        .sub-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 10px;
        }

        .table-headin {
            font-size: 0.9rem;
            color: #666;
            padding: 10px 20px;
            text-align: left;
            border-bottom: 1px solid #f1f1f1;
        }

        .sub-table tr {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }

        .sub-table tr:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .sub-table td {
            padding: 15px 20px;
            color: #333;
            font-size: 0.95rem;
        }

        .sub-table tr td:first-child {
            border-top-left-radius: 10px;
            border-bottom-left-radius: 10px;
        }

        .sub-table tr td:last-child {
            border-top-right-radius: 10px;
            border-bottom-right-radius: 10px;
        }

        /* Status Section */
        .status-section {
            margin-bottom: 30px;
        }

        .status-section h2 {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 20px;
            color: #333;
        }

        .status-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }

        /* Media Queries */
        @media (max-width: 992px) {
            .menu {
                width: 250px;
            }
            .dash-body {
                width: calc(100% - 250px);
                margin-left: 250px;
            }
            .status-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .container {
                flex-direction: column;
            }
            .menu {
                width: 100%;
                min-height: auto;
                position: relative;
            }
            .dash-body {
                width: 100%;
                margin-left: 0;
            }
            .doctor-header {
                padding: 20px;
            }
            .doctor-header h1 {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
        <?php
        
    session_start();

    if (isset($_SESSION["user"])) {
        if (($_SESSION["user"]) == "" or $_SESSION['usertype'] != 'd') {
            header("location: ../login.php");
        } else {
            $useremail = $_SESSION["user"];
        }
    } else {
        header("location: ../login.php");
    }

    $useremail='doctor@docappoint.com';
    $doctors_count = 35;
    $patients_count = 1250;
    $new_bookings = 48;
    $today_sessions = 8;
    date_default_timezone_set('Australia/Sydney');
    $today = date('d-m-Y');

    
    include("../connection.php");
    $userrow = $database->query("select * from doctor where docemail='$useremail'");
    $userfetch = $userrow->fetch_assoc();
    $userid = $userfetch["docid"];
    $username = $userfetch["docname"];
    ?>

    <div class="container">
        <div class="menu">
            <table class="menu-container" border="0">
                <tr>
                    <td style="padding:20px" colspan="2">
                        <table border="0" class="profile-container">
                            <tr>
                                <td width="30%" style="padding-right:10px">
                                    <img src="../img/user.png" alt="" width="100%" style="border-radius:50%">
                                </td>
                                <td>
                                    <p class="profile-title"><?php echo substr($username, 0, 13); ?>..</p>
                                    <p class="profile-subtitle"><?php echo substr($useremail, 0, 22); ?></p>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <a href="../logout.php"><button type="button" class="btn btn-primary logout-btn">Log out</button></a>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-active">
                        <a href="index.php" class="non-style-link-menu">
                            <div>
                                <p class="menu-text menu-icon-dashbord">Dashboard</p>
                            </div>
                        </a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn">
                        <a href="appointment.php" class="non-style-link-menu">
                            <div>
                                <p class="menu-text menu-icon-appoinment">My Appointments</p>
                            </div>
                        </a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn">
                        <a href="schedule.php" class="non-style-link-menu">
                            <div>
                                <p class="menu-text menu-icon-session">My Sessions</p>
                            </div>
                        </a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn">
                        <a href="patient.php" class="non-style-link-menu">
                            <div>
                                <p class="menu-text menu-icon-patient">My Patients</p>
                            </div>
                        </a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn">
                        <a href="settings.php" class="non-style-link-menu">
                            <div>
                                <p class="menu-text menu-icon-settings">Settings</p>
                            </div>
                        </a>
                    </td>
                </tr>
            </table>
        </div>
        <div class="dash-body">
            <div class="nav-bar">
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <p style="font-size: 23px; font-weight: 600; margin: 0;">Dashboard</p>
                    <div style="display: flex; align-items: center;">
                        <div style="margin-right: 15px; text-align: right;">
                            <p style="font-size: 14px; color: #777; margin: 0;">Today's Date</p>
                            <p class="heading-sub12" style="margin: 0;"><?php echo $today; ?></p>
                        </div>
                        <button class="btn-label" style="background: none; border: none;">
                            <i class="fas fa-calendar-alt" style="font-size: 24px; color: #ff5722;"></i>
                        </button>
                    </div>
                </div>
            </div>

            <div class="doctor-header">
                <h3>Welcome!</h3>
                <h1><?php echo $username; ?></h1>
                <p>Thanks for joining with us. We are always trying to get you a complete service.<br>
                   You can view your daily schedule, reach patients' appointments at home!</p>
                <a href="appointment.php" class="non-style-link">
                    <button class="btn btn-primary" style="width: auto; padding: 10px 30px;">
                        View My Appointments
                    </button>
                </a>
            </div>

            <div class="status-section">
                <h2>Status</h2>
                <div class="status-grid">
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                        <div class="dashboard-items" style="padding: 20px; display: flex;">
                            <div>
                                <div class="h1-dashboard">
                                    <?php echo $doctors_count; ?>
                                </div>
                                <div class="h3-dashboard">
                                    All Doctors
                                </div>
                            </div>
                            <div class="btn-icon-back" style="background-image: url('../img/icons/doctors-hover.svg');"></div>
                        </div>
                        
                        <div class="dashboard-items" style="padding: 20px; display: flex;">
                            <div>
                                <div class="h1-dashboard">
                                    <?php echo $patients_count; ?>
                                </div>
                                <div class="h3-dashboard">
                                    All Patients
                                </div>
                            </div>
                            <div class="btn-icon-back" style="background-image: url('../img/icons/patients-hover.svg');"></div>
                        </div>
                    </div>
                    
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                        <div class="dashboard-items" style="padding: 20px; display: flex;">
                            <div>
                                <div class="h1-dashboard">
                                    <?php echo $new_bookings; ?>
                                </div>
                                <div class="h3-dashboard">
                                    New Bookings
                                </div>
                            </div>
                            <div class="btn-icon-back" style="background-image: url('../img/icons/book-hover.svg');"></div>
                        </div>
                        
                        <div class="dashboard-items" style="padding: 20px; display: flex;">
                            <div>
                                <div class="h1-dashboard">
                                    <?php echo $today_sessions; ?>
                                </div>
                                <div class="h3-dashboard">
                                    Today Sessions
                                </div>
                            </div>
                            <div class="btn-icon-back" style="background-image: url('../img/icons/session-iceblue.svg');"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div style="margin-top: 30px;">
                <h2 style="font-size: 20px; font-weight: 600; margin-bottom: 20px;">Your Upcoming Sessions until Next Week</h2>
                <div class="scroll" style="height: 350px; background-color: white; padding: 20px; border-radius: 15px; box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);">
                    <table width="100%" class="sub-table scrolldown" border="0">
                        <thead>
                            <tr>
                                <th class="table-headin">Session Title</th>
                                <th class="table-headin">Scheduled Date</th>
                                <th class="table-headin">Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- This would be filled with PHP-generated table rows -->
                            <tr>
                                <td style="padding:20px;">General Consultation</td>
                                <td style="padding:20px; font-size:13px;">2025-05-15</td>
                                <td style="text-align:center;">10:00</td>
                            </tr>
                            <tr>
                                <td style="padding:20px;">Follow-up Appointment</td>
                                <td style="padding:20px; font-size:13px;">2025-05-16</td>
                                <td style="text-align:center;">14:30</td>
                            </tr>
                            <tr>
                                <td style="padding:20px;">Specialist Consultation</td>
                                <td style="padding:20px; font-size:13px;">2025-05-17</td>
                                <td style="text-align:center;">09:15</td>
                            </tr>
                            <tr>
                                <td style="padding:20px;">Emergency Slot</td>
                                <td style="padding:20px; font-size:13px;">2025-05-18</td>
                                <td style="text-align:center;">16:00</td>
                            </tr>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        
        document.addEventListener("DOMContentLoaded", function() {
            const menuItems = document.querySelectorAll(".menu-btn");
            menuItems.forEach(item => {
                item.addEventListener("click", function() {
                    menuItems.forEach(i => i.classList.remove("menu-active"));
                    this.classList.add("menu-active");
                });
            });
        });
    </script>
</body>
</html>