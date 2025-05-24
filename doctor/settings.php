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
    <title>Settings</title>
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

        /* Settings Cards */
        .settings-card {
            background: #fff;
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 20px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
        }

        .settings-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .settings-icon {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 20px;
            background: rgba(255, 87, 34, 0.1);
        }

        .settings-icon i {
            font-size: 28px;
            color: #ff5722;
        }

        .settings-content h3 {
            font-size: 1.3rem;
            font-weight: 600;
            margin-bottom: 5px;
            color: #333;
        }

        .settings-content p {
            font-size: 0.95rem;
            color: #666;
            margin-bottom: 0;
        }

        /* Form Styles */
        .input-text {
            padding: 12px 15px;
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            font-size: 1rem;
            transition: all 0.3s ease;
            width: 100%;
            margin-bottom: 15px;
        }

        .input-text:focus {
            border-color: #ff5722;
            box-shadow: 0 0 0 3px rgba(255, 87, 34, 0.1);
            outline: none;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #555;
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
            z-index: 999;
        }

        .popup {
            margin: 70px auto;
            padding: 30px;
            background: #fff;
            border-radius: 15px;
            width: 50%;
            max-height: 90vh; /* Add max height */
            position: relative;
            transition: all 0.5s ease-in-out;
            animation: slideInFromTop 0.5s ease-out;
            display: flex;
            flex-direction: column;
        }

        .popup h2 {
            margin-top: 0;
            color: #333;
            font-size: 1.5rem;
            text-align: center;
            margin-bottom: 20px;
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

        .popup .content {
            flex: 1;
            overflow-y: auto;
            padding: 20px 0;
            max-height: calc(90vh - 150px); /* Adjust based on header/footer space */
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
            .popup {
                width: 80%;
            }
            .settings-card {
                flex-direction: column;
                text-align: center;
            }
            .settings-icon {
                margin-right: 0;
                margin-bottom: 15px;
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

    //import database
    include("../connection.php");
    $userrow = $database->query("select * from doctor where docemail='$useremail'");
    $userfetch = $userrow->fetch_assoc();
    $userid = $userfetch["docid"];
    $username = $userfetch["docname"];

    // Get today's date
    date_default_timezone_set('Australia/Sydney');
    $today = date('d-m-Y');
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
                    <td class="menu-btn">
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
                    <td class="menu-btn menu-active">
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
                    <p style="font-size: 23px; font-weight: 600; margin: 0;">Account Settings</p>
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

            <div style="margin-top: 30px;">
                <div class="settings-card" onclick="window.location.href='?action=edit&id=<?php echo $userid ?>&error=0'">
                    <div class="settings-icon">
                        <i class="fas fa-user-edit"></i>
                    </div>
                    <div class="settings-content">
                        <h3>Account Settings</h3>
                        <p>Edit your Account Details & Change Password</p>
                    </div>
                    <i class="fas fa-chevron-right" style="margin-left: auto; color: #ccc;"></i>
                </div>

                <div class="settings-card" onclick="window.location.href='?action=view&id=<?php echo $userid ?>'">
                    <div class="settings-icon">
                        <i class="fas fa-eye"></i>
                    </div>
                    <div class="settings-content">
                        <h3>View Account Details</h3>
                        <p>View personal information about your account</p>
                    </div>
                    <i class="fas fa-chevron-right" style="margin-left: auto; color: #ccc;"></i>
                </div>

                <div class="settings-card" onclick="window.location.href='?action=drop&id=<?php echo $userid . '&name=' . $username ?>'" style="border-left: 4px solid #ff5050;">
                    <div class="settings-icon" style="background: rgba(255, 80, 80, 0.1);">
                        <i class="fas fa-user-times" style="color: #ff5050;"></i>
                    </div>
                    <div class="settings-content">
                        <h3 style="color: #ff5050;">Delete Account</h3>
                        <p>Permanently remove your account from the system</p>
                    </div>
                    <i class="fas fa-chevron-right" style="margin-left: auto; color: #ff5050;"></i>
                </div>
            </div>
        </div>
    </div>

    <?php
    if ($_GET) {
        $id = $_GET["id"];
        $action = $_GET["action"];
        
        if ($action == 'drop') {
            $nameget = $_GET["name"];
            echo '
            <div id="popup1" class="overlay">
                <div class="popup">
                    <center>
                        <h2>Confirm Account Deletion</h2>
                        <a class="close" href="settings.php">&times;</a>
                        <div class="content">
                            You are about to permanently delete your account:<br><br>
                            <b>Name:</b> '.substr($nameget, 0, 40).'<br>
                            <b>ID:</b> '.$id.'<br><br>
                            This action cannot be undone. All your data will be permanently removed.
                        </div>
                        <div style="display: flex; justify-content: center; gap: 20px; margin-top: 20px;">
                            <a href="delete-doctor.php?id='.$id.'" class="btn btn-primary">Yes, Delete</a>
                            <a href="settings.php" class="btn btn-primary-soft">Cancel</a>
                        </div>
                    </center>
                </div>
            </div>
            ';
        } elseif ($action == 'view') {
            $sqlmain = "select * from doctor where docid='$id'";
            $result = $database->query($sqlmain);
            $row = $result->fetch_assoc();
            $name = $row["docname"];
            $email = $row["docemail"];
            $spe = $row["specialties"];

            $spcil_res = $database->query("select sname from specialties where id='$spe'");
            $spcil_array = $spcil_res->fetch_assoc();
            $spcil_name = $spcil_array["sname"];
            $nic = $row['docnic'];
            $tele = $row['doctel'];
            
            echo '
            <div id="popup1" class="overlay">
                <div class="popup">
                    <center>
                        <h2>Account Details</h2>
                        <a class="close" href="settings.php">&times;</a>
                        <div class="content">
                            <table width="100%" class="sub-table" border="0">
                                <tr>
                                    <td colspan="2">
                                        <p style="font-size: 1.2rem; font-weight: 600; text-align: center; margin-bottom: 20px;">Your Account Information</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="label-td" width="30%">Name:</td>
                                    <td class="label-td">'.$name.'</td>
                                </tr>
                                <tr>
                                    <td class="label-td">Email:</td>
                                    <td class="label-td">'.$email.'</td>
                                </tr>
                                <tr>
                                    <td class="label-td">NIC:</td>
                                    <td class="label-td">'.$nic.'</td>
                                </tr>
                                <tr>
                                    <td class="label-td">Telephone:</td>
                                    <td class="label-td">'.$tele.'</td>
                                </tr>
                                <tr>
                                    <td class="label-td">Specialty:</td>
                                    <td class="label-td">'.$spcil_name.'</td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="text-align: center; padding-top: 20px;">
                                        <a href="settings.php"><button class="btn btn-primary">OK</button></a>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </center>
                </div>
            </div>
            ';
        } elseif ($action == 'edit') {
            $sqlmain = "select * from doctor where docid='$id'";
            $result = $database->query($sqlmain);
            $row = $result->fetch_assoc();
            $name = $row["docname"];
            $email = $row["docemail"];
            $spe = $row["specialties"];

            $spcil_res = $database->query("select sname from specialties where id='$spe'");
            $spcil_array = $spcil_res->fetch_assoc();
            $spcil_name = $spcil_array["sname"];
            $nic = $row['docnic'];
            $tele = $row['doctel'];

            $error_1 = $_GET["error"];
            $errorlist = array(
                '1' => '<div style="color:rgb(255, 62, 62);text-align:center;margin-bottom:15px;">Already have an account for this Email address.</div>',
                '2' => '<div style="color:rgb(255, 62, 62);text-align:center;margin-bottom:15px;">Password Conformation Error! Reconform Password</div>',
                '3' => '<div style="color:rgb(255, 62, 62);text-align:center;margin-bottom:15px;"></div>',
                '4' => "",
                '0' => '',
            );

            if ($error_1 != '4') {
                echo '
                <div id="popup1" class="overlay">
                    <div class="popup">
                        <center>
                            <h2>Edit Account Details</h2>
                            <a class="close" href="settings.php">&times;</a>
                            <div class="content">
                                '.$errorlist[$error_1].'
                                <form action="edit-doc.php" method="POST" class="add-new-form" style="padding-right: 15px;">
                                    <input type="hidden" value="'.$id.'" name="id00">
                                    <input type="hidden" name="oldemail" value="'.$email.'">
                                    
                                    <label for="Email" class="form-label">Email:</label>
                                    <input type="email" name="email" class="input-text" placeholder="Email Address" value="'.$email.'" required>
                                    
                                    <label for="name" class="form-label">Name:</label>
                                    <input type="text" name="name" class="input-text" placeholder="Doctor Name" value="'.$name.'" required>
                                    
                                    <label for="nic" class="form-label">NIC:</label>
                                    <input type="text" name="nic" class="input-text" placeholder="NIC Number" value="'.$nic.'" required>
                                    
                                    <label for="Tele" class="form-label">Telephone:</label>
                                    <input type="tel" name="Tele" class="input-text" placeholder="Telephone Number" value="'.$tele.'" required>
                                    
                                    <label for="spec" class="form-label">Specialty: (Current: '.$spcil_name.')</label>
                                    <select name="spec" class="input-text">
                ';

                $list11 = $database->query("select * from specialties;");
                for ($y = 0; $y < $list11->num_rows; $y++) {
                    $row00 = $list11->fetch_assoc();
                    $sn = $row00["sname"];
                    $id00 = $row00["id"];
                    echo "<option value=".$id00.">$sn</option>";
                }

                echo '
                                    </select>
                                    
                                    <label for="password" class="form-label">New Password:</label>
                                    <input type="password" name="password" class="input-text" placeholder="Define a Password" required>
                                    
                                    <label for="cpassword" class="form-label">Confirm Password:</label>
                                    <input type="password" name="cpassword" class="input-text" placeholder="Confirm Password" required>
                                    
                                    <div style="display: flex; justify-content: center; gap: 20px; margin-top: 20px;">
                                        <input type="reset" value="Reset" class="btn btn-primary-soft">
                                        <input type="submit" value="Save Changes" class="btn btn-primary">
                                    </div>
                               </form>
                            </div>
                        </center>
                    </div>
                </div>
                ';
            } else {
                echo '
                <div id="popup1" class="overlay">
                    <div class="popup">
                        <center>
                            <h2>Success!</h2>
                            <a class="close" href="settings.php">&times;</a>
                            <div class="content" style="text-align: center;">
                                <i class="fas fa-check-circle" style="font-size: 60px; color: #4CAF50; margin-bottom: 20px;"></i>
                                <p style="font-size: 1.1rem;">Your account details have been updated successfully!</p>
                                <p>If you changed your email, please logout and login again with your new email.</p>
                            </div>
                            <div style="display: flex; justify-content: center; gap: 20px; margin-top: 20px;">
                                <a href="settings.php" class="btn btn-primary">OK</a>
                                <a href="../logout.php" class="btn btn-primary-soft">Logout Now</a>
                            </div>
                        </center>
                    </div>
                </div>
                ';
            }
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