<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <title> BookAura ‒ Sign Up</title>

  <!-- Favicon -->
  <link rel="icon" href="websites-assets/img/icon_logo.png" type="image/x-icon" />

  <!-- CSS -->
  <link rel="stylesheet" href="websites-assets/css/bootstrap.min.css" />
  <link rel="stylesheet" href="websites-assets/css/all.min.css" />
  <link rel="stylesheet" href="websites-assets/css/style.css" />

  <style>
    /* Full‐height gradient background */
    body {
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      background: linear-gradient(135deg, #4b2e83 0%, #00acc1 100%);
      color: #333;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    /* Navbar */
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

    /* Center the signup card */
    .signup-container {
      flex: 1;
      display: flex;
      align-items: center;
      justify-content: center;
      padding-top: 60px; /* offset for fixed navbar */
      padding-bottom: 60px;
    }

    /* Signup card styling */
    .signup-card {
      width: 100%;
      max-width: 500px;
      background: #fff;
      border-radius: 0.75rem;
      box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
      overflow: hidden;
    }
    .signup-card .card-header {
      background-color: #2a1b4e;
      color: #fff;
      font-size: 1.25rem;
      font-weight: 700;
      text-align: center;
      padding: 1rem;
    }
    .signup-card .card-body {
      padding: 1.5rem;
    }
    .signup-card .form-control {
      border-radius: 0.25rem;
    }
    .signup-card .btn-signup {
      background-color: #4b2e83;
      border: none;
      width: 100%;
      font-weight: 600;
      padding: 0.75rem;
      transition: background-color 0.3s ease;
    }
    .signup-card .btn-signup:hover {
      background-color: #3a2267;
    }
    .signup-card .text-danger {
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
          <li class="nav-item"><a class="nav-link" href="web-books.php">Books</a></li>
          <li class="nav-item"><a class="nav-link" href="index.php#contact">Contact</a></li>
          <li class="nav-item"><a class="nav-link" href="dashboard.php">Log In</a></li>
          <li class="nav-item"><a class="nav-link" href="sign-up.php">Sign Up</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Centered Sign Up Form Container -->
  <div class="signup-container">
    <div class="signup-card card">
      <div class="card-header">
        Sign Up
      </div>
      <?php
        require_once('functions/function.php');

        if (!empty($_POST)) {
          $slug       = uniqid('USER');
          $name       = $_POST['name'];
          $email      = $_POST['email'];
          $mobile     = $_POST['mobile'];
          $address    = $_POST['address'];
          $nid        = $_POST['nid'];
          $password   = md5($_POST['password']);
          $repass     = md5($_POST['repassword']);

          if ($password === $repass) {
            $insert = "INSERT INTO user(name, email, mobile, address, nid, password, slug, role_id)
                       VALUES ('$name','$email','$mobile','$address','$nid','$password','$slug','4')";

            $signup = mysqli_query($con, $insert);

            // Automatically log in
            $select = "SELECT * FROM user WHERE email='$email' AND password='$password'";
            $Q      = mysqli_query($con, $select);
            $Q_data = mysqli_fetch_assoc($Q);

            if ($signup && $Q_data) {
              $_SESSION['id']       = $Q_data['id'];
              $_SESSION['email']    = $Q_data['email'];
              $_SESSION['name']     = $Q_data['name'];
              $_SESSION['photo']    = $Q_data['photo'];
              $_SESSION['role_id']  = $Q_data['role_id'];
              $_SESSION['slug']     = $Q_data['slug'];
              $_SESSION['password'] = $Q_data['password'];
              $_SESSION['success_alert'] = '0';

              header('Location: my-profile.php');
              exit;
            } else {
              echo '<div class="text-danger text-center mb-3">Your registration failed. Please try again.</div>';
            }
          } else {
            echo '<div class="text-danger text-center mb-3">Password confirmation did not match.</div>';
          }
        }
      ?>
      <form method="post" action="">
        <div class="card-body">
          <div class="mb-3">
            <label for="name" class="form-label"><b>Name <span class="text-danger">*</span></b></label>
            <input type="text" class="form-control" id="name" name="name" required />
          </div>
          <div class="mb-3">
            <label for="email" class="form-label"><b>Email <span class="text-danger">*</span></b></label>
            <input type="email" class="form-control" id="email" name="email" required />
          </div>
          <div class="mb-3">
            <label for="mobile" class="form-label"><b>Mobile <span class="text-danger">*</span></b></label>
            <input type="text" class="form-control" id="mobile" name="mobile" required />
          </div>
          <div class="mb-3">
            <label for="address" class="form-label"><b>Address <span class="text-danger">*</span></b></label>
            <input type="text" class="form-control" id="address" name="address" required />
          </div>
          <div class="mb-3">
            <label for="nid" class="form-label"><b>NID <span class="text-danger">*</span></b></label>
            <input type="text" class="form-control" id="nid" name="nid" required />
          </div>
          <div class="mb-3">
            <label for="password" class="form-label"><b>Password <span class="text-danger">*</span></b></label>
            <input type="password" class="form-control" id="password" name="password" required />
          </div>
          <div class="mb-3">
            <label for="repassword" class="form-label"><b>Confirm Password <span class="text-danger">*</span></b></label>
            <input type="password" class="form-control" id="repassword" name="repassword" required />
          </div>
          <button type="submit" class="btn btn-signup">Sign Up</button>
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
