-- ----------------------------
--  DATABASE: job_portal
-- ----------------------------

CREATE DATABASE IF NOT EXISTS job_portal;
USE job_portal;

-- ----------------------------
--  TABLE: jobs
-- ----------------------------
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
);

-- ----------------------------
--  TABLE: applicants
-- ----------------------------
CREATE TABLE IF NOT EXISTS applicants (
  id INT AUTO_INCREMENT PRIMARY KEY,
  job_id INT NOT NULL,
  name VARCHAR(150) NOT NULL,
  email VARCHAR(150) NOT NULL,
  phone VARCHAR(20) NOT NULL,
  resume VARCHAR(255) NOT NULL,
  applied_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (job_id) REFERENCES jobs(id) ON DELETE CASCADE
);
