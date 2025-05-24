<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Doctors</title>
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
            min-width: 0; /* Prevent overflow */
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
        .table-container {
            flex: 1;
            min-width: 0; /* Prevent overflow */
        }

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
            width: 80%;
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
                <td class="menu-btn menu-active">
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
                    <form action="doctors.php" method="post" class="header-search">
                        <input type="search" name="search" class="header-searchbar" placeholder="Search Doctor name or Email" list="doctors">
                        <?php
                        echo '<datalist id="doctors">';
                        $list11 = $database->query("SELECT docname, docemail FROM doctor");
                        while ($row00 = $list11->fetch_assoc()) {
                            echo "<option value='{$row00['docname']}'></option>";
                            echo "<option value='{$row00['docemail']}'></option>";
                        }
                        echo '</datalist>';
                        ?>
                        <input type="submit" value="Search" class="btn btn-primary">
                    </form>
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
                    <p class="heading-main">Doctors Management</p>
                    <a href="?action=add&id=none&error=0" class="non-style-link">
                        <button class="btn btn-primary" style="margin-bottom: 20px;">
                            <i class="fas fa-plus"></i> Add New Doctor
                        </button>
                    </a>
                </td>
            </tr>

            <tr>
                <td colspan="2">
                    <p class="heading-sub">All Doctors (<?php 
                        $list11 = $database->query("SELECT * FROM doctor");
                        echo $list11->num_rows; 
                    ?>)</p>
                </td>
            </tr>

            <tr>
                <td colspan="2">
                    <div class="scroll">
                        <table class="sub-table">
                            <thead>
                                <tr>
                                    <th>Doctor Name</th>
                                    <th>Email</th>
                                    <th>Specialties</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if($_POST){
                                    $keyword=$_POST["search"];
                                    $sqlmain= "SELECT * FROM doctor WHERE docemail='$keyword' OR docname='$keyword' OR docname LIKE '$keyword%' OR docname LIKE '%$keyword' OR docname LIKE '%$keyword%'";
                                }else{
                                    $sqlmain= "SELECT * FROM doctor ORDER BY docid DESC";
                                }

                                $result= $database->query($sqlmain);

                                if($result->num_rows==0){
                                    echo '<tr>
                                    <td colspan="4" style="text-align:center;padding:20px;">
                                    <img src="../img/notfound.svg" width="25%" style="margin:20px 0;">
                                    <p style="color:#666;margin:10px 0;">We couldn\'t find anything related to your keywords!</p>
                                    <a href="doctors.php" class="non-style-link">
                                        <button class="btn btn-primary" style="width:200px;">Show All Doctors</button>
                                    </a>
                                    </td>
                                    </tr>';
                                } else {
                                    for ($x=0; $x<$result->num_rows;$x++){
                                        $row=$result->fetch_assoc();
                                        $docid=$row["docid"];
                                        $name=$row["docname"];
                                        $email=$row["docemail"];
                                        $spe=$row["specialties"];
                                        $spcil_res= $database->query("SELECT sname FROM specialties WHERE id='$spe'");
                                        $spcil_array= $spcil_res->fetch_assoc();
                                        $spcil_name=$spcil_array["sname"];
                                        echo '<tr>
                                            <td>'.substr($name,0,30).'</td>
                                            <td>'.substr($email,0,30).'</td>
                                            <td>'.substr($spcil_name,0,30).'</td>
                                            <td>
                                                <div style="display:flex;gap:10px;">
                                                    <a href="?action=edit&id='.$docid.'&error=0" class="non-style-link">
                                                        <button class="btn-primary-soft btn" style="padding:8px 15px;">
                                                            <i class="fas fa-edit"></i> Edit
                                                        </button>
                                                    </a>
                                                    <a href="?action=view&id='.$docid.'" class="non-style-link">
                                                        <button class="btn-primary-soft btn" style="padding:8px 15px;">
                                                            <i class="fas fa-eye"></i> View
                                                        </button>
                                                    </a>
                                                    <a href="?action=drop&id='.$docid.'&name='.$name.'" class="non-style-link">
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
        $id=$_GET["id"];
        $action=$_GET["action"];
        if($action=='drop'){
            $nameget=$_GET["name"];
            echo '
            <div id="popup1" class="overlay">
                    <div class="popup">
                    <center>
                        <h2>Are you sure?</h2>
                        <a class="close" href="doctors.php">&times;</a>
                        <div class="content">
                            You want to delete this record<br>('.substr($nameget,0,40).').
                        </div>
                        <div style="display: flex;justify-content: center;gap:20px;margin-top:20px;">
                        <a href="delete-doctor.php?id='.$id.'" class="non-style-link">
                            <button class="btn btn-primary" style="width:100px;">Yes</button>
                        </a>
                        <a href="doctors.php" class="non-style-link">
                            <button class="btn btn-primary" style="background-color:#f44336;width:100px;">No</button>
                        </a>
                        </div>
                    </center>
            </div>
            </div>
            ';
        }elseif($action=='view'){
            $sqlmain= "SELECT * FROM doctor WHERE docid='$id'";
            $result= $database->query($sqlmain);
            $row=$result->fetch_assoc();
            $name=$row["docname"];
            $email=$row["docemail"];
            $spe=$row["specialties"];
            
            $spcil_res= $database->query("SELECT sname FROM specialties WHERE id='$spe'");
            $spcil_array= $spcil_res->fetch_assoc();
            $spcil_name=$spcil_array["sname"];
            $nic=$row['docnic'];
            $tele=$row['doctel'];
            echo '
            <div id="popup1" class="overlay">
                    <div class="popup">
                    <center>
                        <h2>Doctor Details</h2>
                        <a class="close" href="doctors.php">&times;</a>
                        <div style="display: flex;justify-content: center;">
                        <table width="80%" class="sub-table" border="0">
                            <tr>
                                <td>
                                    <p style="padding: 0;margin: 0;text-align: left;font-size: 25px;font-weight: 500;color:#ff5722;">View Details</p><br>
                                </td>
                            </tr>
                            
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="name" class="form-label">Name: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    '.$name.'<br><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="Email" class="form-label">Email: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                '.$email.'<br><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="nic" class="form-label">NIC: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                '.$nic.'<br><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="Tele" class="form-label">Telephone: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                '.$tele.'<br><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="spec" class="form-label">Specialties: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                '.$spcil_name.'<br><br>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <a href="doctors.php"><button class="btn btn-primary" style="width:100%;">OK</button></a>
                                </td>
                            </tr>
                        </table>
                        </div>
                    </center>
                    <br><br>
            </div>
            </div>
            ';
        }elseif($action=='add'){
            $error_1=$_GET["error"];
            $errorlist= array(
                '1'=>'<label for="promter" class="form-label" style="color:#f44336;text-align:center;">Already have an account for this Email address.</label>',
                '2'=>'<label for="promter" class="form-label" style="color:#f44336;text-align:center;">Password Conformation Error! Reconform Password</label>',
                '3'=>'<label for="promter" class="form-label" style="color:#f44336;text-align:center;"></label>',
                '4'=>"",
                '0'=>'',
            );
            if($error_1!='4'){
                echo '
            <div id="popup1" class="overlay">
                    <div class="popup">
                    <center>
                        <h2>Add New Doctor</h2>
                        <a class="close" href="doctors.php">&times;</a>
                        <div class="content">
                            '.$errorlist[$error_1].'
                        </div>
                        <div style="display: flex;justify-content: center;">
                        <table width="80%" class="sub-table" border="0">
                            <tr>
                                <td>
                                    <p style="padding: 0;margin: 0;text-align: left;font-size: 25px;font-weight: 500;color:#ff5722;">Add New Doctor</p><br>
                                </td>
                            </tr>
                            <tr>
                                <form action="add-new.php" method="POST">
                                <td class="label-td" colspan="2">
                                    <label for="name" class="form-label">Name: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <input type="text" name="name" class="input-text" placeholder="Doctor Name" required><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="Email" class="form-label">Email: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <input type="email" name="email" class="input-text" placeholder="Email Address" required><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="nic" class="form-label">NIC: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <input type="text" name="nic" class="input-text" placeholder="NIC Number" required><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="Tele" class="form-label">Telephone: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <input type="tel" name="Tele" class="input-text" placeholder="Telephone Number" required><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="spec" class="form-label">Choose specialties: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <select name="spec" id="" class="input-text">';
                                        
                                        $list11 = $database->query("SELECT * FROM specialties ORDER BY sname ASC;");
                                        for ($y=0;$y<$list11->num_rows;$y++){
                                            $row00=$list11->fetch_assoc();
                                            $sn=$row00["sname"];
                                            $id00=$row00["id"];
                                            echo "<option value=".$id00.">$sn</option><br/>";
                                        };
                        echo '</select><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="password" class="form-label">Password: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <input type="password" name="password" class="input-text" placeholder="Define a Password" required><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="cpassword" class="form-label">Confirm Password: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <input type="password" name="cpassword" class="input-text" placeholder="Confirm Password" required><br>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <input type="reset" value="Reset" class="btn btn-primary" style="background-color:#9e9e9e;">
                                    <input type="submit" value="Add" class="btn btn-primary">
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
            }else{
                echo '
                    <div id="popup1" class="overlay">
                            <div class="popup">
                            <center>
                            <br><br><br><br>
                                <h2>New Record Added Successfully!</h2>
                                <a class="close" href="doctors.php">&times;</a>
                                <div class="content">
                                    
                                </div>
                                <div style="display: flex;justify-content: center;">
                                <a href="doctors.php" class="non-style-link">
                                    <button class="btn btn-primary" style="width:100px;">OK</button>
                                </a>
                                </div>
                                <br><br>
                            </center>
                    </div>
                    </div>
        ';
            }
        }elseif($action=='edit'){
            $sqlmain= "SELECT * FROM doctor WHERE docid='$id'";
            $result= $database->query($sqlmain);
            $row=$result->fetch_assoc();
            $name=$row["docname"];
            $email=$row["docemail"];
            $spe=$row["specialties"];
            
            $spcil_res= $database->query("SELECT sname FROM specialties WHERE id='$spe'");
            $spcil_array= $spcil_res->fetch_assoc();
            $spcil_name=$spcil_array["sname"];
            $nic=$row['docnic'];
            $tele=$row['doctel'];

            $error_1=$_GET["error"];
            $errorlist= array(
                '1'=>'<label for="promter" class="form-label" style="color:#f44336;text-align:center;">Already have an account for this Email address.</label>',
                '2'=>'<label for="promter" class="form-label" style="color:#f44336;text-align:center;">Password Conformation Error! Reconform Password</label>',
                '3'=>'<label for="promter" class="form-label" style="color:#f44336;text-align:center;"></label>',
                '4'=>"",
                '0'=>'',
            );

            if($error_1!='4'){
                echo '
                <div id="popup1" class="overlay">
                        <div class="popup">
                        <center>
                            <h2>Edit Doctor Details</h2>
                            <a class="close" href="doctors.php">&times;</a>
                            <div class="content">
                                '.$errorlist[$error_1].'
                            </div>
                            <div style="display: flex;justify-content: center;">
                            <table width="80%" class="sub-table" border="0">
                                <tr>
                                    <td>
                                        <p style="padding: 0;margin: 0;text-align: left;font-size: 25px;font-weight: 500;color:#ff5722;">Edit Doctor Details</p>
                                        Doctor ID: '.$id.' (Auto Generated)<br><br>
                                    </td>
                                </tr>
                                <tr>
                                    <form action="edit-doc.php" method="POST">
                                    <input type="hidden" value="'.$id.'" name="id00">
                                    <input type="hidden" name="oldemail" value="'.$email.'">
                                    <td class="label-td" colspan="2">
                                        <label for="Email" class="form-label">Email: </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="label-td" colspan="2">
                                    <input type="email" name="email" class="input-text" placeholder="Email Address" value="'.$email.'" required><br>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="label-td" colspan="2">
                                        <label for="name" class="form-label">Name: </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="label-td" colspan="2">
                                        <input type="text" name="name" class="input-text" placeholder="Doctor Name" value="'.$name.'" required><br>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="label-td" colspan="2">
                                        <label for="nic" class="form-label">NIC: </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="label-td" colspan="2">
                                        <input type="text" name="nic" class="input-text" placeholder="NIC Number" value="'.$nic.'" required><br>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="label-td" colspan="2">
                                        <label for="Tele" class="form-label">Telephone: </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="label-td" colspan="2">
                                        <input type="tel" name="Tele" class="input-text" placeholder="Telephone Number" value="'.$tele.'" required><br>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="label-td" colspan="2">
                                        <label for="spec" class="form-label">Choose specialties: (Current: '.$spcil_name.')</label>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="label-td" colspan="2">
                                        <select name="spec" id="" class="input-text">';
                                            $list11 = $database->query("SELECT * FROM specialties;");
                                            for ($y=0;$y<$list11->num_rows;$y++){
                                                $row00=$list11->fetch_assoc();
                                                $sn=$row00["sname"];
                                                $id00=$row00["id"];
                                                echo "<option value=".$id00.">$sn</option><br/>";
                                            };
                            echo '</select><br><br>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="label-td" colspan="2">
                                        <label for="password" class="form-label">Password: </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="label-td" colspan="2">
                                        <input type="password" name="password" class="input-text" placeholder="Define a Password" required><br>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="label-td" colspan="2">
                                        <label for="cpassword" class="form-label">Confirm Password: </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="label-td" colspan="2">
                                        <input type="password" name="cpassword" class="input-text" placeholder="Confirm Password" required><br>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <input type="reset" value="Reset" class="btn btn-primary" style="background-color:#9e9e9e;">
                                        <input type="submit" value="Save" class="btn btn-primary">
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
            }else{
                echo '
                    <div id="popup1" class="overlay">
                            <div class="popup">
                            <center>
                            <br><br><br><br>
                                <h2>Edit Successfully!</h2>
                                <a class="close" href="doctors.php">&times;</a>
                                <div class="content">
                                    
                                </div>
                                <div style="display: flex;justify-content: center;">
                                <a href="doctors.php" class="non-style-link">
                                    <button class="btn btn-primary" style="width:100px;">OK</button>
                                </a>
                                </div>
                                <br><br>
                            </center>
                    </div>
                    </div>
                ';
            }
        }
    }
    ?>
</body>
</html>