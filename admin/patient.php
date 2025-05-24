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
    <title>Patients</title>
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

        .btn-primary-soft {
            background: rgba(255, 87, 34, 0.1);
            color: #ff5722;
            padding: 8px 15px;
        }

        .btn-primary-soft:hover {
            background: rgba(255, 87, 34, 0.2);
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

        /* Filter styles */
        .filter-form {
            display: flex;
            gap: 1rem;
            align-items: center;
            flex-wrap: wrap;
        }

        .filter-select {
            padding: 0.8rem 1rem;
            border: 1px solid #e0e0e0;
            border-radius: 50px;
            font-size: 1rem;
            transition: all 0.3s ease;
            min-width: 150px;
        }

        .filter-select:focus {
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
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
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
            .header-search {
                width: 100%;
            }
            .filter-form {
                flex-direction: column;
                align-items: stretch;
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
                <td class="menu-btn">
                    <a href="appointment.php" class="non-style-link-menu">
                        <div>
                            <p class="menu-text">Appointment</p>
                        </div>
                    </a>
                </td>
            </tr>
            <tr class="menu-row">
                <td class="menu-btn menu-active">
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
                    <form action="patient.php" method="post" class="header-search">
                        <input type="search" name="search12" class="header-searchbar" placeholder="Search Patient name or Email" list="patient">
                        <?php
                        echo '<datalist id="patient">';
                        $list11 = $database->query("SELECT pname, pemail FROM patient");
                        while ($row00 = $list11->fetch_assoc()) {
                            echo "<option value='{$row00['pname']}'></option>";
                            echo "<option value='{$row00['pemail']}'></option>";
                        }
                        echo '</datalist>';
                        ?>
                        <input type="submit" name="search" value="Search" class="btn btn-primary">
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

            <?php
            $selecttype = "My";
            $current = "All patients";

            if ($_POST) {
                if (isset($_POST["search"])) {
                    $keyword = $_POST["search12"];
                    $sqlmain = "select * from patient where pemail='$keyword' or pname='$keyword' or pname like '$keyword%' or pname like '%$keyword' or pname like '%$keyword%' ";
                    $selecttype = "Search Results";
                }

                if (isset($_POST["filter"])) {
                    if ($_POST["showonly"] == 'all') {
                        $sqlmain = "select * from patient";
                        $selecttype = "All";
                        $current = "All patients";
                    } else {
                        $sqlmain = "select * from appointment inner join patient on patient.pid=appointment.pid inner join schedule on schedule.scheduleid=appointment.scheduleid where schedule.docid=$userid;";
                        $selecttype = "My";
                        $current = "My patients Only";
                    }
                }
            } else {
                $sqlmain = "select * from patient";
                $selecttype = "All";
            }

            
            $result = $database->query($sqlmain);
            $patient_count = $result->num_rows;
            ?>

            <tr>
                <td colspan="2">
                    <p class="heading-main">Patient Management</p>
                </td>
            </tr>

            <tr>
                <td colspan="2">
                    <p class="heading-sub"><?php echo $selecttype . " Patients (" . $patient_count . ")"; ?></p>
                </td>
            </tr>

            <tr>
                <td colspan="2">
                    <div class="scroll">
                        <table class="sub-table">
                            <thead>
                                <tr>
                                    <th>Patient Name</th>
                                    <th>NIC</th>
                                    <th>Telephone</th>
                                    <th>Email</th>
                                    <th>Date of Birth</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $result = $database->query($sqlmain);

                                    if($result->num_rows==0){
                                        echo '<tr>
                                            <td colspan="6" style="text-align:center;padding:20px;">
                                                <img src="../img/notfound.svg" width="25%" style="margin:20px 0;">
                                                <p style="color:#666;margin:10px 0;">We couldn\'t find anything related to your keywords!</p>
                                                <a href="patient.php" class="non-style-link">
                                                    <button class="btn btn-primary" style="width:200px;">Show All Patients</button>
                                                </a>
                                            </td>
                                        </tr>';
                                    } else {
                                        for ($x=0; $x<$result->num_rows; $x++){
                                            $row=$result->fetch_assoc();
                                            $pid=$row["pid"];
                                            $name=$row["pname"];
                                            $email=$row["pemail"];
                                            $nic=$row["pnic"];
                                            $dob=$row["pdob"];
                                            $tel=$row["ptel"];
                                            
                                            echo '<tr>
                                                <td>'.substr($name,0,30).'</td>
                                                <td>'.substr($nic,0,12).'</td>
                                                <td>'.substr($tel,0,10).'</td>
                                                <td>'.substr($email,0,25).'</td>
                                                <td>'.substr($dob,0,10).'</td>
                                                <td>
                                                    <div style="display:flex;gap:10px;">
                                                        <a href="?action=view&id='.$pid.'" class="non-style-link">
                                                            <button class="btn-primary-soft btn">
                                                                <i class="fas fa-eye"></i> View
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
        
        if($action == 'view'){
            $sqlmain = "select * from patient where pid='$id'";
            $result = $database->query($sqlmain);
            $row = $result->fetch_assoc();
            $name = $row["pname"];
            $email = $row["pemail"];
            $nic = $row["pnic"];
            $dob = $row["pdob"];
            $tele = $row["ptel"];
            $address = $row["paddress"];

            echo '
            <div id="popup1" class="overlay">
                <div class="popup">
                    <center>
                        <h2>Patient Details</h2>
                        <a class="close" href="patient.php">&times;</a>
                        <div style="display: flex;justify-content: center;">
                            <table width="80%" class="sub-table" border="0">
                                <tr>
                                    <td>
                                        <p style="padding: 0;margin: 0;text-align: left;font-size: 25px;font-weight: 500;color:#ff5722;">View Details</p><br>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="label-td" colspan="2">
                                        <label for="name" class="form-label">Patient ID: </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="label-td" colspan="2">
                                        P-'.$id.'<br><br>
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
                                        <label for="address" class="form-label">Address: </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="label-td" colspan="2">
                                        '.$address.'<br><br>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="label-td" colspan="2">
                                        <label for="dob" class="form-label">Date of Birth: </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="label-td" colspan="2">
                                        '.$dob.'<br><br>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <a href="patient.php"><button class="btn btn-primary" style="width:100%;">OK</button></a>
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
</body>
</html>