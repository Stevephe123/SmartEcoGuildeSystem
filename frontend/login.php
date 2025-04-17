<?php
// You can handle login or registration logic here if this is a unified file
// Example placeholders:
// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     if (isset($_POST['login'])) { /* handle login */ }
//     if (isset($_POST['signup'])) { /* handle signup */ }
// }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login & Sign Up - Sarawak Park Guide System</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
	<script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>

<body>
	<?php
	session_start();
	include("database.php");
	// Google reCAPTCHA secret key
	$recaptcha_secret = '6LdyQIoqAAAAAM5XvmSQe75z4vJCFig9WhrWhN8w'; // Your secret key here
	if (isset($_POST["login_button"])) {

    // Verify reCAPTCHA response first
    if (isset($_POST['g-recaptcha-response'])) {
        $recaptcha_response = $_POST['g-recaptcha-response'];

        // Verify the reCAPTCHA response with Google's API
        $verify_response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$recaptcha_secret&response=$recaptcha_response");

        // Decode the JSON response
        $response_data = json_decode($verify_response);

        // If reCAPTCHA is not successful, show error
        if (!$response_data->success) {
            $Msg = "<p style='color:red;'>Please do the reCAPTCHA.</p>";
        } 
		else {
            // Proceed with login logic only if reCAPTCHA is successful
            $conn = @mysqli_connect("localhost", "root", "") or die("Unable to connect to database.");
            @mysqli_select_db($conn, "dbsegs") or die ("Unable to select database");

            $id = strtolower(mysqli_escape_string($conn, $_POST['email']));
			$pass = hash('sha256',$_POST["password"]);
			
            //$getUser = "SELECT * FROM userlist WHERE email='$id' AND pass='$pass'";
            $getUser = "SELECT * FROM userlist WHERE Email=? AND Password=?";
			
            //Execute query
            //$valid = @mysqli_query($conn, $getUser);
			$prepared_result = mysqli_prepare($conn, $getUser);
			mysqli_stmt_bind_param($prepared_result, 'ss', $id, $pass);
			mysqli_stmt_execute($prepared_result);
			$valid = mysqli_stmt_get_result($prepared_result);
			mysqli_stmt_close($prepared_result);

            //Fetch the result safely
            $dbUserData = mysqli_fetch_assoc($valid);

            //If the user exists and password matches
            if ($dbUserData) {
                // User data is valid, set session variables
                $_SESSION['Username'] = $dbUserData['Username'];
                $_SESSION['Email'] = $dbUserData['Email'];
                $_SESSION['Id'] = $dbUserData['Id'];
                $_SESSION['session_id'] = $dbUserData['session_id'];
                $_SESSION['time'] = $dbUserData['time'];

                // Session management (prevent session fixation)
                $id = $_SESSION['Id'];
                if ((time() - $_SESSION['time']) > 300 || (time() - $_SESSION['time']) < -300) {
                    $dbUserData['session_id'] = "none";
                }

                // Prevent multiple logins with the same session
                if ($dbUserData['session_id'] == "none") {
                    $sessionID = session_id();
                    $time = time();

                    $updateSession = "UPDATE userlist SET session_id='$sessionID', time='$time' WHERE Id='$id'";
                    @mysqli_query($conn, $updateSession);

                    $_SESSION['session_id'] = $sessionID;
                    $_SESSION['time'] = $time;
                }

                // Redirect to the dashboard after successful login
                header("Location: index.php");
            } else {
                // If login details are incorrect
                $Msg = "<p style='color:red'><strong>Invalid username or password!</strong></p>";
            }

            @mysqli_free_result($valid);
            @mysqli_close($conn);
        }
    } else {
        // Handle missing reCAPTCHA response
        $Msg = "<p style='color:red;'>Please complete the reCAPTCHA challenge!</p>";
    }
}
	?>
    <?php include 'header.php'; ?>  

<section class="auth">
        <div class="container auth-container">
            <div id="login-form" class="auth-form active">
                <h2>Login</h2>
                <form method="post">
                    <div class="form-group">
                        <label for="login-email">Email:</label>
                        <input type="email" id="login-email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="login-password">Password:</label>
                        <input type="password" id="login-password" name="password" required>
                    </div>
                    <div align="center">
                        <div class="g-recaptcha" data-sitekey="6LdyQIoqAAAAAJdf4oyhSsy5XExaIot2qbxasQw2"></div>
                    </div>
					<div align="center"><?php echo $Msg; ?></div>
                    <div class="form-group"><br>
                        <button type="submit" name="login_button">Login</button>
                    </div>
                    <div class="error-message" id="login-error"></div>
                </form>
                <div class="auth-switch">
                    <button type="button" onclick="showSignupForm()">Don't have an account? Sign Up</button>
                </div>
            </div>

            <div id="signup-form" class="auth-form">
                <h2>Sign Up</h2>
                <form method="post" action="reg_confirm.php">
					<?php if (isset($_SESSION['show_signup']) && $_SESSION['show_signup']): ?>
					<script>
						window.onload = function () {
						showSignupForm();
						};
					</script>
					
					<?php unset($_SESSION['show_signup']); endif;
					// Display ERROR messages if any
					if (!empty($_SESSION['error'])){
							echo $_SESSION['error'];
							unset($_SESSION['error']);
					}
					?>
                    <div class="form-group">
                        <label for="signup-name">Name:</label>
                        <input type="text" name="fname" placeholder="Name*"/>
                    </div>
                    <div class="form-group">
                        <label for="signup-email">Email:</label>
                        <input type="email" id="signup-email" name="email" required placeholder="Email*">
                    </div>
                    <div class="form-group">
                        <label for="signup-password">Password:</label>
                        <input type="password" id="signup-password" name="password" required placeholder="Password*">
                    </div>
                    <div class="form-group">
                        <label for="signup-confirm-password">Confirm Password:</label>
                        <input type="password" id="signup-confirm-password" name="confirm-password" required>
                    </div>
					<div align="center">
                        <div class="g-recaptcha" data-sitekey="6LdyQIoqAAAAAJdf4oyhSsy5XExaIot2qbxasQw2"></div>
                    </div>
					<div align="center"><?php echo $Msg; ?></div><br>
                    <div class="form-group">
                        <button type="submit" name="btnSignUp">Sign Up</button>
                    </div>
					
                    <div class="form-group">
                        <button type="button" class="google-signup-button">
                            <i class="fab fa-google"></i> Sign Up with Google
                        </button>
                    </div>
                    <div class="error-message" id="signup-error"></div>
                </form>
                <div class="auth-switch">
                    <button type="button" onclick="showLoginForm()">Already have an account? Login</button>
                </div>
            </div>
        </div>
    </section>

    <?php include 'footer.php'; ?>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            document.getElementById('login-form').classList.add('active');
        });

        function showLoginForm() {
            document.getElementById('signup-form').classList.remove('active');
            document.getElementById('login-form').classList.add('active');
        }

        function showSignupForm() {
            document.getElementById('login-form').classList.remove('active');
            document.getElementById('signup-form').classList.add('active');
        }

        // Set current year
        document.getElementById('current-year').textContent = new Date().getFullYear();
    </script>
    <script src="js/script.js"></script>
</body>

</html>
