<?php
session_start();
if (!isset($_SESSION['admin'])) {
  header("Location: login.php");
  exit;
}

require '../config/db.php';
$result = $conn->query("SELECT * FROM jobs ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="../assets/css/style.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
</head>
<body>
  <header class="header">
    <div class="container header-content">
      <h1 class="site-title">Admin Dashboard</h1>
      <nav class="nav">
        <ul class="nav-menu">
          <li><a href="../index.php">Home</a></li>
          <li><a href="add_job.php">Add Job</a></li>
          <li><a href="applicants.php">Applicants</a></li>
          <li><a href="logout.php">Logout</a></li>
        </ul>
      </nav>
    </div>
  </header>

  <section class="dashboard-section">
    <div class="container">
      <h2>All Job Listings</h2>
      <?php if ($result->num_rows > 0): ?>
        <table class="job-table">
          <thead>
            <tr>
              <th>Title</th>
              <th>Location</th>
              <th>Type</th>
              <th>Salary</th>
              <th>Deadline</th>
              <th>Status</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php while ($job = $result->fetch_assoc()): ?>
              <tr>
                <td><?= htmlspecialchars($job['title']) ?></td>
                <td><?= htmlspecialchars($job['location']) ?></td>
                <td><?= htmlspecialchars($job['type']) ?></td>
                <td><?= htmlspecialchars($job['salary']) ?></td>
                <td><?= htmlspecialchars($job['deadline']) ?></td>
                <td><?= htmlspecialchars($job['status']) ?></td>
                <td>
                  <a href="edit_job.php?id=<?= $job['id'] ?>" class="btn small-btn">Edit</a>
                  <a href="delete_job.php?id=<?= $job['id'] ?>" class="btn small-btn danger-btn" onclick="return confirm('Are you sure you want to delete this job?')">Delete</a>
                  <a href="toggle_status.php?id=<?= $job['id'] ?>" class="btn small-btn warning-btn">Toggle</a>
                </td>
              </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
      <?php else: ?>
        <p>No jobs found.</p>
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
