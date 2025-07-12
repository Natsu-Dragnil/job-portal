<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Job Application Portal</title>
  <link rel="stylesheet" href="assets/css/style.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
</head>
<body>
  <!-- Header/Navbar -->
  <header class="header">
    <div class="container header-content">
      <h1 class="site-title">Job Portal</h1>
      <nav class="nav">
        <ul class="nav-menu">
          <li><a href="public/index.php">Browse Jobs</a></li>
          <li><a href="admin/login.php">Admin Login</a></li>
        </ul>
      </nav>
    </div>
  </header>

  <!-- Hero Section -->
  <section class="hero-section">
    <div class="container">
      <div class="hero-text">
        <h2>Find Your Dream Job</h2>
        <p>Search and apply to jobs quickly with our modern job portal.</p>
        <div class="hero-buttons">
          <a href="public/index.php" class="btn btn-primary">Browse Jobs</a>
          <a href="admin/login.php" class="btn btn-outline">Admin Login</a>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="footer">
    <div class="container">
      <p>&copy; <?= date('Y') ?> Job Application Portal. All rights reserved.</p>
    </div>
  </footer>
</body>
</html>
