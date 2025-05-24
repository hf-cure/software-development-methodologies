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

    $sqlmain= "select * from schedule inner join doctor on schedule.docid=doctor.docid where schedule.scheduledate>='$today' order by schedule.scheduledate asc";
    $sqlpt1="";
    $insertkey="";
    $q='';
    $searchtype="All";
        
    if($_POST){
        if(!empty($_POST["search"])){
            $keyword=$_POST["search"];
            $sqlmain= "select * from schedule inner join doctor on schedule.docid=doctor.docid where schedule.scheduledate>='$today' and (doctor.docname='$keyword' or doctor.docname like '$keyword%' or doctor.docname like '%$keyword' or doctor.docname like '%$keyword%' or schedule.title='$keyword' or schedule.title like '$keyword%' or schedule.title like '%$keyword' or schedule.title like '%$keyword%' or schedule.scheduledate like '$keyword%' or schedule.scheduledate like '%$keyword' or schedule.scheduledate like '%$keyword%' or schedule.scheduledate='$keyword' )  order by schedule.scheduledate asc";
            $insertkey=$keyword;
            $searchtype="Search Result : ";
            $q='"';
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
    <!-- Bootstrap JS (before closing body tag) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <title>Sessions</title>
    <style>
        body {
            margin: 0;
            padding: 0;
        }
        
        .container-fluid {
            padding: 0;
            margin: 0;
        }
        .no-stripe-link + div {
            display: none !important;
        }
        /* Responsive adjustments */
        @media (max-width: 768px) {
            .schedule-cards {
                grid-template-columns: 1fr;
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
                    <td class="menu-btn menu-active">
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
                    <p style="font-size: 23px; font-weight: 600;">Scheduled Sessions</p>
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
                            <input type="search" name="search" class="search-input" 
                                   placeholder="Search doctor, session title or date (YYYY-MM-DD)" 
                                   list="doctors" value="<?php echo $insertkey ?>">
                            
                            <?php
                                echo '<datalist id="doctors">';
                                $list11 = $database->query("select DISTINCT * from doctor;");
                                $list12 = $database->query("select DISTINCT * from schedule GROUP BY title;");
                                
                                for ($y=0;$y<$list11->num_rows;$y++){
                                    $row00=$list11->fetch_assoc();
                                    $d=$row00["docname"];
                                    echo "<option value='$d'><br/>";
                                };

                                for ($y=0;$y<$list12->num_rows;$y++){
                                    $row00=$list12->fetch_assoc();
                                    $d=$row00["title"];
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

            <!-- Sessions List Section -->
            <div class="doctors-section card">

 <!-- Trigger Button -->
<button type="button" class="btn btn-primary d-none" data-bs-toggle="modal" data-bs-target="#paymentModal">
  Proceed to Payment
</button>

<!-- Payment Modal -->
<div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content shadow-lg rounded-4">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="paymentModalLabel">Secure Payment</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="payment-form" method="POST" action="../charge.php">
          <input type="hidden" name="appointment_id" value="<?php echo $appointment_id; ?>">
          <input type="hidden" name="amount" value="5000">

          <label for="card-element" class="form-label">Enter your card details</label>
          <div id="card-element" class="form-control p-3 rounded border"></div>
          <div id="card-errors" role="alert" class="text-danger mt-2"></div>

          <button type="submit" class="btn btn-success w-100 mt-4">Pay A$50</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Stripe JS -->
<script src="https://js.stripe.com/v3/"></script>
<script>
  const stripe = Stripe('pk_test_51RRESkPPlpPZ2rI4RS2ezyBjTLEnlSBIldJOx3mTf9VfAOZJvRZZNfvWcSLqEsAgXFK15gEP5dkQu6kSqPOi9UjX00Weoa5sZG'); // Use your Stripe publishable key
//   const elements = stripe.elements();
//   const card = elements.create('card');
    const elements = stripe.elements();

    const card = elements.create('card', {
    hidePostalCode: true,
    style: {
        base: {
        fontSize: '16px',
        color: '#32325d',
        '::placeholder': {
            color: '#a0aec0'
        }
        }
    },
    // This disables Stripe Link:
    classes: {
        base: 'no-stripe-link'
    }
    });

    card.mount('#card-element');

  const form = document.getElementById('payment-form');
  form.addEventListener('submit', async (event) => {
    event.preventDefault();
    const {token, error} = await stripe.createToken(card);
    if (error) {
      document.getElementById('card-errors').textContent = error.message;
    } else {
      const hiddenInput = document.createElement('input');
      hiddenInput.setAttribute('type', 'hidden');
      hiddenInput.setAttribute('name', 'stripeToken');
      hiddenInput.setAttribute('value', token.id);
      form.appendChild(hiddenInput);
      form.submit();
    }
  });
</script>


                <div class="section-header">
                    <div style="display: flex; align-items: center;">
                        <div class="section-header-icon">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                        <span style="margin-left: 10px;"><?php echo $searchtype; ?> Sessions</span>
                    </div>
                    <div>
                        <?php 
                            echo "<p style='font-size: 0.9rem; color: var(--light-text);'>" . $result->num_rows . " session(s) found";
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
                                <img src="../img/notfound.svg" alt="No sessions found" width="100px">
                                <p>No sessions found matching your search criteria!</p>
                                <a href="schedule.php" class="btn-primary" style="display: inline-block; margin-top: 15px;">Show All Sessions</a>
                              </div>';
                    } else {
                        echo '<div class="doctors-grid" style="grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));">';
                        
                        while($row = $result->fetch_assoc()) {
                            $scheduleid = $row["scheduleid"];
                            $title = $row["title"];
                            $docname = $row["docname"];
                            $scheduledate = $row["scheduledate"];
                            $scheduletime = $row["scheduletime"];
                            
                            // Convert date format for display
                            $formattedDate = date('d M Y', strtotime($scheduledate));
                            
                            echo '<div class="doctor-card">
                                    <div class="doctor-avatar" style="background-color: var(--lighter);">
                                        <div class="avatar-placeholder">
                                            <i class="fas fa-calendar-check"></i>
                                        </div>
                                    </div>
                                    <div class="doctor-details">
                                        <h3 class="doctor-name">'.substr($title, 0, 30).'</h3>
                                        <p class="doctor-specialty">Dr. '.substr($docname, 0, 20).'</p>
                                        <div class="doctor-contact">
                                            <div class="contact-item">
                                                <i class="fas fa-calendar-alt"></i>
                                                <span>'.$formattedDate.'</span>
                                            </div>
                                            <div class="contact-item">
                                                <i class="fas fa-clock"></i>
                                                <span>'.substr($scheduletime, 0, 5).' (24h)</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="doctor-actions">
                                        <a href="booking.php?id='.$scheduleid.'" class="btn-view-sessions">
                                            <i class="fas fa-calendar-check"></i> Book Now
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