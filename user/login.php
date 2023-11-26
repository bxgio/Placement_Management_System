<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student Login</title>
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="bootstrap/bootstrap.min.css">
  <link rel="stylesheet" href="path/to/font-awesome/css/all.min.css"> <!-- Add the path to Font Awesome CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
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
      max-width: 400px;
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
</head>

<body style="background-image: url(../image/back.jpg);">
  <div class="container">
    <div class="row">
      <div class="col-md-6 offset-md-3">
        <div class="login-box">
          <h2>Student Login</h2>
          <hr>
          <form action="user_index.php" method="post" id="login-form">
            <div class="form-group">
              <label for="username">D no</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-envelope fa-lg"></i></span>
                </div>
                <input type="text" class="form-control" id="username" name="email" placeholder="Enter your dno" required>
              </div>
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-lock fa-lg"></i></span>
                </div>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
              </div>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Login</button>
            <div class="error-message" id="error-message"> <a href="forgetpassword.php">Forget Password?</a></div>
            <div class="register-link">Not registered? <a href="register.php">Register Now..</a></div>
            <div class="register-link"><a href="../home.php"><--Back To Home..</a></div>

          </form>
        </div>
      </div>
    </div>
  </div>
</body>

</html>