<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <title>BookAura ‒ Log In</title>

  <!-- Favicon -->
  <link rel="icon" href="websites-assets/img/icon_logo.png" type="image/x-icon" />

  <!-- CSS -->
  <link rel="stylesheet" href="websites-assets/css/bootstrap.min.css" />
  <link rel="stylesheet" href="websites-assets/css/all.min.css" />
  <link rel="stylesheet" href="websites-assets/css/style.css" />

  <style>
    /* Full‐height background */
    body {
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      background: linear-gradient(135deg, #4b2e83 0%, #00acc1 100%);
      color: #333;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    /* Navbar override to match theme */
    .navbar-custom {
      background-color: #2a1b4e;
    }
    .navbar-custom .nav-link {
      color: #fff;
      font-weight: 600;
    }
    .navbar-custom .nav-link:hover {
      color: #ffc107;
    }

    /* Center the login card */
    .login-container {
      flex: 1;
      display: flex;
      align-items: center;
      justify-content: center;
      padding-top: 60px; /* to clear fixed navbar */
      padding-bottom: 60px;
    }

    /* Login card styling */
    .login-card {
      width: 100%;
      max-width: 420px;
      background: #fff;
      border-radius: 0.75rem;
      box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
      overflow: hidden;
    }
    .login-card .card-header {
      background-color: #2a1b4e;
      color: #fff;
      font-size: 1.25rem;
      font-weight: 700;
      text-align: center;
      padding: 1rem;
    }
    .login-card .card-body {
      padding: 1.5rem;
    }
    .login-card .form-control {
      border-radius: 0.25rem;
    }
    .login-card .btn-login {
      background-color: #4b2e83;
      border: none;
      width: 100%;
      font-weight: 600;
      padding: 0.75rem;
      transition: background-color 0.3s ease;
    }
    .login-card .btn-login:hover {
      background-color: #3a2267;
    }
    .login-card .text-danger {
      font-size: 0.9rem;
    }
  </style>
</head>
<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-md navbar-custom fixed-top">
    <div class="container">
      <a class="navbar-brand text-white" href="index.php">BookAura</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mainNav">
        <span class="navbar-toggler-icon" style="color: #fff;">&#9776;</span>
      </button>
      <div class="collapse navbar-collapse" id="mainNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="index.php#about">About</a></li>
          <li class="nav-item"><a class="nav-link" href="index.php#contact">Contact</a></li>
          <li class="nav-item"><a class="nav-link" href="dashboard.php">Log In</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Centered Login Form Container -->
  <div class="login-container">
    <div class="login-card card">
      <div class="card-header">
        Log In
      </div>
      <?php
        // PHP Logic
        require_once('functions/function.php');
        if (!empty($_POST)) {
          $email = $_POST['email'];
          $password = md5($_POST['password']);

          // Regular user
          $select = "SELECT * FROM user WHERE email='$email' AND password='$password'";
          $Q = mysqli_query($con, $select);
          $Q_data = mysqli_fetch_assoc($Q);

          // Super‐admin
          $select_sa = "SELECT * FROM super_admin WHERE sa_email='$email' AND sa_password='$password'";
          $Q_sa = mysqli_query($con, $select_sa);
          $Q_sa_data = mysqli_fetch_assoc($Q_sa);

          if ($Q_data) {
            $_SESSION['id']       = $Q_data['id'];
            $_SESSION['email']    = $Q_data['email'];
            $_SESSION['name']     = $Q_data['name'];
            $_SESSION['photo']    = $Q_data['photo'];
            $_SESSION['role_id']  = $Q_data['role_id'];
            $_SESSION['slug']     = $Q_data['slug'];
            $_SESSION['password'] = $Q_data['password'];
            $_SESSION['success_alert'] = '0';

            if ($Q_data['role_id'] == '1') {
              header('Location: dashboard.php');
            } else {
              header('Location: my-profile.php');
            }
            exit;
          }
          elseif ($Q_sa_data) {
            $_SESSION['id']         = "SA1";
            $_SESSION['email']      = $Q_sa_data['sa_email'];
            $_SESSION['name']       = "Admin";
            $_SESSION['photo']      = "";
            $_SESSION['role_id']    = $Q_sa_data['role_id'];
            $_SESSION['sa_password'] = $Q_sa_data['sa_password'];
            $_SESSION['success_alert'] = '0';
            header('Location: dashboard.php');
            exit;
          }
          else {
            echo '<div class="text-danger text-center mb-3">Your email or password did not match.</div>';
          }
        }
      ?>
      <form method="post" action="">
        <div class="card-body">
          <div class="mb-3">
            <label for="email" class="form-label"><b>Email <span class="text-danger">*</span></b></label>
            <input type="email" class="form-control" id="email" name="email" required />
          </div>
          <div class="mb-3">
            <label for="password" class="form-label"><b>Password <span class="text-danger">*</span></b></label>
            <input type="password" class="form-control" id="password" name="password" required />
          </div>
          <button type="submit" class="btn btn-login">Log In</button>
        </div>
      </form>
    </div>
  </div>

  <!-- JS: Bootstrap & Dependencies -->
  <script src="websites-assets/js/bootstrap.bundle.min.js"></script>
  <script src="websites-assets/js/jquery-3.4.1.min.js"></script>
  <script src="websites-assets/js/sweetalert2.all.min.js"></script>
  <script src="websites-assets/js/custom.js"></script>
</body>
</html>
