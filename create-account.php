<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account - DocAppoint</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- CSS Files -->
    <link rel="stylesheet" href="css/animations.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/signup.css">
</head>

<body>
    <?php
    // Unset all session variables and set timezone
    session_start();
    $_SESSION["user"] = "";
    $_SESSION["usertype"] = "";
    date_default_timezone_set('Australia/Sydney');
    $date = date('d-m-Y');
    $_SESSION["date"] = $date;

    // Import database connection
    include("connection.php");

    // Error handling
    $error = '';

    if ($_POST) {

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
    ?>

    <div class="container">
        <div class="brand-section">
            <div class="brand-logo">DocAppoint <span>| DOCTOR PROJECT</span></div>
            <h1 class="brand-tagline">Healthcare at Your Fingertips</h1>
            <p class="brand-description">Connecting you with doctors online, for seamless healthcare management.</p>
        </div>

        <div class="form-section">
            <h2 class="welcome-text">Create Your Account</h2>
            <p class="instruction-text">Please fill in the details below to create your account.</p>

            <?php echo $error; ?>

            <form action="" method="POST" class="signup-form">
                <div class="form-group">
                    <label for="newemail" class="form-label">Email Address</label>
                    <input type="email" name="newemail" id="newemail" class="form-input" placeholder="Enter your email" required>
                </div>

                <div class="form-group">
                    <label for="tele" class="form-label">Mobile Number</label>
                    <input type="tel" name="tele" id="tele" class="form-input" placeholder="ex: 0712345678" pattern="[0]{1}[0-9]{9}" required>
                </div>

                <div class="form-group">
                    <label for="newpassword" class="form-label">Create Password</label>
                    <input type="password" name="newpassword" id="newpassword" class="form-input" placeholder="Enter your password" required>
                </div>

                <div class="form-group">
                    <label for="cpassword" class="form-label">Confirm Password</label>
                    <input type="password" name="cpassword" id="cpassword" class="form-input" placeholder="Confirm your password" required>
                </div>

                <button type="submit" class="signup-btn">Sign Up</button>
            </form>

            <div class="login-link">
                Already have an account? <a href="login.php">Login</a>
            </div>
        </div>
    </div>
</body>

</html>
