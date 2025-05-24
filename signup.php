<?php
// Start session
session_start();
include("connection.php");

// Unset all server-side variables
$_SESSION["user"] = "";
$_SESSION["usertype"] = "";

// Set the new timezone
date_default_timezone_set('Australia/Sydney');
$date = date('d-m-Y');

$_SESSION["date"] = $date;


if($_POST){

    
    $email = $_POST['newemail'];
    $fname = $_POST['fname'];
    $lname =  $_POST['lname'];
    $name = $fname . " " . $lname;
    $newpassword = $_POST['newpassword'];
    $address =  $_POST['address'];
    $dob = $_POST['dob'];
    $tele = $_POST['tele'];
    $cpassword = $_POST['cpassword'];

   


    if ($newpassword == $cpassword) {
        $stmt = $database->prepare("SELECT * FROM webuser WHERE email=?;");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $error = '<div class="error-message">An account with this email already exists.</div>';
        } else {
            $database->query("INSERT INTO patient (pemail, pname, ppassword, paddress, pdob, ptel) 
                              VALUES ('$email', '$name', '$newpassword', '$address', '$dob', '$tele');");
            $database->query("INSERT INTO webuser (email, usertype) VALUES ('$email', 'p')");

            $_SESSION["user"] = $email;
            $_SESSION["usertype"] = "p";
            $_SESSION["username"] = $fname;
            
            

            header('Location: patient/index.php');
            exit;
        }
    } else {
        $error = '<div class="error-message">Password confirmation does not match. Please try again.</div>';
    }


}

// Initialize error variable
$error = '';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account - DocAppoint</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- CSS Files -->
    <link rel="stylesheet" href="css/animations.css">  
    <link rel="stylesheet" href="css/main.css">
    
    <style>
        :root {
            --primary-color: #4e73df;
            --secondary-color: #1cc88a;
            --dark-color: #2e384d;
            --light-color: #f8f9fc;
            --text-color: #5a5c69;
        }
        
        body {
            font-family: 'Nunito', sans-serif;
            color: var(--text-color);
            background-color: var(--light-color);
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        
        .navbar {
            background-color: rgba(0,0,0,0.2);
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
        }
        
        .logo {
            font-weight: 800;
            font-size: 2rem;
            color: white;
            margin-bottom: 0;
        }
        
        .logo span {
            color: var(--secondary-color);
        }
        
        .tagline {
            font-weight: 300;
            font-size: 1rem;
            opacity: 0.8;
        }
        
        .nav-link {
            color: rgba(255, 255, 255, 0.8);
            font-weight: 600;
            padding: 0.5rem 1rem;
            transition: all 0.3s ease;
        }
        
        .nav-link:hover {
            color: white;
        }
        
        .signup-section {
            background: linear-gradient(135deg, rgba(78, 115, 223, 0.95) 0%, rgba(28, 200, 138, 0.95) 100%);
            padding: 100px 0;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-grow: 1;
            position: relative;
            overflow: hidden;
        }
        
        .signup-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('https://images.unsplash.com/photo-1579684385127-1ef15d508118?ixlib=rb-4.0.3&auto=format&fit=crop&w=1950&q=80') no-repeat center center;
            background-size: cover;
            opacity: 0.1;
            z-index: 0;
        }
        
        .signup-container {
            width: 100%;
            max-width: 500px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 15px 30px rgba(0, 0, 40, 0.1);
            padding: 40px;
            position: relative;
            z-index: 1;
            animation: fadeIn 0.6s ease-in-out;
        }
        
        .signup-header {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .signup-header h2 {
            font-weight: 700;
            color: var(--dark-color);
            margin-bottom: 10px;
        }
        
        .signup-header p {
            color: var(--text-color);
            opacity: 0.8;
        }
        
        .form-group {
            /* margin-bottom: 20px; */
            animation: slideInFromBottom 0.6s ease-in-out;
        }
        
        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: var(--dark-color);
            font-size: 0.9rem;
        }
        
        .form-input {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #d1d3e2;
            border-radius: 6px;
            font-size: 0.95rem;
            transition: all 0.3s ease;
        }
        
        .form-input:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
            outline: none;
        }
        
        .error-msg {
            color: #e74a3b;
            font-size: 0.85rem;
            margin-top: 5px;
            text-align: center;
            animation: fadeIn 0.5s ease-out;
        }
        
        .form-actions {
            display: flex;
            justify-content: space-between;
            gap: 15px;
            margin-top: 30px;
        }
        
        .btn {
            padding: 12px 20px;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s ease;
            cursor: pointer;
            width: 100%;
            text-align: center;
            border: none;
        }
        
        .btn-primary-custom {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
        }
        
        .btn-primary-custom:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
        }
        
        .btn-secondary-custom {
            background-color: white;
            color: var(--primary-color);
            border: 1px solid #d1d3e2;
        }
        
        .btn-secondary-custom:hover {
            background-color: #f8f9fc;
        }
        
        .login-link {
            text-align: center;
            margin-top: 25px;
            font-size: 0.9rem;
        }
        
        .login-link a {
            color: var(--primary-color);
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        
        .login-link a:hover {
            color: var(--secondary-color);
            text-decoration: underline;
        }
        
        .back-link {
            position: absolute;
            top: 20px;
            left: 20px;
            color: white;
            font-weight: 600;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            z-index: 2;
        }
        
        .back-link:hover {
            transform: translateX(-5px);
            color: white;
        }
        
        .footer {
            background-color: var(--dark-color);
            color: white;
            padding: 15px 0;
            text-align: center;
        }
        
        @media (max-width: 768px) {
            .signup-section {
                padding: 50px 20px;
            }
            
            .signup-container {
                padding: 30px 20px;
            }
            
            .form-actions {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>


<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="index.html">
            <span class="logo">Doc<span>Appoint</span></span>
            <span class="tagline d-none d-md-inline"> | DOCTOR APPOINTMENT PROJECT</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.html#features">Features</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.html#how-it-works">How It Works</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="login.php">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="signup.php">Register</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Signup Section -->
<section class="signup-section">
    <a href="index.html" class="back-link">
        <i class="fas fa-arrow-left"></i> Back to Home
    </a>
    
    <div class="signup-container">
        <div class="signup-header">
            <h2>Create Your Account</h2>
            <p>Join thousands of patients who are simplifying their healthcare journey</p>
        </div>
        
        <form action="" method="POST">
            <div class="row">
                <!-- First column -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="firstname" class="form-label">First Name</label>
                        <input type="text" id="firstname" name="fname" class="form-input" placeholder="First name" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="newemail" class="form-label">Email Address</label>
                        <input type="email" id="newemail" name="newemail" class="form-input" placeholder="Email address" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" id="address" name="address" class="form-input" placeholder="Address">
                    </div>
                    
                    <div class="form-group">
                        <label for="newpassword" class="form-label">Create Password</label>
                        <input type="password" id="newpassword" name="newpassword" class="form-input" placeholder="Create password" required>
                    </div>
                </div>
                
                <!-- Second column -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="lastname" class="form-label">Last Name</label>
                        <input type="text" id="lastname" name="lname" class="form-input" placeholder="Last name" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="tele" class="form-label">Mobile Number</label>
                        <input type="tel" id="tele" name="tele" class="form-input" placeholder="ex: 0712345678" pattern="[0]{1}[0-9]{9}">
                    </div>
                    
                    <div class="form-group">
                        <label for="dob" class="form-label">Date of Birth</label>
                        <input type="date" id="dob" style="padding: 19.2px 24px;margin: 0 0 24px;" name="dob" class="form-input" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="cpassword" class="form-label">Confirm Password</label>
                        <input type="password" id="cpassword" name="cpassword" class="form-input" placeholder="Confirm password" required>
                    </div>
                </div>
            </div>
            
            <?php if($error): ?>
                <div class="error-msg"><?php echo $error; ?></div>
            <?php endif; ?>
            
            <div class="form-actions">
                <button type="reset" class="btn btn-secondary-custom">Reset</button>
                <button type="submit" class="btn btn-primary-custom">Create Account</button>
            </div>
        </form>
        
        <div class="login-link">
            Already have an account? <a href="login.php">Login here</a>
        </div>
    </div>
</section>
<!-- Footer -->
<footer class="footer">
    <div class="container">
        <p>© 2025 DocAppoint. All rights reserved.</p>
    </div>
</footer>

<!-- Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Add navbar background on scroll
    window.addEventListener('scroll', function() {
        const navbar = document.querySelector('.navbar');
        if (window.scrollY > 50) {
            navbar.style.backgroundColor = 'rgba(46, 56, 77, 0.95)';
        } else {
            navbar.style.backgroundColor = 'rgba(0,0,0,0.2)';
        }
    });
</script>
</body>
</html>