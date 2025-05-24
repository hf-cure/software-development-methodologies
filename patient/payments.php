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

    
    include("../connection.php");

    $useremail="patient@docappoint.com";

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

    $sqlmain= "select payments.*, appointment.appodate, schedule.title, doctor.docname 
               from payments 
               left join appointment on payments.appointment_id = appointment.appoid 
               left join schedule on appointment.scheduleid = schedule.scheduleid 
               left join doctor on schedule.docid = doctor.docid 
               where payments.status = 'paid'
               order by payments.created_at desc";
    
    $insertkey="";
    $searchtype="All Paid";
        
    if($_POST){
        if(!empty($_POST["search"])){
            $keyword=$_POST["search"];
            $sqlmain= "select payments.*, appointment.appodate, schedule.title, doctor.docname 
                       from payments 
                       left join appointment on payments.appointment_id = appointment.appoid 
                       left join schedule on appointment.scheduleid = schedule.scheduleid 
                       left join doctor on schedule.docid = doctor.docid 
                       where payments.status = 'paid' 
                       and (payments.stripe_charge_id like '%$keyword%' or doctor.docname like '%$keyword%' or schedule.title like '%$keyword%') 
                       order by payments.created_at desc";
            $insertkey=$keyword;
            $searchtype="Search Result : ";
        }
    }

    $result= $database->query($sqlmain);
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
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <title>Payment Invoices</title>
    <style>
         body {
            margin: 0;
            padding: 0;
        }
        
        .container-fluid {
            padding: 0;
            margin: 0;
        }
        .payments-table {
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        
        .payments-table table {
            width: 100%;
            border-collapse: collapse;
            margin: 0;
        }
        
        .payments-table th {
            background: var(--primary);
            color: white;
            padding: 15px 12px;
            text-align: left;
            font-weight: 600;
            font-size: 0.9rem;
        }
        
        .payments-table td {
            padding: 15px 12px;
            border-bottom: 1px solid #f0f0f0;
            vertical-align: middle;
        }
        
        .payments-table tr:hover {
            background-color: #f8f9fa;
            transition: background-color 0.2s ease;
        }
        
        .payments-table tr:last-child td {
            border-bottom: none;
        }
        
        .status-badge {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            background-color: #d4edda;
            color: #155724;
            display: inline-block;
        }
        
        .payment-amount {
            font-weight: 700;
            color: var(--primary);
            font-size: 1.1rem;
        }

        .menu-btn {
            height: 50px;
        }
        
        .menu-text {
            white-space: nowrap;
        }
        
        .charge-id {
            font-family: monospace;
            font-size: 0.85rem;
            background: #f8f9fa;
            padding: 4px 8px;
            border-radius: 4px;
            color: #6c757d;
        }
        
        .invoice-number {
            font-weight: 600;
            color: var(--dark);
        }
        
        .doctor-info {
            color: #666;
            font-size: 0.9rem;
        }
        
        .session-title {
            font-weight: 500;
            margin-bottom: 2px;
        }
        
        .date-time {
            color: #666;
            font-size: 0.9rem;
        }
        
        @media (max-width: 768px) {
            .payments-table {
                overflow-x: auto;
            }
            
            .payments-table table {
                min-width: 700px;
            }
            
            .payments-table th,
            .payments-table td {
                padding: 10px 8px;
                font-size: 0.85rem;
            }
        }
    </style>
</head>
<body>
<div class="container-fluid">
        <!-- Sidebar / Menu -->
        <div class="menu">
            <div class="profile-container">
                <img src="../img/user.png" alt="Profile" width="70" style="border-radius:50%">
                <p class="profile-title"><?php echo substr($username,0,13); ?></p>
                <p class="profile-subtitle"><?php echo substr($useremail,0,22); ?></p>
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
                    <td class="menu-btn menu-active">
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
                    <p style="font-size: 23px; font-weight: 600;">Payment Invoices</p>
                </div>
                <div style="display: flex; align-items: center;">
                    <div style="margin-right: 15px;">
                        <p style="font-size: 0.8rem; color: var(--light-text); margin: 0;">Today's Date</p>
                        <p style="font-size: 1rem; font-weight: 500; margin: 0;"><?php echo $today; ?></p>
                    </div>
                    <div style="width: 40px; height: 40px; background: var(--primary); border-radius: 50%; display: flex; justify-content: center; align-items: center; color: white;">
                        <i class="fas fa-credit-card"></i>
                    </div>
                </div>
            </div>

            <!-- Search Section -->
            <div class="search-section card" style="display: none;">
                <div class="card-body">
                    <form action="" method="post" class="search-form">
                        <div class="search-input-container">
                            <input type="search" name="search" class="search-input" 
                                   placeholder="Search by charge ID, doctor name, or session title" 
                                   list="payments" value="<?php echo $insertkey ?>">
                            
                            <?php
                                echo '<datalist id="payments">';
                                $list11 = $database->query("select DISTINCT stripe_charge_id from payments where status='paid';");
                                $list12 = $database->query("select DISTINCT doctor.docname from payments 
                                                           left join appointment on payments.appointment_id = appointment.appoid 
                                                           left join schedule on appointment.scheduleid = schedule.scheduleid 
                                                           left join doctor on schedule.docid = doctor.docid 
                                                           where payments.status='paid' and doctor.docname is not null;");
                             

                                for ($y=0;$y<$list12->num_rows;$y++){
                                    $row00=$list12->fetch_assoc();
                                    $d=$row00["docname"];
                                    echo "<option value='$d'><br/>";
                                };
                                echo '</datalist>';
                            ?>
                            
                            <button type="submit" class="search-btn">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Payments Table Section -->
            <div class="doctors-section card">
                <div class="section-header">
                    <div style="display: flex; align-items: center;">
                        <div class="section-header-icon">
                            <i class="fas fa-credit-card"></i>
                        </div>
                        <span style="margin-left: 10px;"><?php echo $searchtype; ?> Payment Invoices</span>
                    </div>
                    <div>
                        <?php 
                            echo "<p style='font-size: 0.9rem; color: var(--light-text);'>" . $result->num_rows . " paid invoice(s) found";
                            if(!empty($insertkey)){ 
                                echo " for \"" . $insertkey . "\""; 
                            }
                            echo "</p>";
                        ?>
                    </div>
                </div>
                
                <div class="doctors-list">
                    <?php
                    if($result->num_rows==0){
                        echo '<div class="empty-state">
                                <img src="../img/notfound.svg" alt="No payments found" width="100px">
                                <p>No paid invoices found matching your search criteria!</p>
                                <a href="payments.php" class="btn-primary" style="display: inline-block; margin-top: 15px;">Show All Paid Invoices</a>
                              </div>';
                    } else {
                        echo '<div class="payments-table">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Invoice #</th>
                                            <th>Amount</th>
                                            <th>Session Details</th>
                                            <th>Doctor</th>
                                            <th>Payment Date</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>';
                        
                        while($row = $result->fetch_assoc()) {
                            $payment_id = $row["id"];
                            $amount = $row["amount"];
                            $appointment_id = $row["appointment_id"];
                            $status = $row["status"];
                            $created_at = $row["created_at"];
                            $appodate = $row["appodate"];
                            // $appotime = $row["appotime"];
                            $title = $row["title"];
                            $docname = $row["docname"];
                            
                            // Format amount (assuming it's in cents)
                            $formatted_amount = number_format($amount / 100, 2);
                            
                            // Format date and time
                            $formatted_date = date('d M Y', strtotime($created_at));
                            $formatted_time = date('H:i', strtotime($created_at));
                            
                            echo '<tr>
                                    <td><span class="invoice-number">#'.$payment_id.'</span></td>
                                    <td><span class="payment-amount">A$'.$formatted_amount.'</span></td>
                                    <td>';
                            
                            if($title) {
                                echo '<div class="session-title">'.substr($title, 0, 30).'</div>';
                                if($appodate) {
                                    echo '<div class="date-time">'.date('d M Y', strtotime($appodate)) . '</div>';
                                }
                            } else {
                                echo '<div class="doctor-info">Appointment #'.$appointment_id.'</div>';
                            }
                            
                            echo '</td>
                                    <td>';
                            
                            if($docname) {
                                echo '<div>Dr. '.$docname.'</div>';
                            } else {
                                echo '<span class="doctor-info">N/A</span>';
                            }
                            
                            echo '</td>
                                    <td>
                                        <div>'.$formatted_date.'</div>
                                        <div class="date">'.$formatted_time.'</div>
                                    </td>
                                    ';
                            
                        
                            
                            echo '
                                    <td><span class="status-badge">'.ucfirst($status).'</span></td>
                                  </tr>';
                        }
                        
                        echo '</tbody>
                                </table>
                              </div>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>