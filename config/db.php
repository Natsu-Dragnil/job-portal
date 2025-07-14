<?php
// Database credentials
$host = 'localhost';
$user = 'root';
$pass = 'natsu8900';
$dbname = 'job_portal';

// Connect to MySQL server
$conn = new mysqli($host, $user, $pass);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database if it doesn't exist
$sql = "CREATE DATABASE IF NOT EXISTS `$dbname`";
if (!$conn->query($sql)) {
    die("Database creation failed: " . $conn->error);
}

// Select the database
$conn->select_db($dbname);

// Create `jobs` table
$createJobsTable = "
CREATE TABLE IF NOT EXISTS jobs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(150) NOT NULL,
    location VARCHAR(150) NOT NULL,
    type ENUM('Full-Time', 'Part-Time', 'Internship', 'Remote') NOT NULL,
    description TEXT NOT NULL,
    skills TEXT NOT NULL,
    salary VARCHAR(100) NOT NULL,
    deadline DATE NOT NULL,
    status ENUM('Open', 'Closed') DEFAULT 'Open',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
)";
if (!$conn->query($createJobsTable)) {
    die("Jobs table creation failed: " . $conn->error);
}

// Create `applicants` table
$createApplicantsTable = "
CREATE TABLE IF NOT EXISTS applicants (
    id INT AUTO_INCREMENT PRIMARY KEY,
    job_id INT NOT NULL,
    name VARCHAR(150) NOT NULL,
    email VARCHAR(150) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    resume VARCHAR(255) NOT NULL,
    applied_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (job_id) REFERENCES jobs(id) ON DELETE CASCADE
)";
if (!$conn->query($createApplicantsTable)) {
    die("Applicants table creation failed: " . $conn->error);
}
?>
