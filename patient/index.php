<?php
    session_start();

    if(isset($_SESSION["user"])){
        if(($_SESSION["user"])=="" or $_SESSION['usertype']!='p'){
            header("location: ../login.php");
        }else{
            $useremail=$_SESSION["user"];
        }
    }else{
        header("Location: ../login.php");
        die;
    }

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

    $today = date('d-m-Y');
    $patientrow = $database->query("select * from patient;");
    $doctorrow = $database->query("select * from doctor;");
    $appointmentrow = $database->query("select * from appointment where appodate>='$today';");
    $schedulerow = $database->query("select * from schedule where scheduledate='$today';");
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
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <title>Patient Dashboard</title>
    <style>
        /* Medical Minimalism Theme */
        :root {
            --primary: #4e73df;
            --primary-light: #7391ff;
            --primary-dark: #2e59d9;
            --secondary: #1cc88a;
            --danger: #e74a3b;
            --warning: #f6c23e;
            --dark: #5a5c69;
            --text: #444;
            --light-text: #888;
            --lighter-text: #999;
            --border: #e3e6f0;
            --bg-light: #f8f9fc;
            --card-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
            --sidebar-dark: #4e73df;
            --sidebar-dark-hover: #3a5ccc;
        }

        * {
            font-family: 'Inter', sans-serif;
        }

        body {
            background-color: var(--bg-light);
            color: var(--text);
        }

        /* Container and Layout */
        .container {
            display: flex;
            height: 100vh;
            background-color: var(--bg-light);
        }

        /* Sidebar Styles */
        .menu {
            width: 250px;
            background: linear-gradient(180deg, var(--sidebar-dark) 0%, var(--primary-dark) 100%);
            color: white;
            box-shadow: var(--card-shadow);
            position: fixed;
            height: 100vh;
            overflow-y: auto;
            transition: all 0.3s;
            z-index: 100;
        }

        .menu-container {
            width: 100%;
        }

        .profile-container {
            padding: 1.5rem 1rem;
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.15);
            margin-bottom: 1rem;
        }

        .profile-title {
            color: white;
            font-weight: 600;
            font-size: 1.1rem;
            margin: 0.5rem 0 0.25rem;
            padding: 0;
        }

        .profile-subtitle {
            color: rgba(255, 255, 255, 0.7);
            font-size: 0.85rem;
            margin: 0;
            padding: 0;
        }

        .menu-row {
            transition: all 0.2s;
        }

        .menu-btn {
            padding: 0.75rem 1rem;
            display: block;
            color: rgba(255, 255, 255, 0.8);
            transition: all 0.2s;
            border-left: 4px solid transparent;
        }

        .menu-btn:hover {
            background-color: var(--sidebar-dark-hover);
            color: white;
            border-left: 4px solid white;
        }

        .menu-active {
            background-color: var(--sidebar-dark-hover);
            color: white;
            border-left: 4px solid white;
        }

        .menu-text {
            font-size: 0.9rem;
            font-weight: 500;
            padding-left: 0.75rem;
        }

        .non-style-link-menu {
            display: flex;
            align-items: center;
            color: inherit;
            text-decoration: none;
        }

        /* Main Content Area */
        .dash-body {
            flex: 1;
            margin-left: 250px;
            padding: 1.5rem;
            overflow-y: auto;
        }

        /* Nav Bar */
        .nav-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid var(--border);
        }

        /* Cards and Containers */
        .card {
            background-color: white;
            border-radius: 0.5rem;
            box-shadow: var(--card-shadow);
            margin-bottom: 1.5rem;
            overflow: hidden;
        }

        .card-header {
            padding: 1rem 1.5rem;
            background-color: white;
            border-bottom: 1px solid var(--border);
        }

        .card-body {
            padding: 1.5rem;
        }

        /* Welcome Section */
        .welcome-section {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            border-radius: 0.5rem;
            padding: 2rem;
            color: white;
            margin-bottom: 1.5rem;
            box-shadow: var(--card-shadow);
            position: relative;
            overflow: hidden;
        }

        .welcome-section h3 {
            font-size: 1.2rem;
            font-weight: 500;
            margin: 0 0 0.25rem;
        }

        .welcome-section h1 {
            font-size: 2rem;
            font-weight: 700;
            margin: 0 0 1rem;
        }

        .welcome-section p {
            font-size: 0.95rem;
            opacity: 0.9;
            margin-bottom: 1.5rem;
            max-width: 650px;
        }

        .welcome-section::after {
            content: '';
            position: absolute;
            top: -30px;
            right: -30px;
            width: 180px;
            height: 180px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
        }

        /* Doctor Search Form */
        .search-form {
            display: flex;
            gap: 0.5rem;
            margin-bottom: 1rem;
        }

        .search-input {
            flex: 1;
            padding: 0.75rem 1rem;
            border: 1px solid var(--border);
            border-radius: 0.5rem;
            font-size: 0.95rem;
            transition: all 0.3s;
        }

        .search-input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
            outline: none;
        }

        .search-btn {
            padding: 0.75rem 1.5rem;
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 0.5rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s;
        }

        .search-btn:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
        }

        /* Stats Section */
        .stats-container {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .stat-card {
            background-color: white;
            border-radius: 0.5rem;
            box-shadow: var(--card-shadow);
            padding: 1.5rem;
            display: flex;
            align-items: center;
            transition: all 0.3s;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 0.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
            margin-right: 1rem;
        }

        .doctors-icon {
            background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
        }

        .patients-icon {
            background: linear-gradient(135deg, #1cc88a 0%, #13855c 100%);
        }

        .bookings-icon {
            background: linear-gradient(135deg, #36b9cc 0%, #258391 100%);
        }

        .sessions-icon {
            background: linear-gradient(135deg, #f6c23e 0%, #dda20a 100%);
        }

        .stat-info h2 {
            font-size: 2rem;
            font-weight: 700;
            margin: 0;
            color: var(--dark);
        }

        .stat-info p {
            font-size: 0.85rem;
            color: var(--light-text);
            margin: 0;
        }

        /* Appointments Table */
        .appointments-section {
            background-color: white;
            border-radius: 0.5rem;
            box-shadow: var(--card-shadow);
            overflow: hidden;
        }

        .section-header {
            padding: 1rem 1.5rem;
            border-bottom: 1px solid var(--border);
            font-size: 1.1rem;
            font-weight: 600;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .section-header-icon {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            background-color: rgba(78, 115, 223, 0.1);
            color: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.875rem;
        }

        .appointments-list {
            max-height: 400px;
            overflow-y: auto;
        }

        .appointments-table {
            width: 100%;
            border-collapse: collapse;
        }

        .appointments-table th {
            text-align: left;
            padding: 1rem 1.5rem;
            background-color: #f8f9fc;
            color: var(--dark);
            font-weight: 600;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 1px solid var(--border);
        }

        .appointments-table td {
            padding: 1rem 1.5rem;
            font-size: 0.95rem;
            color: var(--text);
            border-bottom: 1px solid var(--border);
            vertical-align: middle;
        }

        .appointment-number {
            font-weight: 600;
            color: var(--primary);
            font-size: 1.05rem;
        }

        .appointment-date {
            color: var(--light-text);
            font-size: 0.875rem;
        }

        .empty-appointments {
            padding: 3rem 1.5rem;
            text-align: center;
        }

        .empty-appointments img {
            width: 120px;
            margin-bottom: 1.5rem;
            opacity: 0.6;
        }

        .empty-appointments p {
            font-size: 1.1rem;
            font-weight: 500;
            color: var(--dark);
            margin-bottom: 1.5rem;
        }

        /* Responsive adjustments */
        @media (max-width: 992px) {
            .menu {
                width: 220px;
            }
            .dash-body {
                margin-left: 220px;
            }
            .stats-container {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .menu {
                width: 0;
                transform: translateX(-100%);
            }
            .dash-body {
                margin-left: 0;
            }
            .menu.active {
                width: 250px;
                transform: translateX(0);
            }
            .mobile-menu-btn {
                display: block;
            }
            .search-form {
                flex-direction: column;
            }
        }

        /* Icons for menu items */
        .menu-icon {
            width: 20px;
            height: 20px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }
        
        /* Logout button */
        .logout-btn {
            width: 85%;
            margin: 0.75rem auto;
            padding: 0.75rem;
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 0.375rem;
            cursor: pointer;
            transition: all 0.2s;
            font-weight: 500;
            font-size: 0.9rem;
        }
        
        .logout-btn:hover {
            background-color: rgba(255, 255, 255, 0.2);
        }

        /* Animation Classes */
        .dashbord-tables {
            animation: transitionIn-Y-over 0.5s;
        }
        .filter-container {
            animation: transitionIn-Y-bottom 0.5s;
        }
        .sub-table, .anime {
            animation: transitionIn-Y-bottom 0.5s;
        }
    </style>
</head>
<body>
    <?php

    if(isset($_SESSION["user"])){
        if(($_SESSION["user"])=="" or $_SESSION['usertype']!='p'){
            echo('coming here in session');exit;
            header("location: ../login.php");
        }else{
            $useremail=$_SESSION["user"];
        }
    }else{
        header("location: ../index.php"); exit;
        header("Location: ../login.php");
        exit;
    }

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

    date_default_timezone_set('Australia/Sydney');
    $today = date('d-m-Y');
    $patientrow = $database->query("select * from patient;");
    $doctorrow = $database->query("select * from doctor;");
    $appointmentrow = $database->query("select * from appointment where appodate>='$today';");
    $schedulerow = $database->query("select * from schedule where scheduledate='$today';");
    ?>

    <div class="container-fluid">
        <!-- Sidebar / Menu -->
        <div class="menu">
            <div class="profile-container">
                <img src="../img/user.png" alt="Profile" width="70" style="border-radius:50%">
                <p class="profile-title"><?php echo substr(strval($username), 0, 13); ?></p>
                <p class="profile-subtitle"><?php echo substr(strval($useremail), 0, 22); ?></p>
                <a href="../logout.php"><button class="logout-btn">Log out</button></a>
            </div>
            
            <table class="menu-container" border="0">
                <tr class="menu-row">
                    <td class="menu-btn menu-active">
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
                    <td class="menu-btn">
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
                    <p style="font-size: 23px; font-weight: 600;">Dashboard</p>
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

            <!-- Welcome Section -->
            <div class="welcome-section">
                <div>
                    <h3>Welcome back!</h3>
                    <h1><?php echo $username; ?></h1>
                    <p>
                        Need to find the right doctor? Check out our 
                        <a href="doctors.php" style="color: white; text-decoration: underline;">All Doctors</a> 
                        section or view scheduled 
                        <a href="schedule.php" style="color: white; text-decoration: underline;">Sessions</a>. 
                        You can also track your past and upcoming appointments.
                    </p>
                </div>
                
                <!-- Doctor Search Form -->
                <form action="schedule.php" method="post" class="search-form">
                    <input type="search" name="search" class="search-input" placeholder="Search doctor name to find available sessions" list="doctors">
                    
                    <?php
                    echo '<datalist id="doctors">';
                    $list11 = $database->query("select docname,docemail from doctor;");
                    for ($y=0;$y<$list11->num_rows;$y++){
                        $row00=$list11->fetch_assoc();
                        $d=$row00["docname"];
                        echo "<option value='$d'><br/>";
                    };
                    echo '</datalist>';
                    ?>
                    
                    <button type="submit" class="search-btn">
                        <i class="fas fa-search" style="margin-right: 8px;"></i> Find Doctor
                    </button>
                </form>
            </div>

            <!-- Stats Cards -->
            <div class="stats-container">
                <div class="stat-card">
                    <div class="stat-icon doctors-icon">
                        <i class="fas fa-user-md"></i>
                    </div>
                    <div class="stat-info">
                        <h2><?php echo $doctorrow->num_rows ?></h2>
                        <p>Available Doctors</p>
                    </div>
                </div>
                
                <div class="stat-card" style="display: none;">
                    <div class="stat-icon patients-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="stat-info">
                        <h2><?php echo $patientrow->num_rows ?></h2>
                        <p>Registered Patients</p>
                    </div>
                </div>
                
                <div class="stat-card" style="display: none;">
                    <div class="stat-icon bookings-icon">
                        <i class="fas fa-calendar-plus"></i>
                    </div>
                    <div class="stat-info">
                        <h2><?php echo $appointmentrow->num_rows ?></h2>
                        <p>New Bookings</p>
                    </div>
                </div>
                
                <div class="stat-card" >
                    <div class="stat-icon sessions-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="stat-info">
                        <h2><?php echo $schedulerow->num_rows ?></h2>
                        <p>Today's Sessions</p>
                    </div>
                </div>
            </div>

            <!-- Upcoming Appointments -->
            <div class="appointments-section">
                <div class="section-header">
                    <div style="display: flex; align-items: center;">
                        <div class="section-header-icon">
                            <i class="fas fa-calendar-check"></i>
                        </div>
                        <span style="margin-left: 10px;">Your Upcoming Appointments</span>
                    </div>
                </div>
                
                <div class="appointments-list">
                    <?php
                    $sqlmain= "select * from schedule inner join appointment on schedule.scheduleid=appointment.scheduleid 
                              inner join patient on patient.pid=appointment.pid 
                              inner join doctor on schedule.docid=doctor.docid  
                              where patient.pid=$userid and schedule.scheduledate>='$today' 
                              order by schedule.scheduledate asc";
                    
                    $result= $database->query($sqlmain);
                    
                    if($result->num_rows==0) {
                        echo '<div class="empty-appointments">
                                <img src="../img/notfound.svg" alt="No appointments">
                                <p>No upcoming appointments found!</p>
                                <a href="schedule.php">
                                    <button class="search-btn">
                                        <i class="fas fa-calendar-plus" style="margin-right: 8px;"></i> Book an Appointment
                                    </button>
                                </a>
                            </div>';
                    } else {
                        echo '<table class="appointments-table">
                                <thead>
                                    <tr>
                                        <th>Appointment #</th>
                                        <th>Session Title</th>
                                        <th>Doctor</th>
                                        <th>Date & Time</th>
                                    </tr>
                                </thead>
                                <tbody>';
                                
                        for ($x=0; $x<$result->num_rows; $x++) {
                            $row=$result->fetch_assoc();
                            $scheduleid=$row["scheduleid"];
                            $title=$row["title"];
                            $apponum=$row["apponum"];
                            $docname=$row["docname"];
                            $scheduledate=$row["scheduledate"];
                            $scheduletime=$row["scheduletime"];

                            $aDate = strtotime($scheduledate);
                            // $aDate = DateTime::createFromFormat($aDate);
                            
                            echo '<tr>
                                    <td>
                                        <span class="appointment-number">#'.$apponum.'</span>
                                    </td>
                                    <td>'.substr($title,0,30).'</td>
                                    <td>
                                        <div style="display: flex; align-items: center;">
                                            <div style="width: 30px; height: 30px; background-color: #e9ecef; border-radius: 50%; display: flex; justify-content: center; align-items: center; margin-right: 10px;">
                                                <i class="fas fa-user-md" style="color: var(--primary);"></i>
                                            </div>
                                            '.substr($docname,0,20).'
                                        </div>
                                    </td>
                                    <td>
                                        <div style="display: flex; align-items: center;">
                                            <div style="width: 30px; height: 30px; background-color: #e9ecef; border-radius: 50%; display: flex; justify-content: center; align-items: center; margin-right: 10px;">
                                                <i class="fas fa-calendar-day" style="color: var(--primary);"></i>
                                            </div>
                                            <span class="appointment-date">'.
                                            date('d-m-Y', $aDate). 
                                                ' at '.substr($scheduletime,0,5).
                                            '</span>
                                        </div>
                                    </td>
                                </tr>';
                        }
                        
                        echo '</tbody>
                            </table>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Add responsive mobile menu toggle functionality
        document.addEventListener('DOMContentLoaded', function() {
            // You could add mobile menu toggle functionality here
            // For example:
            // const mobileMenuBtn = document.querySelector('.mobile-menu-btn');
            // const menu = document.querySelector('.menu');
            // mobileMenuBtn.addEventListener('click', function() {
            //     menu.classList.toggle('active');
            // });
        });
    </script>
</body>
</html>