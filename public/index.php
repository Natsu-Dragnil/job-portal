<?php
require '../config/db.php';

$query = "SELECT * FROM jobs WHERE status = 'Open' ORDER BY created_at DESC";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Browse Jobs</title>
  <link rel="stylesheet" href="../assets/css/style.css"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
</head>
<body>
  <header class="header">
    <div class="container header-content">
      <h1 class="site-title">Job Portal</h1>
      <nav class="nav">
        <ul class="nav-menu">
          <li><a href="index.php">Browse Jobs</a></li>
          <li><a href="../admin/login.php">Admin Login</a></li>
        </ul>
      </nav>
    </div>
  </header>

  <section class="job-listing-container">
    <div class="container">
      <?php if ($result->num_rows > 0): ?>
        <?php while ($job = $result->fetch_assoc()): ?>
          <div class="job-card">
            <div class="job-info">
              <h3><?= htmlspecialchars($job['title']) ?></h3>
              <div class="details">
                <span><i class="fas fa-map-marker-alt"></i> <?= htmlspecialchars($job['location']) ?></span>
                <span><i class="fas fa-briefcase"></i> <?= htmlspecialchars($job['type']) ?></span>
                <span><i class="fas fa-dollar-sign"></i> <?= htmlspecialchars($job['salary']) ?></span>
                <span><i class="fas fa-calendar-day"></i> Deadline: <?= htmlspecialchars($job['deadline']) ?></span>
              </div>
              <div class="details">
                <strong>Skills:</strong> <?= htmlspecialchars($job['skills']) ?>
              </div>
            </div>
            <a href="job.php?id=<?= $job['id'] ?>" class="btn btn-apply">Apply Now</a>
          </div>
        <?php endwhile; ?>
      <?php else: ?>
        <p>No job listings found.</p>
      <?php endif; ?>
    </div>
  </section>

  <footer class="footer">
    <div class="container">
      <p>&copy; <?= date('Y') ?> Job Application Portal. All rights reserved.</p>
    </div>
  </footer>
</body>
</html>
