<!-- Sidebar -->
<div class="col-lg-2 col-md-12 bg-danger text-white p-3 rounded-start" style="min-height: 85vh;">
    <div class="text-center mb-3">
        <h5 class="mb-0"><?= $_SESSION['name']; ?></h5>
        <small class="badge bg-light text-dark mt-1">
            <?php
            switch ($_SESSION['role_id']) {
                case '1':
                    echo "Admin";
                    break;
                case '4':
                    echo "User";
                    break;
            }
            ?>
        </small>
    </div>

    <nav class="nav flex-column">
        <?php if ($_SESSION['role_id'] == '2' || $_SESSION['role_id'] == '3' || $_SESSION['role_id'] == '4'): ?>
            <a class="nav-link text-white" href="my-profile.php"><i class="fas fa-user"></i> My Profile</a>
           
        <?php endif; ?>

        <?php if ($_SESSION['role_id'] == '1'): ?>
            
            <a class="nav-link text-white" href="all-book.php"><i class="fas fa-book-open"></i> All Book</a>
            <a class="nav-link text-white" href="add-book.php"><i class="fas fa-plus-circle"></i> Add Book</a>

            <a class="nav-link text-white" href="all-category.php"><i class="fas fa-layer-group"></i> All Category</a>
            <a class="nav-link text-white" href="add-category.php"><i class="fas fa-plus-square"></i> Add Category</a>
            
        <?php endif; ?>

        <?php if ($_SESSION['role_id'] == '4'): ?>
           
        <?php endif; ?>

        <a class="nav-link text-white" href="index.php"><i class="fas fa-globe-asia"></i> Website</a>
        <a class="nav-link text-white" href="logout.php"><i class="fas fa-sign-out-alt"></i> Sign out</a>
    </nav>
</div>

<!-- Dashboard Content Area -->
<div class="col-lg-10 col-md-12 dashboard_section text-danger" id="dashboard_section">
    <div class="scrollable">
        <!-- data/content -->
