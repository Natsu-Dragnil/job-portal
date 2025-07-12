<?php
session_start();
if (!isset($_SESSION['admin'])) {
  header("Location: login.php");
  exit;
}

require '../config/db.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
  die("Invalid job ID.");
}

$job_id = (int)$_GET['id'];
$job = $conn->query("SELECT * FROM jobs WHERE id = $job_id")->fetch_assoc();
if (!$job) {
  die("Job not found.");
}

$success = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $title = trim($_POST['title']);
  $location = trim($_POST['location']);
  $type = trim($_POST['type']);
  $status = trim($_POST['status']);
  $description = trim($_POST['description']);
  $skills = trim($_POST['skills']);
  $salary = trim($_POST['salary']);
  $deadline = $_POST['deadline'];

  if ($title && $location && $type && $status && $description && $skills && $salary && $deadline) {
    $stmt = $conn->prepare("UPDATE jobs SET title=?, location=?, type=?, status=?, description=?, skills=?, salary=?, deadline=? WHERE id=?");
    $stmt->bind_param("ssssssssi", $title, $location, $type, $status, $description, $skills, $salary, $deadline, $job_id);
    if ($stmt->execute()) {
      $success = "Job updated successfully.";
      $job = array_merge($job, $_POST); // update local view
    } else {
      $error = "Failed to update job.";
    }
  } else {
    $error = "Please fill in all required fields.";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Edit Job - Admin</title>
  <link rel="stylesheet" href="../assets/css/style.css"/>
</head>
<body>
  <header class="header">
    <div class="container header-content">
      <h1 class="site-title">Edit Job</h1>
      <nav class="nav">
        <ul class="nav-menu">
          <li><a href="dashboard.php">Dashboard</a></li>
          <li><a href="logout.php">Logout</a></li>
        </ul>
      </nav>
    </div>
  </header>

  <section class="form-section">
    <div class="container">
      <h2>Edit Job Posting</h2>

      <?php if ($success): ?>
        <p class="success-msg"><?= htmlspecialchars($success) ?></p>
      <?php elseif ($error): ?>
        <p class="error-msg"><?= htmlspecialchars($error) ?></p>
      <?php endif; ?>

      <form method="post" class="job-form">
        <input type="text" name="title" placeholder="Job Title" class="form-control" required value="<?= htmlspecialchars($job['title']) ?>">
        <input type="text" name="location" placeholder="Location" class="form-control" required value="<?= htmlspecialchars($job['location']) ?>">

        <select name="type" class="form-control" required>
          <option value="">Select Job Type</option>
          <?php foreach (['Full-Time', 'Part-Time', 'Internship', 'Remote'] as $type): ?>
            <option value="<?= $type ?>" <?= $job['type'] === $type ? 'selected' : '' ?>><?= $type ?></option>
          <?php endforeach; ?>
        </select>

        <select name="status" class="form-control" required>
          <option value="Open" <?= $job['status'] === 'Open' ? 'selected' : '' ?>>Open</option>
          <option value="Closed" <?= $job['status'] === 'Closed' ? 'selected' : '' ?>>Closed</option>
        </select>

        <textarea name="description" placeholder="Job Description" class="form-control" rows="5" required><?= htmlspecialchars($job['description']) ?></textarea>
        <textarea name="skills" placeholder="Skills (comma-separated)" class="form-control" rows="2" required><?= htmlspecialchars($job['skills']) ?></textarea>
        <input type="text" name="salary" placeholder="Salary" class="form-control" required value="<?= htmlspecialchars($job['salary']) ?>">
        <input type="date" name="deadline" class="form-control" required value="<?= htmlspecialchars($job['deadline']) ?>">

        <button type="submit" class="btn btn-primary">Update Job</button>
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
