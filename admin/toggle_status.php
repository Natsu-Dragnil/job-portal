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

$job_id = (int) $_GET['id'];

// Fetch current status
$stmt = $conn->prepare("SELECT status FROM jobs WHERE id = ?");
$stmt->bind_param("i", $job_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
  $job = $result->fetch_assoc();
  $new_status = ($job['status'] === 'Open') ? 'Closed' : 'Open';

  // Update status
  $update = $conn->prepare("UPDATE jobs SET status = ? WHERE id = ?");
  $update->bind_param("si", $new_status, $job_id);
  $update->execute();
}

header("Location: dashboard.php");
exit;
