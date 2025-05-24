<?php

session_start();
    // var_dump($_SESSION);exit;

    if(isset($_SESSION["user"])){
        if(($_SESSION["user"])=="" or $_SESSION['usertype']!='p'){
            header("location: ../login.php");
        }else{
            $useremail=$_SESSION["user"];
        }
    }else{
        header("location: ../login.php");
    }
    
    //import database
    include("../connection.php");



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
    <title>Settings</title>
    <style>
        
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

        .setting-tabs {
            background-color: white;
            border-radius: 0.5rem;
            box-shadow: var(--card-shadow);
            transition: all 0.3s;
        }

        .setting-tabs:hover {
            transform: translateY(-5px);
        }

        .dashboard-icons-setting {
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

        /* Button Styles */
        .btn-primary {
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 0.375rem;
            padding: 0.75rem 1.25rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s;
        }

        .btn-primary:hover {
            background: var(--primary-dark);
        }

        .btn-primary-soft {
            background: rgba(78, 115, 223, 0.1);
            color: var(--primary);
            border: 1px solid rgba(78, 115, 223, 0.2);
            border-radius: 0.375rem;
            padding: 0.75rem 1.25rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s;
        }

        .btn-primary-soft:hover {
            background: rgba(78, 115, 223, 0.2);
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
            padding: 0.75rem 1rem;
            border: 1px solid var(--border);
            border-radius: 0.5rem;
            font-size: 0.95rem;
            transition: all 0.3s;
            margin-bottom: 1rem;
        }

        .input-text:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
            outline: none;
        }

        .form-label {
            font-size: 0.9rem;
            font-weight: 500;
            color: var(--dark);
            margin-bottom: 0.5rem;
            display: block;
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
            animation: transitionIn-X  0.5s;
        }
        .sub-table {
            animation: transitionIn-Y-bottom 0.5s;
        }
        
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }
        
        .container-fluid {
            display: flex;
            min-height: 100vh;
        }
        
        /* For smaller screens */
        @media (max-width: 768px) {
            .popup {
                width: 90%;
                margin: 50px auto;
            }
            
            .menu {
                width: 100%;
                position: relative;
                height: auto;
            }
            
            .dash-body {
                margin-left: 0;
            }
            
            .container-fluid {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <?php

    $sqlmain= "select * from patient where pemail=?";
    $stmt = $database->prepare($sqlmain);
    $stmt->bind_param("s",$useremail);
    $stmt->execute();
    $result = $stmt->get_result();
    $userfetch=$result->fetch_assoc();
    $userid= $userfetch["pid"];
    $username=$userfetch["pname"];

    date_default_timezone_set('Australia/Sydney');
    $today = date('d-m-Y');
    ?>
    
    <div class="container-fluid">
        <!-- Sidebar / Menu -->
        <div class="menu">
            <div class="profile-container">
                <img src="../img/user.png" alt="Profile" width="70" style="border-radius:50%">
                <p class="profile-title"><?php echo substr($username,0,13)  ?></p>
                <p class="profile-subtitle"><?php echo substr($useremail,0,22)  ?></p>
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
                    <td class="menu-btn menu-active">
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
                    <p style="font-size: 23px; font-weight: 600;">Settings</p>
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

            <!-- Settings Options -->
            <div class="filter-container" style="display: flex; flex-wrap: wrap; gap: 20px; margin-top: 20px;">
                <!-- Account Settings -->
                <a href="?action=edit&id=<?php echo $userid ?>&error=0" class="non-style-link" style="flex: 1; min-width: 300px;">
                    <div class="setting-tabs" style="padding: 25px; height: 100%;">
                        <div style="display: flex; align-items: center; margin-bottom: 15px;">
                            <div style="width: 50px; height: 50px; background: linear-gradient(135deg, #4e73df 0%, #224abe 100%); border-radius: 10px; display: flex; align-items: center; justify-content: center; margin-right: 15px;">
                                <i class="fas fa-user-edit" style="color: white; font-size: 20px;"></i>
                            </div>
                            <h3 style="margin: 0; font-size: 1.2rem; font-weight: 600; color: var(--dark);">Account Settings</h3>
                        </div>
                        <p style="margin: 0; font-size: 0.9rem; color: var(--light-text);">
                            Edit your Account Details & Change Password
                        </p>
                    </div>
                </a>
                
                <!-- View Account Details -->
                <a href="?action=view&id=<?php echo $userid ?>" class="non-style-link" style="flex: 1; min-width: 300px;">
                    <div class="setting-tabs" style="padding: 25px; height: 100%;">
                        <div style="display: flex; align-items: center; margin-bottom: 15px;">
                            <div style="width: 50px; height: 50px; background: linear-gradient(135deg, #36b9cc 0%, #258391 100%); border-radius: 10px; display: flex; align-items: center; justify-content: center; margin-right: 15px;">
                                <i class="fas fa-id-card" style="color: white; font-size: 20px;"></i>
                            </div>
                            <h3 style="margin: 0; font-size: 1.2rem; font-weight: 600; color: var(--dark);">View Account Details</h3>
                        </div>
                        <p style="margin: 0; font-size: 0.9rem; color: var(--light-text);">
                            View Personal information About Your Account
                        </p>
                    </div>
                </a>
                
                <!-- Delete Account -->
                <a href="?action=drop&id=<?php echo $userid.'&name='.$username ?>" class="non-style-link" style="flex: 1; min-width: 300px;">
                    <div class="setting-tabs" style="padding: 25px; height: 100%;">
                        <div style="display: flex; align-items: center; margin-bottom: 15px;">
                            <div style="width: 50px; height: 50px; background: linear-gradient(135deg, #e74a3b 0%, #be2617 100%); border-radius: 10px; display: flex; align-items: center; justify-content: center; margin-right: 15px;">
                                <i class="fas fa-user-times" style="color: white; font-size: 20px;"></i>
                            </div>
                            <h3 style="margin: 0; font-size: 1.2rem; font-weight: 600; color: #e74a3b;">Delete Account</h3>
                        </div>
                        <p style="margin: 0; font-size: 0.9rem; color: var(--light-text);">
                            Will Permanently Remove your Account
                        </p>
                    </div>
                </a>
            </div>
        </div>
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
                        <a class="close" href="settings.php">&times;</a>
                        <div class="content" style="margin: 20px 0;">
                            You want to delete Your Account<br>('.substr($nameget,0,40).').
                        </div>
                        <div style="display: flex; justify-content: center; gap: 10px;">
                            <a href="delete-account.php?id='.$id.'" class="non-style-link">
                                <button class="btn-primary" style="background: var(--danger);">Yes</button>
                            </a>
                            <a href="settings.php" class="non-style-link">
                                <button class="btn-primary-soft">No</button>
                            </a>
                        </div>
                    </center>
                </div>
            </div>
            ';
        } elseif($action=='view'){
            $sqlmain= "select * from patient where pid=?";
            $stmt = $database->prepare($sqlmain);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $row=$result->fetch_assoc();
            $name=$row["pname"];
            $email=$row["pemail"];
            $address=$row["paddress"];
            $dob=$row["pdob"];
            $nic=$row['pnic'];
            $tele=$row['ptel'];
            
            echo '
            <div id="popup1" class="overlay">
                <div class="popup">
                    <a class="close" href="settings.php">&times;</a>
                    <div style="padding: 20px;">
                        <h2 style="margin-bottom: 20px; text-align: center; color: var(--primary);">Account Details</h2>
                        
                        <div style="margin-bottom: 15px;">
                            <label class="form-label">Name:</label>
                            <div style="padding: 10px; background: var(--bg-light); border-radius: 5px; font-size: 1rem;">
                                '.$name.'
                            </div>
                        </div>
                        
                        <div style="margin-bottom: 15px;">
                            <label class="form-label">Email:</label>
                            <div style="padding: 10px; background: var(--bg-light); border-radius: 5px; font-size: 1rem;">
                                '.$email.'
                            </div>
                        </div>
                        
                        <div style="margin-bottom: 15px;display:none;">
                            <label class="form-label">Telephone:</label>
                            <div style="padding: 10px; background: var(--bg-light); border-radius: 5px; font-size: 1rem;">
                                '.$tele.'
                            </div>
                        </div>
                        
                        <div style="margin-bottom: 15px;">
                            <label class="form-label">Address:</label>
                            <div style="padding: 10px; background: var(--bg-light); border-radius: 5px; font-size: 1rem;">
                                '.$address.'
                            </div>
                        </div>
                        
                        <div style="margin-bottom: 25px;">
                            <label class="form-label">Date of Birth:</label>
                            <div style="padding: 10px; background: var(--bg-light); border-radius: 5px; font-size: 1rem;">
                                '.$dob.'
                            </div>
                        </div>
                        
                        <div style="text-align: center;">
                            <a href="settings.php">
                                <button class="btn-primary">Close</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            ';
        } elseif($action=='edit'){
            $sqlmain= "select * from patient where pid=?";
            $stmt = $database->prepare($sqlmain);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $row=$result->fetch_assoc();
            $name=$row["pname"];
            $email=$row["pemail"];
            $address=$row["paddress"];
            $nic=$row['pnic'];
            $tele=$row['ptel'];

            $error_1=$_GET["error"];
            $errorlist= array(
                '1'=>'<label style="color:var(--danger);text-align:center;">Already have an account for this Email address.</label>',
                '2'=>'<label style="color:var(--danger);text-align:center;">Password Confirmation Error! Reconfirm Password</label>',
                '3'=>'<label style="color:var(--danger);text-align:center;"></label>',
                '4'=>"",
                '0'=>'',
            );

            if($error_1!='4'){
                echo '
                <div id="popup1" class="overlay">
                    <div class="popup">
                        <a class="close" href="settings.php">&times;</a>
                        <div style="padding: 20px;">
                            <h2 style="margin-bottom: 20px; text-align: center; color: var(--primary);">Edit Account Details</h2>
                            
                            <div style="margin-bottom: 15px; text-align: center;">
                                '.$errorlist[$error_1].'
                            </div>
                            
                            <form action="edit-user.php" method="POST">
                                <input type="hidden" value="'.$id.'" name="id00">
                                <input type="hidden" name="oldemail" value="'.$email.'" >
                                
                                <div style="margin-bottom: 15px;">
                                    <label class="form-label">Email:</label>
                                    <input type="email" name="email" class="input-text" value="'.$email.'" required>
                                </div>
                                
                                <div style="margin-bottom: 15px;">
                                    <label class="form-label">Name:</label>
                                    <input type="text" name="name" class="input-text" value="'.$name.'" required>
                                </div>
                                
                                
                                <div style="margin-bottom: 15px; display:none;">
                                    <label class="form-label">Telephone:</label>
                                    <input type="tel" name="Tele" class="input-text" value="'.$tele.'" required>
                                </div>
                                
                                <div style="margin-bottom: 15px;">
                                    <label class="form-label">Address:</label>
                                    <input type="text" name="address" class="input-text" value="'.$address.'" required>
                                </div>
                                
                                <div style="margin-bottom: 15px;">
                                    <label class="form-label">Password:</label>
                                    <input type="password" name="password" class="input-text" placeholder="Enter New Password" required>
                                </div>
                                
                                <div style="margin-bottom: 25px;">
                                    <label class="form-label">Confirm Password:</label>
                                    <input type="password" name="cpassword" class="input-text" placeholder="Confirm New Password" required>
                                </div>
                                
                                <div style="display: flex; justify-content: center; gap: 10px;">
                                    <input type="reset" value="Reset" class="btn-primary-soft">
                                    <input type="submit" value="Save" class="btn-primary">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                ';
            } else {
                echo '
                <div id="popup1" class="overlay">
                    <div class="popup">
                        <center>
                            <h2 style="color: var(--secondary);">Edit Successful!</h2>
                            <a class="close" href="settings.php">&times;</a>
                            <div class="content" style="margin: 20px 0;">
                                If you changed your email, please logout and login again with your new email
                            </div>
                            <div style="display: flex; justify-content: center; gap: 10px;">
                                <a href="settings.php" class="non-style-link">
                                    <button class="btn-primary">OK</button>
                                </a>
                                <a href="../logout.php" class="non-style-link">
                                    <button class="btn-primary-soft">Log out</button>
                                </a>
                            </div>
                        </center>
                    </div>
                </div>
                ';
            }
        }
    }
    ?>
    
    <!-- JavaScript to enhance modal functionality -->
    <script>
        // Make sure popups work correctly with proper z-index
        document.addEventListener('DOMContentLoaded', function() {
            // If there's an overlay visible, ensure it has proper z-index
            const overlay = document.querySelector('.overlay');
            if (overlay) {
                document.body.style.overflow = 'hidden'; // Prevent background scrolling
                
                // Add event listener to close buttons
                const closeButtons = document.querySelectorAll('.close');
                closeButtons.forEach(button => {
                    button.addEventListener('click', function(e) {
                        e.preventDefault();
                        window.location.href = this.getAttribute('href');
                    });
                });
            }
        });
    </script>
</body>
</html>