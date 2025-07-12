<?php
session_start();
if (!isset($_SESSION['admin'])) {
  header("Location: login.php");
  exit;
}

require '../config/db.php';

// Set headers to force CSV download
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="applicants.csv"');

$output = fopen('php://output', 'w');

// Column headings
fputcsv($output, ['Job Title', 'Full Name', 'Email', 'Phone', 'Resume', 'Applied At']);

// Query applicants with job title
$query = "
  SELECT j.title AS job_title, a.name, a.email, a.phone, a.resume, a.applied_at
  FROM applicants a
  JOIN jobs j ON a.job_id = j.id
  ORDER BY j.title ASC, a.applied_at DESC
";

$result = $conn->query($query);

while ($row = $result->fetch_assoc()) {
  fputcsv($output, $row);
}

fclose($output);
exit;
