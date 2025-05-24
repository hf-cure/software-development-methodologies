<?php
    session_start();

    $_SESSION["user"] = "";
    $_SESSION["usertype"] = "";
    
    // Set the new timezone
    date_default_timezone_set('Australia/Sydney');
    $date = date('d-m-Y');

    $_SESSION["date"] = $date;
    
    // Import database
    include("connection.php");
    $error = '';
    $error_class = '';
    
    if ($_POST) {
        $email = $_POST['useremail'];
        $password = $_POST['userpassword'];
        
        $result = $database->query("SELECT * FROM webuser WHERE email='$email'");
        
        if ($result->num_rows == 1) {
            $utype = $result->fetch_assoc()['usertype'];
            
            if ($utype == 'p') {
                $checker = $database->query("SELECT * FROM patient WHERE pemail='$email' AND ppassword='$password'");
                if ($checker->num_rows == 1) {
                    $_SESSION['user'] = $email;
                    $_SESSION['usertype'] = 'p';
                    header('location: patient/index.php');
                } else {
                    $error = 'Wrong credentials: Invalid email or password';
                    $error_class = 'show';
                }
            } elseif ($utype == 'a') {
                $checker = $database->query("SELECT * FROM admin WHERE aemail='$email' AND apassword='$password'");
                if ($checker->num_rows == 1) {
                    $_SESSION['user'] = $email;
                    $_SESSION['usertype'] = 'a';
                    header('location: admin/index.php');
                } else {
                    $error = 'Wrong credentials: Invalid email or password';
                    $error_class = 'show';
                }
            } elseif ($utype == 'd') {
                $checker = $database->query("SELECT * FROM doctor WHERE docemail='$email' AND docpassword='$password'");
                if ($checker->num_rows == 1) {
                    $_SESSION['user'] = $email;
                    $_SESSION['usertype'] = 'd';
                    header('location: doctor/index.php');
                } else {
                    $error = 'Wrong credentials: Invalid email or password';
                    $error_class = 'show';
                }
            }
        } else {
            $error = 'We can\'t find any account for this email.';
            $error_class = 'show';
        }
    }
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - DocAppoint</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts - Nunito -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/animations.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/login.css">
</head>

<body>
    <?php


    $_SESSION["user"] = "";
    $_SESSION["usertype"] = "";
    
    // Set the new timezone
    date_default_timezone_set('Australia/Sydney');
    $date = date('d-m-Y');

    $_SESSION["date"] = $date;
    
    // Import database
    include("connection.php");
    
    $error = '';
    $error_class = '';
    
    if ($_POST) {
        $email = $_POST['useremail'];
        $password = $_POST['userpassword'];
        
        $result = $database->query("SELECT * FROM webuser WHERE email='$email'");
        
        if ($result->num_rows == 1) {
            $utype = $result->fetch_assoc()['usertype'];
            
            if ($utype == 'p') {
                $checker = $database->query("SELECT * FROM patient WHERE pemail='$email' AND ppassword='$password'");
                if ($checker->num_rows == 1) {
                    $_SESSION['user'] = $email;
                    $_SESSION['usertype'] = 'p';
                    header('location: patient/index.php');
                } else {
                    $error = 'Wrong credentials: Invalid email or password';
                    $error_class = 'show';
                }
            } elseif ($utype == 'a') {
                $checker = $database->query("SELECT * FROM admin WHERE aemail='$email' AND apassword='$password'");
                if ($checker->num_rows == 1) {
                    $_SESSION['user'] = $email;
                    $_SESSION['usertype'] = 'a';
                    header('location: admin/index.php');
                } else {
                    $error = 'Wrong credentials: Invalid email or password';
                    $error_class = 'show';
                }
            } elseif ($utype == 'd') {
                $checker = $database->query("SELECT * FROM doctor WHERE docemail='$email' AND docpassword='$password'");
                if ($checker->num_rows == 1) {
                    $_SESSION['user'] = $email;
                    $_SESSION['usertype'] = 'd';
                    header('location: doctor/index.php');
                } else {
                    $error = 'Wrong credentials: Invalid email or password';
                    $error_class = 'show';
                }
            }
        } else {
            $error = 'We can\'t find any account for this email.';
            $error_class = 'show';
        }
    }
    ?>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg fixed-top" style="background-color: rgba(0,0,0,0.2); backdrop-filter: blur(10px);">
        <div class="container">
            <a class="navbar-brand" href="index.html">
                <span class="logo text-white">Doc<span style="color: #1cc88a;">Appoint</span></span>
                <span class="tagline d-none d-md-inline text-white-50"> | DOCTOR APPOINTMENT PROJECT</span>
            </a>
        </div>
    </nav>

    <div class="login-container">
        <div class="brand-section">
            <div class="brand-content">
                <div class="brand-logo">DocAppoint <span>| DOCTOR PROJECT</span></div>
                <h1 class="brand-tagline">Healthcare at Your Fingertips</h1>
                <p class="brand-description">Connect with doctors online, book appointments with ease, and manage your healthcare journey all in one place.</p>
                <a href="index.html" class="btn btn-light btn-custom px-4 mt-3">
                    <i class="fas fa-arrow-left me-2"></i> Back to Home
                </a>
            </div>
        </div>
        
        <div class="form-section">
            <h2 class="welcome-text">Welcome Back!</h2>
            <p class="instruction-text">Login with your details to continue</p>
            
            <div class="error-message <?php echo $error_class; ?>">
                <i class="fas fa-exclamation-circle me-2"></i>
                <?php echo $error; ?>
            </div>
            
            <form action="" method="POST" class="login-form">
                <div class="form-group">
                    <label class="form-label" for="useremail">Email Address</label>
                    <input type="email" id="useremail" name="useremail" class="form-input" placeholder="Enter your email" required>
                </div>
                
                <div class="form-group">
                    <label class="form-label" for="userpassword">Password</label>
                    <input type="password" id="userpassword" name="userpassword" class="form-input" placeholder="Enter your password" required>
                </div>
                
                <button type="submit" class="login-btn">
                    <i class="fas fa-sign-in-alt me-2"></i> Login
                </button>
            </form>
            
            <div class="signup-link">
                Don't have an account? <a href="signup.php" class="signup-link-text">Sign Up</a>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>