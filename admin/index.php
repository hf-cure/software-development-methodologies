<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Admin Dashboard</title>
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

        /* Dashboard Stats */
        .stats-container {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .dashboard-items {
            background: #fff;
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .dashboard-items:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(255, 87, 34, 0.15);
        }

        .h1-dashboard {
            font-size: 2rem;
            color: #ff5722;
            margin-bottom: 5px;
        }

        .h3-dashboard {
            font-size: 0.9rem;
            color: #666;
        }

        /* Tables */
        .dashbord-tables {
            display: flex;
            gap: 2rem;
            margin-top: 2rem;
        }

        .table-container {
            flex: 1;
            min-width: 0; /* Prevent overflow */
        }

        .scroll {
            max-height: 300px;
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

        /* Animations */
        @keyframes transitionIn-X {
            0% { transform: translateX(-100%); opacity: 0; }
            100% { transform: translateX(0); opacity: 1; }
        }

        @keyframes fadeIn {
            0% { opacity: 0; }
            100% { opacity: 1; }
        }

        /* Responsive */
        @media (max-width: 1200px) {
            .stats-container {
                grid-template-columns: repeat(2, 1fr);
            }
            .dashbord-tables {
                flex-direction: column;
            }
        }

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
            .stats-container {
                grid-template-columns: 1fr;
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
    
    $patientrow = $database->query("SELECT * FROM patient");
    $doctorrow = $database->query("SELECT * FROM doctor");
    $appointmentrow = $database->query("SELECT * FROM appointment WHERE appodate >= '$today'");
    $schedulerow = $database->query("SELECT * FROM schedule WHERE scheduledate = '$today'");
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
                <td class="menu-btn menu-active">
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
                    <div class="stats-container">
                        <div class="dashboard-items">
                            <div>
                                <div class="h1-dashboard"><?php echo $doctorrow->num_rows ?></div>
                                <div class="h3-dashboard">Doctors</div>
                            </div>
                            <i class="fas fa-user-md" style="font-size: 2rem; color: #ff5722;"></i>
                        </div>
                        <div class="dashboard-items">
                            <div>
                                <div class="h1-dashboard"><?php echo $patientrow->num_rows ?></div>
                                <div class="h3-dashboard">Patients</div>
                            </div>
                            <i class="fas fa-procedures" style="font-size: 2rem; color: #ff5722;"></i>
                        </div>
                        <div class="dashboard-items">
                            <div>
                                <div class="h1-dashboard"><?php echo $appointmentrow->num_rows ?></div>
                                <div class="h3-dashboard">New Bookings</div>
                            </div>
                            <i class="fas fa-calendar-check" style="font-size: 2rem; color: #ff5722;"></i>
                        </div>
                        <div class="dashboard-items">
                            <div>
                                <div class="h1-dashboard"><?php echo $schedulerow->num_rows ?></div>
                                <div class="h3-dashboard">Today's Sessions</div>
                            </div>
                            <i class="fas fa-clock" style="font-size: 2rem; color: #ff5722;"></i>
                        </div>
                    </div>
                </td>
            </tr>

            <tr>
                <td colspan="2">
                    <div class="dashbord-tables">
                        <div class="table-container">
                            <p style="padding:10px; font-size:1.3rem; font-weight:600; color:#ff5722;">
                                Upcoming Appointments (Next 7 Days)
                            </p>
                            <div class="scroll">
                                <table class="sub-table">
                                    <thead>
                                        <tr>
                                            <th>Appointment #</th>
                                            <th>Patient Name</th>
                                            <th>Doctor</th>
                                            <th>Session</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $nextweek = date("Y-m-d", strtotime("+1 week"));
                                        $sqlmain = "SELECT appointment.appoid, schedule.title, doctor.docname, patient.pname, appointment.apponum 
                                                    FROM schedule 
                                                    INNER JOIN appointment ON schedule.scheduleid=appointment.scheduleid 
                                                    INNER JOIN patient ON patient.pid=appointment.pid 
                                                    INNER JOIN doctor ON schedule.docid=doctor.docid  
                                                    WHERE schedule.scheduledate BETWEEN '$today' AND '$nextweek' 
                                                    ORDER BY schedule.scheduledate DESC";
                                        $result = $database->query($sqlmain);

                                        if ($result->num_rows == 0) {
                                            echo '<tr><td colspan="4" style="text-align:center;padding:20px;">
                                                <img src="../img/notfound.svg" width="25%" style="margin:20px 0;">
                                                <p style="color:#666;margin:10px 0;">No upcoming appointments found</p>
                                                </td></tr>';
                                        } else {
                                            while($row = $result->fetch_assoc()) {
                                                echo '<tr>
                                                    <td style="color:#ff5722;font-weight:600;">'.$row["apponum"].'</td>
                                                    <td>'.substr($row["pname"],0,25).'</td>
                                                    <td>'.substr($row["docname"],0,25).'</td>
                                                    <td>'.substr($row["title"],0,15).'</td>
                                                </tr>';
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <center style="margin-top:20px;">
                                <a href="appointment.php" class="non-style-link">
                                    <button class="btn btn-primary" style="width:90%;">Show All Appointments</button>
                                </a>
                            </center>
                        </div>

                        <div class="table-container">
                            <p style="padding:10px; font-size:1.3rem; font-weight:600; color:#ff5722;">
                                Upcoming Sessions (Next 7 Days)
                            </p>
                            <div class="scroll">
                                <table class="sub-table">
                                    <thead>
                                        <tr>
                                            <th>Session Title</th>
                                            <th>Doctor</th>
                                            <th>Date & Time</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sqlmain = "SELECT schedule.title, doctor.docname, schedule.scheduledate, schedule.scheduletime 
                                                  FROM schedule 
                                                  INNER JOIN doctor ON schedule.docid=doctor.docid  
                                                  WHERE schedule.scheduledate BETWEEN '$today' AND '$nextweek' 
                                                  ORDER BY schedule.scheduledate DESC";
                                        $result = $database->query($sqlmain);

                                        if ($result->num_rows == 0) {
                                            echo '<tr><td colspan="3" style="text-align:center;padding:20px;">
                                                <img src="../img/notfound.svg" width="25%" style="margin:20px 0;">
                                                <p style="color:#666;margin:10px 0;">No upcoming sessions found</p>
                                                </td></tr>';
                                        } else {
                                            while($row = $result->fetch_assoc()) {
                                                echo '<tr>
                                                    <td>'.substr($row["title"],0,30).'</td>
                                                    <td>'.substr($row["docname"],0,20).'</td>
                                                    <td>'.$row["scheduledate"].' @ '.substr($row["scheduletime"],0,5).'</td>
                                                </tr>';
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <center style="margin-top:20px;">
                                <a href="schedule.php" class="non-style-link">
                                    <button class="btn btn-primary" style="width:90%;">Show All Sessions</button>
                                </a>
                            </center>
                        </div>
                    </div>
                </td>
            </tr>
        </table>
    </div>
</body>
</html>