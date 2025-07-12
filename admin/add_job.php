<?php
session_start();
if (!isset($_SESSION['admin'])) {
  header("Location: login.php");
  exit;
}

require '../config/db.php';
$success = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $title = trim($_POST['title']);
  $location = trim($_POST['location']);
  $type = trim($_POST['type']);
  $description = trim($_POST['description']);
  $skills = trim($_POST['skills']);
  $salary = trim($_POST['salary']);
  $deadline = $_POST['deadline'];

  if ($title && $location && $type && $description && $skills && $salary && $deadline) {
    $stmt = $conn->prepare("INSERT INTO jobs (title, location, type, description, skills, salary, deadline, status, created_at)
                            VALUES (?, ?, ?, ?, ?, ?, ?, 'Open', NOW())");
    $stmt->bind_param("sssssss", $title, $location, $type, $description, $skills, $salary, $deadline);
    if ($stmt->execute()) {
      $success = "Job added successfully!";
    } else {
      $error = "Something went wrong.";
    }
  } else {
    $error = "Please fill out all fields.";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Add Job - Admin</title>
  <link rel="stylesheet" href="../assets/css/style.css" />
</head>
<body>
  <header class="header">
    <div class="container header-content">
      <h1 class="site-title">Add New Job</h1>
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
      <h2>Post a New Job</h2>

      <?php if ($success): ?>
        <p class="success-msg"><?= htmlspecialchars($success) ?></p>
      <?php elseif ($error): ?>
        <p class="error-msg"><?= htmlspecialchars($error) ?></p>
      <?php endif; ?>

      <form method="post" class="job-form">
        <input type="text" name="title" placeholder="Job Title" class="form-control" required>
        <input type="text" name="location" placeholder="Location" class="form-control" required>

        <select name="type" class="form-control" required>
          <option value="">Select Job Type</option>
          <option value="Full-Time">Full-Time</option>
          <option value="Part-Time">Part-Time</option>
          <option value="Internship">Internship</option>
          <option value="Remote">Remote</option>
        </select>

        <textarea name="description" placeholder="Job Description" class="form-control" rows="5" required></textarea>
        <textarea name="skills" placeholder="Skills (comma-separated)" class="form-control" rows="2" required></textarea>

        <input type="text" name="salary" placeholder="Salary (e.g., $60,000/year)" class="form-control" required>
        <input type="date" name="deadline" class="form-control" required>

        <button type="submit" class="btn btn-primary">Add Job</button>
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
