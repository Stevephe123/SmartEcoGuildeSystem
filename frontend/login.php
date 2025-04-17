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
</head>

<body>
    <?php include 'header.php'; ?>  

    <section class="auth">
        <div class="container auth-container">
            <div id="login-form" class="auth-form active">
                <h2>Login</h2>
                <form method="post" action="">
                    <div class="form-group">
                        <label for="login-email">Email:</label>
                        <input type="email" id="login-email" name="login-email" required>
                    </div>
                    <div class="form-group">
                        <label for="login-password">Password:</label>
                        <input type="password" id="login-password" name="login-password" required>
                    </div>
                    <div class="form-group">
                        <button type="submit" name="login">Login</button>
                    </div>
                    <div class="error-message" id="login-error"></div>
                </form>
                <div class="auth-switch">
                    <button type="button" onclick="showSignupForm()">Don't have an account? Sign Up</button>
                </div>
            </div>

            <div id="signup-form" class="auth-form">
                <h2>Sign Up</h2>
                <form method="post" action="">
                    <div class="form-group">
                        <label for="signup-name">Name:</label>
                        <input type="text" id="signup-name" name="signup-name" required>
                    </div>
                    <div class="form-group">
                        <label for="signup-email">Email:</label>
                        <input type="email" id="signup-email" name="signup-email" required>
                    </div>
                    <div class="form-group">
                        <label for="signup-password">Password:</label>
                        <input type="password" id="signup-password" name="signup-password" required>
                    </div>
                    <div class="form-group">
                        <label for="signup-confirm-password">Confirm Password:</label>
                        <input type="password" id="signup-confirm-password" name="signup-confirm-password" required>
                    </div>
                    <div class="form-group">
                        <button type="submit" name="signup">Sign Up</button>
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
