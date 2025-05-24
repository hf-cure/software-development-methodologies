<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Schedule Manager</title>
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

        .logout-btn {
            width: 80%;
            margin: 15px auto 0;
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

        /* Nav Bar */
        .nav-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid #f1f1f1;
        }

        .header-search {
            display: flex;
            gap: 1rem;
            width: 60%;
        }

        .header-searchbar {
            flex: 1;
            padding: 0.8rem 1.5rem;
            border: 1px solid #e0e0e0;
            border-radius: 50px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .header-searchbar:focus {
            border-color: #ff5722;
            box-shadow: 0 0 0 3px rgba(255, 87, 34, 0.1);
            outline: none;
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

        /* Animations */
        @keyframes transitionIn-X {
            0% { transform: translateX(-100%); opacity: 0; }
            100% { transform: translateX(0); opacity: 1; }
        }

        @keyframes fadeIn {
            0% { opacity: 0; }
            100% { opacity: 1; }
        }

         /* Popup Styles - FIXED */
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
            box-shadow: var(--card-shadow);
        }

        .popup h2 {
            margin-top: 0;
            color: var(--dark);
        }

        .popup .close {
            position: absolute;
            top: 20px;
            right: 30px;
            transition: all 200ms;
            font-size: 30px;
            font-weight: bold;
            text-decoration: none;
            color: var(--dark);
        }

        .popup .close:hover {
            color: var(--primary);
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
            .header-search {
                width: 100%;
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
    if (isset($_SESSION["user"])) {
        if (($_SESSION["user"]) == "" || $_SESSION['usertype'] != 'a') {
            header("location: ../login.php");
        }
    } else {
        header("location: ../login.php");
    }

    include("../connection.php");

    date_default_timezone_set('Australia/Sydney');
    $today = date('d-m-Y');
    $list110 = $database->query("SELECT * FROM schedule");
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
                <td class="menu-btn menu-active">
                    <a href="schedule.php" class="non-style-link-menu">
                        <div>
                            <p class="menu-text">Schedule</p>
                        </div>
                    </a>
                </td>
            </tr>
            <tr class="menu-row">
                <td class="menu-btn">
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
                    <p class="heading-main">Schedule Manager</p>
                    <a href="?action=add-session&id=none&error=0" class="non-style-link">
                        <button class="btn btn-primary" style="margin-bottom: 20px;">
                            <i class="fas fa-plus"></i> Add a Session
                        </button>
                    </a>
                </td>
            </tr>

            <tr>
                <td colspan="2">
                    <p class="heading-sub">All Sessions (<?php echo $list110->num_rows; ?>)</p>
                </td>
            </tr>

            <tr>
                <td colspan="2">
                    <table class="filter-container" border="0" width="100%">
                        <tr>
                            <td width="5%" style="text-align: center;">
                                Date:
                            </td>
                            <td width="30%">
                                <form action="" method="post">
                                    <input type="date" name="sheduledate" id="date" class="input-text filter-container-items" style="width: 95%;">
                            </td>
                            <td width="5%" style="text-align: center;">
                                Doctor:
                            </td>
                            <td width="30%">
                                <select name="docid" class="input-text filter-container-items" style="width:90%">
                                    <option value="" disabled selected hidden>Choose Doctor</option>
                                    <?php 
                                    $list11 = $database->query("SELECT * FROM doctor ORDER BY docname ASC");
                                    while ($row00 = $list11->fetch_assoc()) {
                                        $sn = $row00["docname"];
                                        $id00 = $row00["docid"];
                                        echo "<option value='$id00'>$sn</option>";
                                    }
                                    ?>
                                </select>
                            </td>
                            <td width="12%">
                                <input type="submit" name="filter" value="Filter" class="btn btn-primary" style="width:100%">
                                </form>
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
                                    <th>Session Title</th>
                                    <th>Doctor</th>
                                    <th>Scheduled Date & Time</th>
                                    <th>Max Appointments</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if($_POST){
                                    $sqlpt1 = "";
                                    if(!empty($_POST["sheduledate"])){
                                        $sheduledate = $_POST["sheduledate"];
                                        $sqlpt1 = " schedule.scheduledate='$sheduledate' ";
                                    }

                                    $sqlpt2 = "";
                                    if(!empty($_POST["docid"])){
                                        $docid = $_POST["docid"];
                                        $sqlpt2 = " doctor.docid=$docid ";
                                    }

                                    $sqlmain = "SELECT schedule.scheduleid, schedule.title, doctor.docname, schedule.scheduledate, 
                                               schedule.scheduletime, schedule.nop FROM schedule 
                                               INNER JOIN doctor ON schedule.docid=doctor.docid";
                                    $sqllist = array($sqlpt1, $sqlpt2);
                                    $sqlkeywords = array(" WHERE ", " AND ");
                                    $key2 = 0;
                                    foreach($sqllist as $key){
                                        if(!empty($key)){
                                            $sqlmain .= $sqlkeywords[$key2].$key;
                                            $key2++;
                                        }
                                    }
                                } else {
                                    $sqlmain = "SELECT schedule.scheduleid, schedule.title, doctor.docname, schedule.scheduledate, 
                                               schedule.scheduletime, schedule.nop FROM schedule 
                                               INNER JOIN doctor ON schedule.docid=doctor.docid 
                                               ORDER BY schedule.scheduledate DESC";
                                }

                                $result = $database->query($sqlmain);

                                if($result->num_rows == 0){
                                    echo '<tr>
                                    <td colspan="5" style="text-align:center;padding:20px;">
                                    <img src="../img/notfound.svg" width="25%" style="margin:20px 0;">
                                    <p style="color:#666;margin:10px 0;">We couldn\'t find anything related to your keywords!</p>
                                    <a href="schedule.php" class="non-style-link">
                                        <button class="btn btn-primary" style="width:200px;">Show All Sessions</button>
                                    </a>
                                    </td>
                                    </tr>';
                                } else {
                                    while($row = $result->fetch_assoc()){
                                        $scheduleid = $row["scheduleid"];
                                        $title = $row["title"];
                                        $docname = $row["docname"];
                                        $scheduledate = $row["scheduledate"];
                                        $scheduletime = $row["scheduletime"];
                                        $nop = $row["nop"];
                                        
                                        echo '<tr>
                                            <td>'.substr($title,0,30).'</td>
                                            <td>'.substr($docname,0,20).'</td>
                                            <td style="text-align:center;">'.substr($scheduledate,0,10).' @ '.substr($scheduletime,0,5).'</td>
                                            <td style="text-align:center;">'.$nop.'</td>
                                            <td>
                                                <div style="display:flex;gap:10px;justify-content: center;">
                                                    <a href="?action=view&id='.$scheduleid.'" class="non-style-link">
                                                        <button class="btn-primary-soft btn" style="padding:8px 15px;">
                                                            <i class="fas fa-eye"></i> View
                                                        </button>
                                                    </a>
                                                    <a href="?action=drop&id='.$scheduleid.'&name='.$title.'" class="non-style-link">
                                                        <button class="btn-primary-soft btn" style="padding:8px 15px;background-color:#ffebee;color:#f44336;">
                                                            <i class="fas fa-trash-alt"></i> Remove
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

    <?php 
    if($_GET){
        $id = $_GET["id"];
        $action = $_GET["action"];
        
        if($action == 'add-session'){
            echo '
            <div id="popup1" class="overlay">
                    <div class="popup">
                    <center>
                        <h2>Add New Session</h2>
                        <a class="close" href="schedule.php">&times;</a>
                        <div style="display: flex;justify-content: center;">
                        <table width="80%" class="sub-table" border="0">
                            <tr>
                                <td>
                                    <p style="padding: 0;margin: 0;text-align: left;font-size: 25px;font-weight: 500;color:#ff5722;">Add New Session</p><br>
                                </td>
                            </tr>
                            <tr>
                                <form action="add-session.php" method="POST">
                                <td class="label-td" colspan="2">
                                    <label for="title" class="form-label">Session Title: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <input type="text" name="title" class="input-text" placeholder="Name of this Session" required><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="docid" class="form-label">Select Doctor: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <select name="docid" class="input-text">
                                    <option value="" disabled selected hidden>Choose Doctor</option>';
                                        
                                    $list11 = $database->query("SELECT * FROM doctor ORDER BY docname ASC");
                                    while ($row00 = $list11->fetch_assoc()) {
                                        $sn = $row00["docname"];
                                        $id00 = $row00["docid"];
                                        echo "<option value='$id00'>$sn</option>";
                                    }
                                    
                        echo '</select><br><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="nop" class="form-label">Number of Patients: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <input type="number" name="nop" class="input-text" min="0" placeholder="Maximum appointment numbers" required><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="date" class="form-label">Session Date: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <input type="date" name="date" class="input-text" min="'.date('Y-m-d').'" required><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="time" class="form-label">Schedule Time: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <input type="time" name="time" class="input-text" placeholder="Time" required><br>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <input type="reset" value="Reset" class="btn btn-primary" style="background-color:#9e9e9e;">
                                    <input type="submit" value="Place Session" class="btn btn-primary" name="shedulesubmit">
                                </td>
                            </tr>
                            </form>
                        </table>
                        </div>
                    </center>
                    <br><br>
            </div>
            </div>
            ';
        } elseif($action == 'session-added') {
            $titleget = $_GET["title"];
            echo '
            <div id="popup1" class="overlay">
                    <div class="popup">
                    <center>
                    <br><br>
                        <h2>Session Placed</h2>
                        <a class="close" href="schedule.php">&times;</a>
                        <div class="content">
                            '.substr($titleget,0,40).' was successfully scheduled.
                        </div>
                        <div style="display: flex;justify-content: center;">
                        <a href="schedule.php" class="non-style-link">
                            <button class="btn btn-primary" style="width:100px;">OK</button>
                        </a>
                        </div>
                        <br><br>
                    </center>
            </div>
            </div>
            ';
        } elseif($action == 'drop') {
            $nameget = $_GET["name"];
            echo '
            <div id="popup1" class="overlay">
                    <div class="popup">
                    <center>
                        <h2>Are you sure?</h2>
                        <a class="close" href="schedule.php">&times;</a>
                        <div class="content">
                            You want to delete this session:<br>('.substr($nameget,0,40).')
                        </div>
                        <div style="display: flex;justify-content: center;gap:20px;margin-top:20px;">
                        <a href="delete-session.php?id='.$id.'" class="non-style-link">
                            <button class="btn btn-primary" style="width:100px;">Yes</button>
                        </a>
                        <a href="schedule.php" class="non-style-link">
                            <button class="btn btn-primary" style="background-color:#f44336;width:100px;">No</button>
                        </a>
                        </div>
                    </center>
            </div>
            </div>
            '; 
        } elseif($action == 'view') {
            $sqlmain = "SELECT schedule.scheduleid, schedule.title, doctor.docname, schedule.scheduledate, 
                       schedule.scheduletime, schedule.nop FROM schedule 
                       INNER JOIN doctor ON schedule.docid=doctor.docid  
                       WHERE schedule.scheduleid=$id";
            $result = $database->query($sqlmain);
            $row = $result->fetch_assoc();
            $docname = $row["docname"];
            $scheduleid = $row["scheduleid"];
            $title = $row["title"];
            $scheduledate = $row["scheduledate"];
            $scheduletime = $row["scheduletime"];
            $nop = $row['nop'];

            $sqlmain12 = "SELECT * FROM appointment 
                         INNER JOIN patient ON patient.pid=appointment.pid 
                         INNER JOIN schedule ON schedule.scheduleid=appointment.scheduleid 
                         WHERE schedule.scheduleid=$id";
            $result12 = $database->query($sqlmain12);
            
            echo '
            <div id="popup1" class="overlay">
                    <div class="popup" style="width: 70%;">
                    <center>
                        <h2>Session Details</h2>
                        <a class="close" href="schedule.php">&times;</a>
                        <div style="display: flex;justify-content: center;">
                        <table width="90%" class="sub-table" border="0">
                            <tr>
                                <td>
                                    <p style="padding: 0;margin: 0;text-align: left;font-size: 25px;font-weight: 500;color:#ff5722;">View Details</p><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="name" class="form-label">Session Title: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    '.$title.'<br><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="Email" class="form-label">Doctor: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                '.$docname.'<br><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="nic" class="form-label">Scheduled Date: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                '.$scheduledate.'<br><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="Tele" class="form-label">Scheduled Time: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                '.$scheduletime.'<br><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="spec" class="form-label"><b>Registered Patients:</b> ('.$result12->num_rows."/".$nop.')</label>
                                    <br><br>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <div class="scroll" style="max-height: 300px;">
                                    <table width="100%" class="sub-table" border="0">
                                    <thead>
                                    <tr>   
                                           <th>Patient ID</th>
                                           <th>Patient Name</th>
                                           <th>Appointment #</th>
                                           <th>Telephone</th>
                                    </thead>
                                    <tbody>';
                                    
                                    if($result12->num_rows == 0){
                                        echo '<tr>
                                        <td colspan="4" style="text-align:center;padding:20px;">
                                        <img src="../img/notfound.svg" width="25%" style="margin:20px 0;">
                                        <p style="color:#666;margin:10px 0;">No patients registered for this session</p>
                                        </td>
                                        </tr>';
                                    } else {
                                        while($row = $result12->fetch_assoc()){
                                            $apponum = $row["apponum"];
                                            $pid = $row["pid"];
                                            $pname = $row["pname"];
                                            $ptel = $row["ptel"];
                                            
                                            echo '<tr style="text-align:center;">
                                                <td>'.substr($pid,0,15).'</td>
                                                <td style="font-weight:600;">'.substr($pname,0,25).'</td>
                                                <td style="font-size:23px;font-weight:500;color:#ff5722;">'.$apponum.'</td>
                                                <td>'.substr($ptel,0,25).'</td>
                                            </tr>';
                                        }
                                    }
                                    
                                    echo '</tbody>
                                    </table>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <a href="schedule.php"><button class="btn btn-primary" style="width:100%;">OK</button></a>
                                </td>
                            </tr>
                        </table>
                        </div>
                    </center>
                    <br><br>
            </div>
            </div>
            ';  
        }
    }
    ?>
</body>
</html>