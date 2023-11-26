<?php
session_start();
include('alert.php');
if (isset($_GET['log']) && $_GET['log'] === 'yes') {
  unset($_SESSION["id"]);
  header("location:login.php");
} elseif (isset($_GET['log']) && $_GET['log'] === 'no') {
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>New Registration</title>
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="bootstrap/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<style>
  body {
    background-image: url(../image/back.jpg);
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    height: 100vh;
    /* Set the background to cover the full height of the viewport */
    margin: 0;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .login-box {
    max-width: 600px;
    margin: 0 auto;
    padding: 20px;
    background-color: rgba(255, 255, 255, 0.9);
    /* Use a slightly transparent background for a subtle effect */
    border-radius: 5px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  }

  .login-box h2 {
    margin-bottom: 20px;
    text-align: center;
  }

  .form-group label {
    margin-bottom: 5px;
  }

  .form-group .input-group {
    margin-bottom: 15px;
  }

  .btn-primary {
    width: 100%;
  }

  .error-message {
    text-align: center;
    color: red;
  }

  .register-link {
    text-align: center;
    margin-top: 10px;
    color: #333;
    /* Add a color to the link */
  }

  a {
    text-decoration: none;
  }
</style>

<body style="background-image: url(../image/back.jpg);">
  <div class="container">
    <div class="row">
      <div class="col-md-6 offset-md-3">
        <div class="login-box">
          <h2>New Registration</h2>
          <hr>
          <form action="reg.php" method="post" id="login-form">
            <div class="form-group">
              <label for="username">Name</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-user fa-lg"></i></span>
                </div>
                <input type="text" class="form-control" id="username" name="username" placeholder="Enter your name" required>
              </div>
            </div>
            <div class="form-group">
              <label for="email">D no</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-envelope fa-lg"></i></span>
                </div>
                <input type="text" class="form-control" id="email" name="email" placeholder="Enter your D no" required>
              </div>
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-lock fa-lg"></i></span>
                </div>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter your Password" required>
              </div>
            </div>
            <div class="form-group">
              <label for="cpassword">Confirm Password</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-lock fa-lg"></i></span>
                </div>
                <input type="password" class="form-control" id="cpassword" name="cpassword" placeholder="Enter your password" required>
              </div>

              <button type="submit" name="submit" class="btn btn-primary">Register</button>
              <div class="error-message" id="error-message"></div>
              <br>
              <p>Already Registered!! <a href="login.php">log in..</a></p>

          </form>
        </div>
      </div>
    </div>
  </div>

  <script>
    function togglePasswordVisibility(fieldId) {
      const passwordField = document.getElementById(fieldId);
      const passwordToggleIcon = document.getElementById(`${fieldId}-toggle-icon`);

      if (passwordField.type === "password") {
        passwordField.type = "text";
        passwordToggleIcon.classList.remove("fa-eye");
        passwordToggleIcon.classList.add("fa-eye-slash");
      } else {
        passwordField.type = "password";
        passwordToggleIcon.classList.remove("fa-eye-slash");
        passwordToggleIcon.classList.add("fa-eye");
      }
    }

    const loginForm = document.getElementById("login-form");
    const errorMessage = document.getElementById("error-message");

    loginForm.addEventListener("submit", (event) => {
      const password = document.getElementById("password").value;
      const confirmPassword = document.getElementById("cpassword").value;

      if (password !== confirmPassword) {
        event.preventDefault();
        errorMessage.textContent = "Passwords do not match.";
      }
    });
  </script>
</body>

</html>