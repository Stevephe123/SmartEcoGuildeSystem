<?php
session_start();

// Google reCAPTCHA secret key
$recaptcha_secret = '6LdyQIoqAAAAAM5XvmSQe75z4vJCFig9WhrWhN8w';

// Check if the reCAPTCHA response exists
if (isset($_POST['g-recaptcha-response'])) {
    $recaptcha_response = $_POST['g-recaptcha-response'];

    // Verify reCAPTCHA response with Google's API
    $verify_response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$recaptcha_secret&response=$recaptcha_response");

    // Decode the JSON response
    $response_data = json_decode($verify_response);

    // Check if reCAPTCHA was successful
    if ($response_data->success) {
        // Proceed with registration logic
        if (!empty($_POST['fname']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['confirm-password'])) {
            
            // Check if passwords match
            if ($_POST['password'] === $_POST['confirm-password']) {
                $conn = @mysqli_connect("localhost", "root", "") or die("Unable to connect to database.");
                @mysqli_select_db($conn, "dbsegs") or die("Unable to select database");

                $fname = $_POST['fname'];
                $email = $_POST['email'];
                $pass = hash('sha256', $_POST['password']);
                $session_id = "none";

                $validate = "SELECT Email FROM userlist WHERE email='$email';";

                // Execute query
                $user_exist = @mysqli_query($conn, $validate);

                // Check if Email has been registered
                $row = 0;
                if ($user_exist) {
                    $row = mysqli_num_rows($user_exist);
                }

                @mysqli_free_result($user_exist);

                if ($row == 0) { // Register new user
                    $query = "INSERT INTO userlist(Username, Email, Password, session_id) VALUES('$fname', '$email', '$pass', '$session_id');";
                    @mysqli_query($conn, $query);
					
					echo "<script>alert('Register Successfull');location = 'login.php';</script>";
					
                } else { // Displays error when User/Email already exists in database
                    $_SESSION['error'] = "<p style='color:red'><strong>Failed! User already exists.</strong></p>";
					$_SESSION['show_signup'] = true; // flag to trigger signup form display
					header("Location: login.php");
                    exit();
                }

                @mysqli_close($conn);

            } else { // Displays error when passwords do not match
				$_SESSION['error'] = "<p style='color:red'><strong>Failed! User already exists.</strong></p>";
				$_SESSION['show_signup'] = true;
				header("Location: login.php");
				exit();
            }
        } 
    } else {
        // Handle failed reCAPTCHA verification
        $_SESSION['error'] = "<p style='color:red'><strong>reCAPTCHA verification failed! Please try again.</strong></p>";
		$_SESSION['show_signup'] = true;
        header("Location: login.php");
        exit();
    }
} else {
	session_start();
    // Handle missing reCAPTCHA response
    $_SESSION['error'] = "<p style='color:red'><strong>reCAPTCHA not completed! Please try again.</strong></p>";
	$_SESSION['show_signup'] = true;
    header("Location: login.php");
    exit();
}
?>