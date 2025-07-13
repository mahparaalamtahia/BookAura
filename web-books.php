<?php
require_once('functions/function.php');

// Fetch all books with category
$sql = "SELECT b.id, b.name AS book_name, b.author, b.quantity, b.slug, b.photo,
               c.name AS category_name
        FROM books b
        JOIN category c ON b.category = c.id
        ORDER BY b.name ASC";

$result = mysqli_query($con, $sql);

if (!$result) {
  die("SQL Error: " . mysqli_error($con));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>All Books | BookAura</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="icon" href="websites-assets/img/icon_logo.png" type="image/x-icon" />
  <link rel="stylesheet" href="websites-assets/css/bootstrap.min.css" />
  <link rel="stylesheet" href="websites-assets/css/all.min.css" />
  <style>
    :root {
      --main-color: #00bfa5;
      --main-color-dark: #00bfa5;
      --text-color: #333;
      --bg-color: #f9f9f9;
    }

    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: var(--bg-color);
      color: var(--text-color);
      padding-top: 70px; /* navbar height offset */
      margin: 0;
    }

    /* Navbar */
    .navbar-custom {
      background-color: var(--main-color);
      box-shadow: 0 3px 8px rgba(0, 191, 165, 0.3);
    }
    .navbar-custom .navbar-brand,
    .navbar-custom .nav-link {
      color: white;
      font-weight: 600;
      transition: color 0.3s ease;
    }
    .navbar-custom .nav-link:hover,
    .navbar-custom .nav-link.active {
      color: #004d40;
      text-decoration: underline;
    }
    .navbar-toggler {
      border-color: rgba(255, 255, 255, 0.5);
    }
    .navbar-toggler-icon {
      color: white;
    }

    /* Page Header */
    .page-header {
      background: var(--main-color);
      color: white;
      padding: 4rem 1rem 3rem;
      text-align: center;
      box-shadow: 0 4px 12px rgba(0, 191, 165, 0.4);
      border-bottom-left-radius: 20px;
      border-bottom-right-radius: 20px;
      margin-bottom: 2.5rem;
    }
    .page-header h1 {
      font-weight: 700;
      font-size: 2.8rem;
      margin-bottom: 0.5rem;
    }
    .page-header p {
      font-size: 1.2rem;
      font-weight: 500;
      opacity: 0.85;
    }

    /* Search Bar */
    .search-bar {
      max-width: 520px;
      margin: 0 auto 3rem auto;
      padding: 0 1rem;
    }
    .search-bar input {
      width: 100%;
      padding: 0.85rem 1.2rem;
      font-size: 1.1rem;
      border: 2.5px solid var(--main-color);
      border-radius: 40px;
      transition: border-color 0.3s ease, box-shadow 0.3s ease;
      box-shadow: 0 2px 5px rgba(0, 191, 165, 0.15);
    }
    .search-bar input:focus {
      outline: none;
      border-color: var(--main-color-dark);
      box-shadow: 0 0 12px var(--main-color-dark);
      background-color: #e0f2f1;
    }

    /* Books Grid */
    .books-container {
      max-width: 1200px;
      margin: 0 auto 5rem;
      padding: 0 1rem;
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
      gap: 1.8rem;
    }
    .book-card {
      background: white;
      border-radius: 14px;
      box-shadow: 0 4px 15px rgba(0, 191, 165, 0.12);
      overflow: hidden;
      display: flex;
      flex-direction: column;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      cursor: default;
    }
    .book-card:hover {
      transform: translateY(-6px);
      box-shadow: 0 12px 30px rgba(0, 191, 165, 0.25);
      cursor: pointer;
    }
    .book-card img {
      width: 100%;
      height: 200px;
      object-fit: cover;
      flex-shrink: 0;
      transition: transform 0.3s ease;
    }
    .book-card:hover img {
      transform: scale(1.05);
    }
    .book-card-body {
      padding: 1.25rem 1.5rem;
      flex-grow: 1;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
    }
    .book-card-body h5 {
      color: var(--main-color-dark);
      font-weight: 700;
      margin-bottom: 0.6rem;
      font-size: 1.3rem;
    }
    .book-card-body p {
      margin: 0.25rem 0;
      font-size: 1rem;
      color: #555;
      line-height: 1.3;
    }
    .book-card-body .btn {
      margin-top: 1.3rem;
      background-color: var(--main-color);
      color: white;
      font-weight: 600;
      border-radius: 30px;
      padding: 0.6rem 1.5rem;
      border: none;
      transition: background-color 0.3s ease, box-shadow 0.3s ease;
      text-decoration: none;
      text-align: center;
      align-self: flex-start;
      user-select: none;
    }
    .book-card-body .btn:hover,
    .book-card-body .btn:focus {
      background-color: var(--main-color-dark);
      box-shadow: 0 4px 15px var(--main-color-dark);
      text-decoration: none;
      outline: none;
    }

    /* Footer */
    footer {
      background-color: #004d40;
      color: #a7d8d1;
      padding: 2.5rem 1rem;
      text-align: center;
      font-size: 0.9rem;
      border-top-left-radius: 15px;
      border-top-right-radius: 15px;
    }
    footer p {
      margin-bottom: 0.6rem;
    }
    footer a {
      color: #a7d8d1;
      margin: 0 0.6rem;
      font-size: 1.3rem;
      transition: color 0.3s ease;
    }
    footer a:hover {
      color: white;
      text-decoration: none;
    }

    /* Responsive */
    @media (max-width: 575.98px) {
      .page-header h1 {
        font-size: 2rem;
      }
      .book-card img {
        height: 160px;
      }
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
          <li class="nav-item"><a class="nav-link" href="index.php#about">About</a></li>
          <li class="nav-item"><a class="nav-link" href="web-books.php">Books</a></li>
          <li class="nav-item"><a class="nav-link" href="index.php#contact">Contact</a></li>
          <li class="nav-item"><a class="nav-link" href="dashboard.php">Log In</a></li>
          <li class="nav-item"><a class="nav-link" href="sign-up.php">Sign Up</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Page Header -->
  <header class="page-header">
    <h1>Our Book Collection</h1>
    <p>Explore the wide variety of books available in BookAura.</p>
  </header>

  <!-- Search Bar -->
  <div class="search-bar">
    <input type="text" id="searchInput" placeholder="Search books by name..." aria-label="Search books" />
  </div>

  <!-- Books Grid -->
  <main class="books-container" id="bookGrid">
    <?php while ($row = mysqli_fetch_assoc($result)): ?>
      <article class="book-card"
        data-title="<?= strtolower(htmlspecialchars($row['book_name'])) ?>"
        data-author="<?= strtolower(htmlspecialchars($row['author'])) ?>"
        data-category="<?= strtolower(htmlspecialchars($row['category_name'])) ?>">
        <img src="uploads/books/<?= htmlspecialchars($row['photo']) ?>" alt="<?= htmlspecialchars($row['book_name']) ?>" loading="lazy" />
        <div class="book-card-body">
          <h5><?= htmlspecialchars($row['book_name']) ?></h5>
          <p><strong>Author:</strong> <?= htmlspecialchars($row['author']) ?></p>
          <p><strong>Category:</strong> <?= htmlspecialchars($row['category_name']) ?></p>
          <p><strong>Available:</strong> <?= $row['quantity'] ?></p>
          <a class="btn" href="#">Borrow Request</a>
        </div>
      </article>
    <?php endwhile; ?>
  </main>

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

  <script src="websites-assets/js/jquery.min.js"></script>
  <script src="websites-assets/js/bootstrap.bundle.min.js"></script>
  <script>
    // Simple client-side search filter
    const searchInput = document.getElementById('searchInput');
    const books = document.querySelectorAll('.book-card');

    searchInput.addEventListener('input', () => {
      const query = searchInput.value.toLowerCase();
      books.forEach(book => {
        const title = book.dataset.title;
        const author = book.dataset.author;
        const category = book.dataset.category;
        if (title.includes(query) || author.includes(query) || category.includes(query)) {
          book.style.display = 'flex';
        } else {
          book.style.display = 'none';
        }
      });
    });
  </script>

</body>
</html>
