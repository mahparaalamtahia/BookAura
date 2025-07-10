<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BookAura</title>
    <link rel="icon" href="assets/img/icon_logo.png" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="assets/css/all.min.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="assets/css/style.css">

    <!-- Scripts -->
    <script src="assets/js/jquery-3.6.0.min.js"></script>
    <script src="assets/js/jquery.dataTables.min.js"></script>
    <script src="assets/js/sweetalert.min.js"></script>

    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f6f7fb;
        }

        .header_container {
            background: linear-gradient(to right,rgb(83, 6, 53),rgb(151, 193, 0));
            color: white;
            border-bottom: 5px solidrgb(140, 163, 166);
        }

        .profile-img {
            width: 65px;
            height: 65px;
            border: 3px solid #fff;
        }

        .dashboard_section {
            background: #fff;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 0 15px rgba(0,0,0,0.05);
        }
    </style>
</head>
<body>
    <header>
        <div class="container-fluid header_container py-3">
            <div class="row align-items-center justify-content-between">
                <div class="col-md-10">
                    <h4 class="mb-0">📚 BookAura Dashboard</h4>
                </div>
                <div class="col-md-2 text-end">
                    <?php
                    $db_name='library';
                    $db_host='localhost';
                    $db_user='root';
                    $db_pass='';

                    $con=mysqli_connect($db_host,$db_user,$db_pass,$db_name);
                    if(!$con){ echo "Database Connection Error!"; }

                    if ($_SESSION['role_id'] != '1') {
                        $slug = $_SESSION['slug'];
                        $select = "SELECT * FROM user WHERE slug='$slug'";
                        $Query = mysqli_query($con, $select);
                        $data = mysqli_fetch_assoc($Query);
                        $photo = $data['photo'] != '' ? "uploads/{$data['photo']}" : "assets/img/avatar.jpg";
                    } else {
                        $photo = "assets/img/avatar.jpg";
                    }
                    ?>
                    <img src="<?= $photo ?>" alt="User Photo" class="img-thumbnail rounded-circle profile-img">
                </div>
            </div>
        </div>
    </header>

    <section class="content-section mt-3">
        <div class="container-fluid">
            <div class="row">
