<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Login</title>
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="bootstrap/bootstrap.min.css">
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
      padding: 50px;
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

    .back-to-home {
      margin-top: 15px;
      text-align: center;
      color: #777;
    }
  </style>
</head>

<body>
  <div class="login-box">
    <h2 class="text-center">Admin Login</h2>
    <hr>
    <form action="index.php" method="post" id="login-form">
      <div class="form-group">
        <label for="username">Username</label>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-envelope fa-lg"></i></span>
          </div>
          <input type="text" class="form-control" id="username" name="uname" placeholder="Enter your Username" required>
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
      <button type="submit" name="submit" id="submit" class="btn btn-primary btn-block">Login</button>
      <div class="error-message mt-3" id="error-message"></div>
      <div class="back-to-home mt-3"><a href="../home.php">Back to Home</a></div>
    </form>
  </div>
</body>

</html>