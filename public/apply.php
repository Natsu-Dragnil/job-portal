<?php
require '../config/db.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
  die("Invalid job ID.");
}

$job_id = (int) $_GET['id'];
$job = $conn->query("SELECT * FROM jobs WHERE id = $job_id AND status = 'Open'")->fetch_assoc();

if (!$job) {
  die("Job not found or closed.");
}

$success = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = trim($_POST['name']);
  $email = trim($_POST['email']);
  $phone = trim($_POST['phone']);
  $resume = $_FILES['resume'];

  if ($name && $email && $phone && $resume['size'] > 0) {
    $ext = strtolower(pathinfo($resume['name'], PATHINFO_EXTENSION));
    if ($ext === 'pdf') {
      $new_name = time() . "_" . basename($resume['name']);
      $upload_path = "../uploads/resumes/" . $new_name;

      if (move_uploaded_file($resume['tmp_name'], $upload_path)) {
        $stmt = $conn->prepare("INSERT INTO applicants (job_id, name, email, phone, resume, applied_at)
                                VALUES (?, ?, ?, ?, ?, NOW())");
        $stmt->bind_param("issss", $job_id, $name, $email, $phone, $new_name);
        if ($stmt->execute()) {
          $success = "Application submitted successfully!";
        } else {
          $error = "Database error.";
        }
      } else {
        $error = "Failed to upload resume.";
      }
    } else {
      $error = "Only PDF files are allowed.";
    }
  } else {
    $error = "Please complete all fields.";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Apply - <?= htmlspecialchars($job['title']) ?></title>
  <link rel="stylesheet" href="../assets/css/style.css" />
</head>
<body>
  <header class="header">
    <div class="container header-content">
      <h1 class="site-title">Apply for <?= htmlspecialchars($job['title']) ?></h1>
      <nav class="nav">
        <ul class="nav-menu">
          <li><a href="index.php">Browse Jobs</a></li>
        </ul>
      </nav>
    </div>
  </header>

  <section class="form-section">
    <div class="container">
      <h2>Apply Now</h2>

      <?php if ($success): ?>
        <p class="success-msg"><?= $success ?></p>
      <?php elseif ($error): ?>
        <p class="error-msg"><?= $error ?></p>
      <?php endif; ?>

      <form method="post" enctype="multipart/form-data" class="job-form">
        <input type="text" name="name" placeholder="Full Name" class="form-control" required />
        <input type="email" name="email" placeholder="Email" class="form-control" required />
        <input type="text" name="phone" placeholder="Phone Number" class="form-control" required />
        <input type="file" name="resume" accept=".pdf" class="form-control" required />
        <button type="submit" class="btn btn-primary">Submit Application</button>
      </form>
    </div>
  </section>

  <footer class="footer">
    <div class="container">
      <p>&copy; <?= date('Y') ?> Job Application Portal. All rights reserved.</p>
    </div>
  </footer>
</body>
</html>
