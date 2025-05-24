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
    <title>My Appointments</title>
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
            display: flex;
            min-height: 100vh;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        /* Animations */
        @keyframes transitionIn-X {
            0% { transform: translateX(-100%); opacity: 0; }
            100% { transform: translateX(0); opacity: 1; }
        }

        @keyframes fadeIn {
            0% { opacity: 0; }
            100% { opacity: 1; }
        }

        /* Menu Styles */
        .menu {
            width: 300px;
            background: #fff;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            position: fixed;
            left: 0;
            top: 0;
            bottom: 0;
            overflow-y: auto;
            z-index: 100;
            animation: transitionIn-X 0.5s ease-out;
        }

        .profile-container {
            padding: 20px;
            border-bottom: 1px solid #f1f1f1;
            margin-bottom: 15px;
            text-align: center;
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

        .menu-btn {
            padding: 15px 25px;
            display: block;
            transition: all 0.3s ease;
            border-left: 4px solid transparent;
            color: #666;
        }

        .menu-btn:hover {
            background-color: #f8f9fa;
            border-left: 4px solid #ff5722;
            color: #333;
        }

        .menu-active {
            background-color: #f8f9fa;
            border-left: 4px solid #ff5722;
            color: #333;
        }

        /* Main Content Area */
        .dash-body {
            flex: 1;
            margin-left: 300px;
            padding: 2rem;
            animation: fadeIn 0.6s ease-in-out;
            min-width: 0;
        }

        /* Button Styles */
        .btn {
            display: inline-block;
            padding: 0.8rem 1.5rem;
            font-weight: 600;
            font-size: 0.9rem;
            border-radius: 50px;
            transition: all 0.3s ease;
            cursor: pointer;
            border: none;
        }

        .btn-primary {
            background: linear-gradient(135deg, #ff9800, #ff5722);
            color: #fff;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #ff5722, #ff9800);
            box-shadow: 0 8px 16px rgba(255, 87, 34, 0.2);
            transform: translateY(-2px);
        }

        .btn-primary-soft {
            background-color: #fff;
            color: #ff5722;
            border: 1px solid #ff5722;
        }

        .btn-primary-soft:hover {
            background-color: #ff5722;
            color: #fff;
            transform: translateY(-2px);
        }

        .logout-btn {
            width: 80%;
            margin: 15px auto 0;
        }

        /* Nav Bar */
        .nav-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid #f1f1f1;
        }

        .heading-main {
            font-size: 1.8rem;
            color: #333;
            margin-bottom: 1.5rem;
            font-weight: 600;
        }

        .heading-sub {
            font-size: 1.3rem;
            color: #ff5722;
            margin-bottom: 1rem;
            font-weight: 600;
        }

        /* Filter Styles */
        .filter-container {
            width: 100%;
            margin: 20px 0;
        }

        .filter-container-items {
            padding: 0.8rem 1rem;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .filter-container-items:focus {
            border-color: #ff5722;
            box-shadow: 0 0 0 3px rgba(255, 87, 34, 0.1);
            outline: none;
        }

        /* Tables */
        .scroll {
            max-height: 500px;
            overflow-y: auto;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
        }

        .sub-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            background: #fff;
        }

        .sub-table th {
            padding: 15px 20px;
            background-color: #f8f9fa;
            color: #666;
            font-weight: 600;
            text-align: left;
            border-bottom: 1px solid #f1f1f1;
            position: sticky;
            top: 0;
        }

        .sub-table td {
            padding: 15px 20px;
            color: #333;
            border-bottom: 1px solid #f1f1f1;
        }

        /* Popup Styles */
        .overlay {
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            background: rgba(0, 0, 0, 0.7);
            transition: opacity 500ms;
            visibility: visible;
            opacity: 1;
            z-index: 1000;
            overflow-y: auto;
        }

        .popup {
            margin: 70px auto;
            padding: 20px;
            background: #fff;
            border-radius: 10px;
            width: 50%;
            max-width: 600px;
            position: relative;
            transition: all 0.5s ease-in-out;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.2);
        }

        .popup h2 {
            margin-top: 0;
            color: #333;
        }

        .popup .close {
            position: absolute;
            top: 20px;
            right: 30px;
            transition: all 200ms;
            font-size: 30px;
            font-weight: bold;
            text-decoration: none;
            color: #333;
        }

        .popup .close:hover {
            color: #ff5722;
        }

        /* Form Styles */
        .input-text {
            width: 100%;
            padding: 0.8rem 1rem;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .input-text:focus {
            border-color: #ff5722;
            box-shadow: 0 0 0 3px rgba(255, 87, 34, 0.1);
            outline: none;
        }

        .label-td {
            padding: 10px 0;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .menu {
                width: 250px;
            }
            .dash-body {
                margin-left: 250px;
            }
        }

        @media (max-width: 768px) {
            body {
                flex-direction: column;
            }
            .menu {
                width: 100%;
                position: relative;
                height: auto;
            }
            .dash-body {
                margin-left: 0;
                width: 100%;
                padding: 1.5rem;
            }
            .filter-container {
                display: flex;
                flex-direction: column;
                gap: 10px;
            }
        }
    </style>
</head>
<body>
    <?php

    session_start();

    if(isset($_SESSION["user"])){
        if(($_SESSION["user"])=="" or $_SESSION['usertype']!='d'){
            header("location: ../login.php");
        }else{
            $useremail=$_SESSION["user"];
        }
    }else{
        header("location: ../login.php");
    }

    $useremail='doctor@docappoint.com';
    

    include("../connection.php");
    $userrow = $database->query("select * from doctor where docemail='$useremail'");
    $userfetch=$userrow->fetch_assoc();
    $userid= $userfetch["docid"];
    $username=$userfetch["docname"];
    

    $list110 = $database->query("select * from schedule inner join appointment on schedule.scheduleid=appointment.scheduleid inner join patient on patient.pid=appointment.pid inner join doctor on schedule.docid=doctor.docid where doctor.docid=$userid");
    $appointment_count = $list110->num_rows;
    
    // Get today's date
    date_default_timezone_set('Australia/Sydney');
    $today = date('d-m-Y');
    ?>

    <div class="menu">
        <table class="menu-container" border="0">
            <tr>
                <td style="padding:20px" colspan="2">
                    <table border="0" class="profile-container">
                        <tr>
                            <td width="30%" style="padding-left:20px">
                                <img src="../img/user.png" alt="" width="100%" style="border-radius:50%">
                            </td>
                            <td style="padding:0px;margin:0px;">
                                <p class="profile-title">Administrator</p>
                                <p class="profile-subtitle">admin@docappoint.com</p>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <a href="../logout.php"><input type="button" value="Log out" class="btn btn-primary logout-btn"></a>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr class="menu-row">
                <td class="menu-btn">
                    <a href="index.php" class="non-style-link-menu">
                        <div>
                            <p class="menu-text">Dashboard</p>
                        </div>
                    </a>
                </td>
            </tr>
            <tr class="menu-row">
                <td class="menu-btn">
                    <a href="doctors.php" class="non-style-link-menu">
                        <div>
                            <p class="menu-text">Doctors</p>
                        </div>
                    </a>
                </td>
            </tr>
            <tr class="menu-row">
                <td class="menu-btn">
                    <a href="schedule.php" class="non-style-link-menu">
                        <div>
                            <p class="menu-text">Schedule</p>
                        </div>
                    </a>
                </td>
            </tr>
            <tr class="menu-row">
                <td class="menu-btn menu-active">
                    <a href="appointment.php" class="non-style-link-menu">
                        <div>
                            <p class="menu-text">Appointment</p>
                        </div>
                    </a>
                </td>
            </tr>
            <tr class="menu-row">
                <td class="menu-btn">
                    <a href="patient.php" class="non-style-link-menu">
                        <div>
                            <p class="menu-text">Patients</p>
                        </div>
                    </a>
                </td>
            </tr>
        </table>
    </div>
    
    <div class="dash-body">
        <table border="0" width="100%" style="border-spacing: 0;margin:0;padding:0;">
             <tr>
                <td colspan="2" class="nav-bar">
                    <div class="header-search" style="visibility: hidden;"></div>
                    <div style="display: flex; align-items: center; gap: 15px;">
                        <div style="text-align: right;">
                            <p style="font-size: 14px; color: #666;">Today's Date</p>
                            <p style="font-size: 1.1rem; font-weight: 600; color: #ff5722;"><?php echo $today; ?></p>
                        </div>
                        <button class="btn-label" style="background: none; border: none;">
                            <i class="fas fa-calendar-alt" style="font-size: 24px; color: #ff5722;"></i>
                        </button>
                    </div>
                </td>
            </tr>

            <tr>
                <td colspan="2">
                    <p class="heading-main">Appointment Manager</p>
                </td>
            </tr>

            <tr>
                <td colspan="2">
                    <p class="heading-sub">Appointments (<?php echo $appointment_count; ?>)</p>
                </td>
            </tr>

            <tr>
                <td colspan="2">
                    <table class="filter-container" border="0" width="100%">
                        <tr>
                            <td width="10%" style="text-align: center;">
                                Filter by Date:
                            </td>
                            <td width="50%">
                                <form action="" method="post">
                                    <input type="date" name="sheduledate" class="input-text filter-container-items" style="width: 95%;">
                            </td>
                            <td width="20%">
                                <input type="submit" name="filter" value="Filter" class="btn btn-primary" style="width:100%">
                                </form>
                            </td>
                            <td width="20%" style="text-align: center;">
                                <?php if(isset($_POST['filter'])): ?>
                                    <a href="appointment.php" class="btn btn-primary-soft" style="width:100%;">Reset</a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            
            <tr>
                <td colspan="2">
                    <div class="scroll">
                        <table class="sub-table">
                            <thead>
                                <tr>
                                    <th>Patient Name</th>
                                    <th>Appointment #</th>
                                    <th>Session Title</th>
                                    <th>Session Date & Time</th>
                                    <th>Appointment Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sqlmain = "select appointment.appoid,schedule.scheduleid,schedule.title,doctor.docname,patient.pname,schedule.scheduledate,schedule.scheduletime,appointment.apponum,appointment.appodate from schedule inner join appointment on schedule.scheduleid=appointment.scheduleid inner join patient on patient.pid=appointment.pid inner join doctor on schedule.docid=doctor.docid where doctor.docid=$userid";

                                if(isset($_POST['filter'])){
                                    if(!empty($_POST["sheduledate"])){
                                        $sheduledate=$_POST["sheduledate"];
                                        $sqlmain.=" and schedule.scheduledate='$sheduledate'";
                                    }
                                }

                                $sqlmain .= " ORDER BY schedule.scheduledate DESC";
                                $result= $database->query($sqlmain);

                                if($result->num_rows==0){
                                    echo '<tr>
                                        <td colspan="6" style="text-align:center;padding:20px;">
                                            <img src="../img/notfound.svg" width="25%" style="margin:20px 0;">
                                            <p style="color:#666;margin:10px 0;">No appointments found matching your criteria</p>
                                            <a href="appointment.php" class="non-style-link">
                                                <button class="btn btn-primary" style="width:200px;">Show All Appointments</button>
                                            </a>
                                        </td>
                                    </tr>';
                                } else {
                                    for($x=0; $x<$result->num_rows; $x++){
                                        $row=$result->fetch_assoc();
                                        $appoid=$row["appoid"];
                                        $scheduleid=$row["scheduleid"];
                                        $title=$row["title"];
                                        $docname=$row["docname"];
                                        $scheduledate=$row["scheduledate"];
                                        $scheduletime=$row["scheduletime"];
                                        $pname=$row["pname"];
                                        $apponum=$row["apponum"];
                                        $appodate=$row["appodate"];
                                        
                                        echo '<tr>
                                            <td style="font-weight: 600;">'.substr($pname, 0, 25).'</td>
                                            <td style="text-align: center; font-size: 20px; font-weight: 500; color: #ff5722;">'.$apponum.'</td>
                                            <td>'.substr($title, 0, 30).'</td>
                                            <td style="text-align:center;">'.substr($scheduledate, 0, 10).' @ '.substr($scheduletime, 0, 5).'</td>
                                            <td style="text-align:center;">'.$appodate.'</td>
                                            <td>
                                                <div style="display:flex;gap:10px;justify-content: center;">
                                                    <a href="?action=view&id='.$appoid.'&scheduleid='.$scheduleid.'" class="non-style-link">
                                                        <button class="btn-primary-soft btn" style="padding:8px 15px;">
                                                            <i class="fas fa-eye"></i> View
                                                        </button>
                                                    </a>
                                                    <a href="?action=drop&id='.$appoid.'&name='.$pname.'&session='.$title.'&apponum='.$apponum.'" class="non-style-link">
                                                        <button class="btn-primary-soft btn" style="padding:8px 15px;background-color:#ffebee;color:#f44336;">
                                                            <i class="fas fa-times-circle"></i> Cancel
                                                        </button>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>';
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </td>
            </tr>
        </table>
    </div>

    <!-- Popups for actions -->
    <?php
    if(isset($_GET['action'])){
        $id = $_GET["id"];
        $action = $_GET["action"];
        
        if($action == 'drop'){
            $nameget = $_GET["name"];
            $session = $_GET["session"];
            $apponum = $_GET["apponum"];
            
            echo '
            <div id="popup1" class="overlay">
                <div class="popup">
                    <center>
                        <h2>Are you sure?</h2>
                        <a class="close" href="appointment.php">&times;</a>
                        <div class="content">
                            You want to cancel this appointment:<br><br>
                            <b>Patient:</b> '.substr($nameget, 0, 40).'<br>
                            <b>Appointment #:</b> '.$apponum.'<br>
                            <b>Session:</b> '.substr($session, 0, 40).'<br><br>
                        </div>
                        <div style="display: flex;justify-content: center;gap:20px;margin-top:20px;">
                            <a href="delete-appointment.php?id='.$id.'" class="non-style-link">
                                <button class="btn btn-primary" style="width:100px;">Yes</button>
                            </a>
                            <a href="appointment.php" class="non-style-link">
                                <button class="btn btn-primary" style="background-color:#f44336;width:100px;">No</button>
                            </a>
                        </div>
                    </center>
                </div>
            </div>';
        } elseif($action == 'view'){
            $scheduleid = $_GET["scheduleid"];
            

            
            $sqlmain = "select appointment.appoid,appointment.apponum,appointment.appodate,schedule.scheduleid,schedule.title,doctor.docname,patient.pname,patient.ptel,patient.pemail,schedule.scheduledate,schedule.scheduletime from schedule inner join appointment on schedule.scheduleid=appointment.scheduleid inner join patient on patient.pid=appointment.pid inner join doctor on schedule.docid=doctor.docid where appointment.appoid=$id";
            $result = $database->query($sqlmain);
            $row = $result->fetch_assoc();
            
            $appoid = $row["appoid"];
            $apponum = $row["apponum"];
            $appodate = $row["appodate"];
            $title = $row["title"];
            $docname = $row["docname"];
            $pname = $row["pname"];
            $ptel = $row["ptel"];
            $pemail = $row["pemail"];
            $scheduledate = $row["scheduledate"];
            $scheduletime = $row["scheduletime"];

            echo '
            <div id="popup1" class="overlay">
                <div class="popup" style="width: 70%;">
                    <center>
                        <h2>Appointment Details</h2>
                        <a class="close" href="appointment.php">&times;</a>
                        <div style="display: flex;justify-content: center;">
                        <table width="90%" class="sub-table" border="0">
                            <tr>
                                <td>
                                    <p style="padding: 0;margin: 0;text-align: left;font-size: 25px;font-weight: 500;color:#ff5722;">View Details</p><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="name" class="form-label">Appointment #: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <span style="color: #ff5722; font-size: 18px; font-weight: 600;">'.$apponum.'</span><br><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="Email" class="form-label">Session Title: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                '.$title.'<br><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="nic" class="form-label">Doctor: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                '.$docname.'<br><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="Tele" class="form-label">Scheduled Date: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                '.$scheduledate.'<br><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="spec" class="form-label">Scheduled Time: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                '.$scheduletime.'<br><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="spec" class="form-label">Appointment Date: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                '.$appodate.'<br><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="spec" class="form-label"><b>Patient Information:</b></label>
                                    <br><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="spec" class="form-label">Patient Name: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                '.$pname.'<br><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="spec" class="form-label">Contact Number: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                '.$ptel.'<br><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="spec" class="form-label">Email: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                '.$pemail.'<br><br>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <a href="appointment.php"><button class="btn btn-primary" style="width:100px;">OK</button></a>
                                </td>
                            </tr>
                        </table>
                        </div>
                    </center>
                    <br><br>
                </div>
            </div>';
        }
    }
    ?>

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