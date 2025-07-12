<?php
session_start();
if (!isset($_SESSION['admin'])) {
  header("Location: login.php");
  exit;
}

require '../config/db.php';

// Query: join applicants with jobs, ordered by job then date
$query = "
  SELECT a.*, j.title AS job_title
  FROM applicants a
  JOIN jobs j ON a.job_id = j.id
  ORDER BY j.title ASC, a.applied_at DESC
";

$result = $conn->query($query);

// Group by job title
$applicants_by_job = [];
while ($row = $result->fetch_assoc()) {
  $applicants_by_job[$row['job_title']][] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Applicants - Admin</title>
  <link rel="stylesheet" href="../assets/css/style.css"/>
</head>
<body>
  <header class="header">
    <div class="container header-content">
      <h1 class="site-title">Applicants</h1>
      <nav class="nav">
        <ul class="nav-menu">
          <li><a href="dashboard.php">Dashboard</a></li>
          <li><a href="export_csv.php">Export CSV</a></li>
          <li><a href="logout.php">Logout</a></li>
        </ul>
      </nav>
    </div>
  </header>

  <section class="dashboard-section">
    <div class="container">
      <h2>All Applicants</h2>

      <?php if (!empty($applicants_by_job)): ?>
        <?php foreach ($applicants_by_job as $job_title => $applicants): ?>
          <h3 style="margin-top: 40px;"><?= htmlspecialchars($job_title) ?></h3>
          <table class="job-table">
            <thead>
              <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Resume</th>
                <th>Applied At</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($applicants as $a): ?>
                <tr>
                  <td><?= htmlspecialchars($a['name']) ?></td>
                  <td><?= htmlspecialchars($a['email']) ?></td>
                  <td><?= htmlspecialchars($a['phone']) ?></td>
                  <td>
                    <a href="../uploads/resumes/<?= urlencode($a['resume']) ?>" target="_blank" class="btn small-btn">Download</a>
                  </td>
                  <td><?= date('Y-m-d H:i', strtotime($a['applied_at'])) ?></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        <?php endforeach; ?>
      <?php else: ?>
        <p>No applicants found.</p>
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
