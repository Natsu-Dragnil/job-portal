<?php
require '../config/db.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
  die("Invalid job ID.");
}

$id = (int) $_GET['id'];
$job = $conn->query("SELECT * FROM jobs WHERE id = $id AND status = 'Open'")->fetch_assoc();

if (!$job) {
  die("Job not found or unavailable.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title><?= htmlspecialchars($job['title']) ?> - Job Details</title>
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

  <section class="form-section">
    <div class="container">
      <h2><?= htmlspecialchars($job['title']) ?></h2>

      <div class="job-info">
        <p><i class="fas fa-map-marker-alt"></i> Location: <?= htmlspecialchars($job['location']) ?></p>
        <p><i class="fas fa-briefcase"></i> Type: <?= htmlspecialchars($job['type']) ?></p>
        <p><i class="fas fa-dollar-sign"></i> Salary: <?= htmlspecialchars($job['salary']) ?></p>
        <p><i class="fas fa-calendar-alt"></i> Deadline: <?= htmlspecialchars($job['deadline']) ?></p>
      </div>

      <div class="description">
        <h4>Description</h4>
        <p><?= nl2br(htmlspecialchars($job['description'])) ?></p>
      </div>

      <div class="skills">
        <h4>Required Skills</h4>
        <p><?= htmlspecialchars($job['skills']) ?></p>
      </div>

      <div style="margin-top: 30px;">
        <a href="apply.php?id=<?= $job['id'] ?>" class="btn btn-apply">Apply Now</a>
      </div>
    </div>
  </section>

  <footer class="footer">
    <div class="container">
      <p>&copy; <?= date('Y') ?> Job Application Portal. All rights reserved.</p>
    </div>
  </footer>
</body>
</html>
