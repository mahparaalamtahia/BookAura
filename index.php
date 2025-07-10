<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>BookAura</title>

  <!-- Favicon -->
  <link rel="icon" href="websites-assets/img/icon_logo.png" type="image/x-icon" />

  <!-- CSS -->
  <link rel="stylesheet" href="websites-assets/css/bootstrap.min.css" />
  <link rel="stylesheet" href="websites-assets/css/all.min.css" />
  <link rel="stylesheet" href="websites-assets/css/style.css" />

  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f2f4f7;
      color: #333;
    }

    /* Navbar */
    .navbar-custom {
      background-color: #004d66; /* dark teal */
    }
    .navbar-custom .nav-link,
    .navbar-custom .navbar-brand {
      color: #fff;
    }
    .navbar-custom .nav-link:hover {
      color: #00bfa5;
    }

    /* Hero Section */
    .hero {
      background: linear-gradient(to right, #00bfa5, #006064);
      color: white;
      padding: 6rem 1rem;
      text-align: center;
    }
    .hero h1 {
      font-size: 3.5rem;
      font-weight: bold;
    }
    .hero p {
      font-size: 1.25rem;
      margin-top: 1rem;
    }

    /* About Section */
    #about {
      background-color: white;
      padding: 8rem 1rem 8rem 1rem; /* Increased top padding */
    }

    #about .container {
      max-width: 960px;
    }

    /* Contact Section */
    #contact {
      background-color: #e0f7fa;
      padding: 8rem 1rem 8rem 1rem
    }

    /* Footer */
    footer {
      background-color: #003d4d;
      color: #ccc;
      padding: 2rem 1rem;
      text-align: center;
    }
    footer a {
      color: #00bfa5;
      margin: 0 0.5rem;
      font-size: 1.2rem;
    }
    footer a:hover {
      color: #fff;
    }

    .btn-primary {
      background-color: #00bfa5;
      border: none;
    }
    .btn-primary:hover {
      background-color: #00897b;
    }
  </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-md navbar-custom fixed-top">
  <div class="container">
    <a class="navbar-brand" href="index.php">BookAura</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon text-white">&#9776;</span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
        <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
        <li class="nav-item"><a class="nav-link" href="dashboard.php">Log In</a></li>
      </ul>
    </div>
  </div>
</nav>

<!-- Hero Section -->
<section class="hero">
  <div class="container">
    <h1>Welcome to BookAura</h1>
    <p>Your gateway to knowledge, learning, and exploration.</p>
    <a href="web-books.php" class="btn btn-primary btn-lg mt-4">Browse Books</a>
  </div>
</section>

<!-- About Section -->
<section id="about">
  <div class="container text-center">
    <h2 class="mb-4">About BookAura</h2>
    <p class="lead">
      Libraries are more than book repositories — they are learning hubs that support discovery, literacy, and access to information. 
      In today’s digital age, libraries have become vibrant centers for innovation, offering access to both print and digital resources, 
      including e-books, research databases, internet, and educational programs.
    </p>
  </div>
</section>

<!-- Contact Section -->
<section id="contact">
  <div class="container">
    <h2 class="text-center mb-5">Contact Information</h2>
    <div class="row justify-content-center">
      <div class="col-md-8">
        <ul class="list-unstyled">
          <li><strong>Address:</strong> Permanent Campus, Plot# 06, Avenue# 06, Sector# 17/H-1, Uttara, Dhaka-1230</li>
          <li><strong>Campus Type:</strong> Urban</li>
          <li><strong>Founded:</strong> 2003, Dhaka</li>
          <li><strong>Chairman:</strong> Md. Imamul Kabir Shanto</li>
          <li><strong>Chancellor:</strong> President Mohammed Shahabuddin</li>
          <li><strong>Vice-Chancellor:</strong> Shah E Alam</li>
          <li><strong>University Type:</strong> Private, Co-educational</li>
          <li><strong>Phone:</strong> 09638-177177</li>
        </ul>
      </div>
    </div>
  </div>
</section>

<!-- Footer -->
<footer>
  <div class="container">
    <p>© 2025 BookAura. All rights reserved.</p>
    <div>
      <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
      <a href="#" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
      <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
      <a href="#" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
      <a href="#" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
    </div>
  </div>
</footer>

<!-- JS -->
<script src="websites-assets/js/jquery-3.4.1.min.js"></script>
<script src="websites-assets/js/bootstrap.bundle.min.js"></script>

</body>
</html>
