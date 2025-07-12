<?php
session_start();
if (!isset($_SESSION['admin'])) die("Unauthorized");

require '../config/db.php';

$id = intval($_GET['id']);
$conn->query("DELETE FROM jobs WHERE id = $id");

header("Location: dashboard.php");
exit;
