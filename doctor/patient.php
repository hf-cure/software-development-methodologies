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
    <title>My Patients</title>
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

        .patient-header {
            background: linear-gradient(135deg, #ff9800, #ff5722);
            color: #fff;
            padding: 30px;
            border-radius: 15px;
            margin-bottom: 30px;
            box-shadow: 0 10px 20px rgba(255, 87, 34, 0.2);
            animation: fadeIn 0.6s ease-in-out;
        }

        .patient-header h3 {
            font-size: 1.5rem;
            margin-bottom: 10px;
            font-weight: 400;
        }

        .patient-header h1 {
            font-size: 2.5rem;
            margin-bottom: 20px;
        }

        .patient-header p {
            font-size: 1.1rem;
            margin-bottom: 20px;
            opacity: 0.9;
        }

        .filter-container {
            width: 100%;
            margin-bottom: 30px;
            animation: slideInFromBottom 0.6s ease-in-out;
            background: #fff;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
        }

        /* Input Styles */
        .input-text {
            padding: 12px 15px;
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            font-size: 1rem;
            transition: all 0.3s ease;
            width: 100%;
        }

        .input-text:focus {
            border-color: #ff5722;
            box-shadow: 0 0 0 3px rgba(255, 87, 34, 0.1);
            outline: none;
        }

        /* Table Styles */
        .scroll {
            overflow-y: auto;
            scrollbar-width: thin;
            scrollbar-color: #ff5722 #f1f1f1;
            max-height: 500px;
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
            padding: 20px;
            background: #fff;
            border-radius: 15px;
            width: 50%;
            position: relative;
            transition: all 0.5s ease-in-out;
            animation: slideInFromTop 0.5s ease-out;
        }

        .popup h2 {
            margin-top: 0;
            color: #333;
            font-size: 1.5rem;
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
            max-height: 30%;
            overflow: auto;
            padding: 20px 0;
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
        }

        /* Header Search Bar */
        .header-search {
            display: flex;
            align-items: center;
        }

        .header-searchbar {
            padding: 12px 15px;
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            font-size: 1rem;
            transition: all 0.3s ease;
            width: 300px;
            max-width: 100%;
            margin-right: 10px;
        }

        .header-searchbar:focus {
            border-color: #ff5722;
            box-shadow: 0 0 0 3px rgba(255, 87, 34, 0.1);
            outline: none;
        }

        /* Select Box Styles */
        .box {
            padding: 12px 15px;
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .box:focus {
            border-color: #ff5722;
            box-shadow: 0 0 0 3px rgba(255, 87, 34, 0.1);
            outline: none;
        }
    </style>
</head>

<body>
    <?php
    // Session handling and database connection
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

    // Import database
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
                    <td class="menu-btn menu-active">
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

        <?php
        $selecttype = "My";
        $current = "My patients Only";

        if ($_POST) {
            if (isset($_POST["search"])) {
                $keyword = $_POST["search12"];
                $sqlmain = "select * from patient where pemail='$keyword' or pname='$keyword' or pname like '$keyword%' or pname like '%$keyword' or pname like '%$keyword%' ";
                $selecttype = "my";
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
            $sqlmain = "SELECT DISTINCT patient.*
FROM 
    appointment
INNER JOIN patient ON appointment.pid = patient.pid
INNER JOIN schedule ON appointment.scheduleid = schedule.scheduleid
WHERE 
    schedule.docid = $userid;";
            $selecttype = "My";
        }

        
        $result = $database->query($sqlmain);
        $patient_count = $result->num_rows;

        // Get today's date
        date_default_timezone_set('Australia/Sydney');
        $today = date('d-m-Y');
        ?>

        <div class="dash-body">
            <div class="nav-bar">
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <p style="font-size: 23px; font-weight: 600; margin: 0;">Patient Manager</p>
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

            <div class="patient-header">
                <h3>My Patients</h3>
                <h1>Patient Information Management</h1>
                <p>View and manage all your patient information in one place.<br>You can view detailed information about each patient from your appointments.</p>
            </div>

            <div style="margin-top: 30px;">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                    <p style="font-size: 20px; font-weight: 600; margin: 0;">
                        <?php echo $selecttype . " Patients (" . $patient_count . ")"; ?>
                    </p>
                    <a href="patient.php" class="btn btn-primary-soft" style="padding: 10px 15px;">
                        <i class="fas fa-sync" style="margin-right: 5px;"></i> Refresh
                    </a>
                </div>

                <div class="filter-container">
                    <form action="" method="post">
                        <table width="100%" border="0">
                            <tr>
                                <td width="25%">
                                    <p style="font-weight: 500;">Search Patient:</p>
                                </td>
                                <td width="40%">
                                    <input type="search" name="search12" class="input-text" placeholder="Search by name or email" list="patient">
                                    <?php
                                    echo '<datalist id="patient">';
                                    $list11 = $database->query($sqlmain);
                                    for ($y = 0; $y < $list11->num_rows; $y++) {
                                        $row00 = $list11->fetch_assoc();
                                        $d = $row00["pname"];
                                        $c = $row00["pemail"];
                                        echo "<option value='$d'><br/>";
                                        echo "<option value='$c'><br/>";
                                    };
                                    echo '</datalist>';
                                    ?>
                                </td>
                                <td width="15%">
                                    <input type="submit" value="Search" name="search" class="btn btn-primary" style="width: 100%;">
                                </td>
                                <td width="20%" style="padding-left: 20px;">
                                    <div style="display: flex; align-items: center;">
                                        <label for="showonly" style="margin-right: 10px;">Show:</label>
                                        <select name="showonly" id="showonly" class="box" style="width: 150px;">
                                            <option value="" disabled selected hidden><?php echo $current; ?></option>
                                            <option value="my">My Patients Only</option>
                                            <!-- <option value="all">All Patients</option> -->
                                        </select>
                                    </div>
                                </td>
                                <td width="15%" style="text-align: right;">
                                    <input type="submit" name="filter" value="Filter" class="btn btn-primary-soft">
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>

                <div class="scroll" style="margin-top: 20px; background-color: white; padding: 20px; border-radius: 15px; box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);">
                    <table width="100%" class="sub-table" border="0">
                        <thead>
                            <tr>
                                <th class="table-headin">Patient Name</th>
                                <th class="table-headin">NIC</th>
                                <th class="table-headin">Telephone</th>
                                <th class="table-headin">Email</th>
                                <th class="table-headin">Date of Birth</th>
                                <th class="table-headin">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $result = $database->query($sqlmain);

                            if ($result->num_rows == 0) {
                                echo '<tr>
                                    <td colspan="6">
                                        <center>
                                            <img src="../img/notfound.svg" width="25%" style="margin-top: 30px; margin-bottom: 20px;">
                                            <p style="font-size: 18px; font-weight: 500; color: #555;">No patients found matching your criteria</p>
                                            <a href="patient.php" class="btn btn-primary-soft" style="margin-top: 10px; margin-bottom: 30px;">Show All Patients</a>
                                        </center>
                                    </td>
                                </tr>';
                            } else {
                                for ($x = 0; $x < $result->num_rows; $x++) {
                                    $row = $result->fetch_assoc();
                                    $pid = $row["pid"];
                                    $name = $row["pname"];
                                    $email = $row["pemail"];
                                    $nic = $row["pnic"];
                                    $dob = $row["pdob"];
                                    $tel = $row["ptel"];

                                    echo '<tr>
                                        <td style="font-weight: 600;">' . substr($name, 0, 35) . '</td>
                                        <td>' . substr($nic, 0, 12) . '</td>
                                        <td>' . substr($tel, 0, 10) . '</td>
                                        <td>' . substr($email, 0, 20) . '</td>
                                        <td>' . substr($dob, 0, 10) . '</td>
                                        <td>
                                            <a href="?action=view&id=' . $pid . '" class="btn btn-primary-soft" style="padding: 9px 15px; border-radius: 10px;">
                                                <i class="fas fa-eye" style="margin-right: 5px;"></i> View
                                            </a>
                                        </td>
                                    </tr>';
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <?php
    if (isset($_GET["action"]) && isset($_GET["id"])) {
        $id = $_GET["id"];
        $action = $_GET["action"];

        if ($action == 'view') {
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
                        <div class="content">
                            <div style="display: flex; justify-content: center;">
                                <table width="80%" style="border: none; padding: 20px;">
                                    <tr>
                                        <td style="width: 50%; padding: 10px; text-align: right; font-weight: 500; color: #555;">Patient ID:</td>
                                        <td style="width: 50%; padding: 10px; text-align: left; color: #333;">P-' . $id . '</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 50%; padding: 10px; text-align: right; font-weight: 500; color: #555;">Full Name:</td>
                                        <td style="width: 50%; padding: 10px; text-align: left; color: #333;">' . $name . '</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 50%; padding: 10px; text-align: right; font-weight: 500; color: #555;">Email:</td>
                                        <td style="width: 50%; padding: 10px; text-align: left; color: #333;">' . $email . '</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 50%; padding: 10px; text-align: right; font-weight: 500; color: #555;">NIC Number:</td>
                                        <td style="width: 50%; padding: 10px; text-align: left; color: #333;">' . $nic . '</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 50%; padding: 10px; text-align: right; font-weight: 500; color: #555;">Telephone:</td>
                                        <td style="width: 50%; padding: 10px; text-align: left; color: #333;">' . $tele . '</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 50%; padding: 10px; text-align: right; font-weight: 500; color: #555;">Address:</td>
                                        <td style="width: 50%; padding: 10px; text-align: left; color: #333;">' . $address . '</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 50%; padding: 10px; text-align: right; font-weight: 500; color: #555;">Date of Birth:</td>
                                        <td style="width: 50%; padding: 10px; text-align: left; color: #333;">' . $dob . '</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div style="margin-top: 20px;">
                            <a href="patient.php" class="btn btn-primary">Close</a>
                        </div>
                    </center>
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