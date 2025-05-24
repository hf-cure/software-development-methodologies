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

    
    date_default_timezone_set('Australia/Sydney');
    $today = date('d-m-Y');
    
    // Doctor search functionality
    $searchterm = "";
    $search_visibility = "hidden";
    
    if($_POST){
        if(isset($_POST["search"])){
            $searchterm = $_POST["search"];
            $search_visibility = "visible";
        }
    }
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
    <link rel="stylesheet" href="../css/doctors.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <title>Doctors - Medical Center</title>
</head>
<body>
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
                    <td class="menu-btn">
                        <a href="index.php" class="non-style-link-menu">
                            <i class="fas fa-home menu-icon"></i>
                            <p class="menu-text">Dashboard</p>
                        </a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-active">
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
                    <p style="font-size: 23px; font-weight: 600;">All Doctors</p>
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
                            <input type="search" name="search" class="search-input" placeholder="Search doctor by name or specialization" <?php if($searchterm!=''){ echo "value='$searchterm'"; } ?>>
                            <button type="submit" class="search-btn">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Doctors List Section -->
            <div class="doctors-section card">
                <div class="section-header">
                    <div style="display: flex; align-items: center;">
                        <div class="section-header-icon">
                            <i class="fas fa-user-md"></i>
                        </div>
                        <span style="margin-left: 10px;">Available Doctors</span>
                    </div>
                    <div>
                        <?php 
                            $sqlGetDoctors = "SELECT * FROM doctor";
                            if($searchterm != ''){
                                $sqlGetDoctors = "SELECT * FROM doctor WHERE docname LIKE '%$searchterm%' OR specialties LIKE '%$searchterm%'";
                            }
                            $result = $database->query($sqlGetDoctors);
                            $count = $result->num_rows;
                            echo "<p style='font-size: 0.9rem; color: var(--light-text);'>$count doctor(s) found</p>";
                        ?>
                    </div>
                </div>
                
                <div class="doctors-list">
                    <?php
                    if($result->num_rows == 0) {
                        echo '<div class="empty-state">
                                <img src="../img/notfound.svg" alt="No doctor(s) found" width="100px">
                                <p>No doctor(s) found matching your search criteria!</p>
                              </div>';
                    } else {
                        echo '<div class="doctors-grid">';
                        
                        for ($x=0; $x<$result->num_rows; $x++) {
                            $row = $result->fetch_assoc();
                            $docid = $row["docid"];
                            $docname = $row["docname"];
                            $docemail = $row["docemail"];
                            $doctel = $row["doctel"];
                            $specialties = $row["specialties"];
                            
                            echo '<div class="doctor-card">
                                    <div class="doctor-avatar">
                                        <div class="avatar-placeholder">
                                            <i class="fas fa-user-md"></i>
                                        </div>
                                    </div>
                                    <div class="doctor-details">
                                        <h3 class="doctor-name">Dr. '.$docname.'</h3>
                                        <p class="doctor-specialty">'.$specialties.'</p>
                                        <div class="doctor-contact">
                                            <div class="contact-item">
                                                <i class="fas fa-envelope"></i>
                                                <span>'.$docemail.'</span>
                                            </div>
                                            <div class="contact-item">
                                                <i class="fas fa-phone"></i>
                                                <span>'.$doctel.'</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="doctor-actions">
                                        <a href="schedule.php?action=view&docid='.$docid.'" class="btn-view-sessions">
                                            <i class="fas fa-calendar-alt"></i> View Sessions
                                        </a>
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
</body>
</html>