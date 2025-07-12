<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_POST['username'] === 'admin' && $_POST['password'] === 'admin123') {
        $_SESSION['admin'] = true;
        header('Location: dashboard.php');
        exit;
    } else {
        $error = "Invalid credentials!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Admin Login</title>
  <link rel="stylesheet" href="../assets/css/style.css"/>
</head>
<body>
  <section class="login-section">
    <div class="login-panel">
      <h2>Admin Login</h2>

      <?php if (!empty($error)): ?>
        <p class="error-msg"><?= htmlspecialchars($error) ?></p>
      <?php endif; ?>

      <form method="post" class="login-form">
        <input type="text" name="username" placeholder="Username" required class="form-control" />
        <input type="password" name="password" placeholder="Password" required class="form-control" />
        <button type="submit" class="btn btn-primary">Login</button>
      </form>

      <a href="../index.php" class="back-link">← Back to Home</a>
    </div>
  </section>
</body>
</html>
