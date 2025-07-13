<?php
require_once('functions/function.php');
needtologin();
admin();

if (!empty($_POST)) {
    $slug = $_POST['slug'];
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $author = mysqli_real_escape_string($con, $_POST['author']);
    $category = mysqli_real_escape_string($con, $_POST['category']);
    $quantity = (int) $_POST['quantity'];  // Cast to integer for safety

    // Fetch current book data to get old image filename
    $old_query = "SELECT photo FROM books WHERE slug='$slug'";
    $old_result = mysqli_query($con, $old_query);
    $old_data = mysqli_fetch_assoc($old_result);
    $old_photo = $old_data['photo'];

    $photo_name = $old_photo;  // Default: keep old photo

    // Handle image upload if a new file is selected
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['photo']['tmp_name'];
        $fileName = $_FILES['photo']['name'];
        $fileSize = $_FILES['photo']['size'];
        $fileType = $_FILES['photo']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        // Allowed extensions
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];

        if (in_array($fileExtension, $allowedExtensions)) {
            // New file name (to avoid conflicts)
            $newFileName = md5(time() . $fileName) . '.' . $fileExtension;

            $uploadFileDir = 'uploads/books/';
            $dest_path = $uploadFileDir . $newFileName;

            if (move_uploaded_file($fileTmpPath, $dest_path)) {
                $photo_name = $newFileName;

                // Optionally: delete old photo file if it exists and is not default
                if (!empty($old_photo) && $old_photo != 'default.png' && file_exists($uploadFileDir . $old_photo)) {
                    unlink($uploadFileDir . $old_photo);
                }
            } else {
                $_SESSION['success_alert'] = '9'; // Upload failed alert code (define as needed)
                header("Location: edit-book.php?e=$slug");
                exit;
            }
        } else {
            $_SESSION['success_alert'] = '10'; // Invalid file type alert code (define as needed)
            header("Location: edit-book.php?e=$slug");
            exit;
        }
    }

    // Now update the book record including photo
    $update = "UPDATE books SET 
                name = '$name', 
                author = '$author', 
                category = '$category', 
                quantity = '$quantity',
                photo = '$photo_name' 
               WHERE slug = '$slug'";

    $Q = mysqli_query($con, $update);

    if ($Q) {
        $_SESSION['success_alert'] = '2';  // Book info updated successfully
        header('Location: all-book.php');
        exit;
    } else {
        $_SESSION['success_alert'] = '8';  // Error alert code
        header("Location: edit-book.php?e=$slug");
        exit;
    }
} else {
    $_SESSION['success_alert'] = '8';
    header('Location: all-book.php');
    exit;
}
