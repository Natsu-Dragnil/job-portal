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

-- ----------------------------
--  SAMPLE: jobs
-- ----------------------------

INSERT INTO jobs (title, location, type, description, skills, salary, deadline)
VALUES
('Software Engineer', 'Bangalore', 'Full-Time', 'Develop and maintain web applications.', 'JavaScript, Node.js, React', '₹10,00,000', '2025-08-15'),
('Data Analyst', 'Mumbai', 'Full-Time', 'Analyze data to aid business decisions.', 'SQL, Excel, Python', '₹8,00,000', '2025-08-10'),
('UI/UX Designer', 'Remote', 'Remote', 'Design user-friendly interfaces.', 'Figma, Adobe XD, HTML/CSS', '₹7,50,000', '2025-08-20'),
('Digital Marketing Intern', 'Delhi', 'Internship', 'Assist with SEO and campaigns.', 'SEO, Google Analytics, Social Media', '₹15,000', '2025-08-01'),
('Backend Developer', 'Hyderabad', 'Full-Time', 'Build and optimize APIs and server-side logic.', 'PHP, MySQL, Laravel', '₹9,00,000', '2025-09-01'),
('Product Manager', 'Pune', 'Full-Time', 'Oversee product development lifecycle.', 'Agile, Scrum, Communication', '₹15,00,000', '2025-08-25'),
('Technical Writer', 'Remote', 'Remote', 'Create clear documentation.', 'Markdown, Git, Writing Skills', '₹6,00,000', '2025-07-31'),
('HR Executive', 'Chennai', 'Full-Time', 'Manage hiring and employee relations.', 'HRMS, Communication, MS Office', '₹5,50,000', '2025-08-05'),
('QA Engineer', 'Bangalore', 'Full-Time', 'Ensure software quality and reliability.', 'Selenium, JIRA, Test Cases', '₹7,80,000', '2025-08-30'),
('Front-End Developer', 'Remote', 'Remote', 'Build responsive web interfaces.', 'HTML, CSS, JavaScript, Vue.js', '₹8,20,000', '2025-09-10'),
('Mobile App Developer', 'Mumbai', 'Full-Time', 'Develop cross-platform mobile apps.', 'Flutter, Dart, Firebase', '₹9,50,000', '2025-08-18'),
('Cloud Engineer', 'Delhi', 'Full-Time', 'Manage cloud infrastructure.', 'AWS, Docker, Kubernetes', '₹12,00,000', '2025-09-05'),
('Business Analyst', 'Pune', 'Full-Time', 'Bridge between business needs and tech.', 'Excel, SQL, Stakeholder Mgmt', '₹8,50,000', '2025-08-22'),
('Content Creator', 'Remote', 'Part-Time', 'Create engaging blog and video content.', 'Video Editing, Blogging, SEO', '₹25,000', '2025-08-08'),
('DevOps Engineer', 'Hyderabad', 'Full-Time', 'CI/CD and system automation.', 'Jenkins, Git, Docker', '₹11,00,000', '2025-09-12'),
('System Administrator', 'Chennai', 'Full-Time', 'Maintain IT systems.', 'Linux, Shell Scripting, Networking', '₹6,20,000', '2025-08-28'),
('Game Developer', 'Bangalore', 'Full-Time', 'Build 2D and 3D games.', 'Unity, C#, Game Design', '₹10,50,000', '2025-08-12'),
('Graphic Designer', 'Remote', 'Part-Time', 'Design marketing and UI graphics.', 'Photoshop, Illustrator, Canva', '₹30,000', '2025-08-03'),
('AI Research Intern', 'Remote', 'Internship', 'Work on AI models and papers.', 'Python, PyTorch, ML Algorithms', '₹20,000', '2025-08-11'),
('Sales Executive', 'Mumbai', 'Full-Time', 'Manage client acquisition.', 'CRM, Communication, Sales', '₹6,00,000', '2025-09-02'),
('SEO Specialist', 'Delhi', 'Full-Time', 'Optimize content for search engines.', 'On-page, Off-page, Tools', '₹6,50,000', '2025-08-17'),
('Cybersecurity Analyst', 'Bangalore', 'Full-Time', 'Protect systems from threats.', 'Network Security, Tools, Auditing', '₹11,50,000', '2025-08-29'),
('Tech Support', 'Chennai', 'Full-Time', 'Assist users with technical issues.', 'Troubleshooting, Windows, Communication', '₹4,80,000', '2025-08-06'),
('Research Assistant', 'Remote', 'Internship', 'Assist with academic or product research.', 'Data Collection, Research Tools', '₹18,000', '2025-08-09'),
('Logistics Coordinator', 'Hyderabad', 'Full-Time', 'Manage logistics and shipments.', 'Supply Chain, Coordination, Excel', '₹5,70,000', '2025-08-14');

-- ----------------------------
--  SAMPLE: applicants
-- ----------------------------

INSERT INTO applicants (job_id, name, email, phone, resume, applied_at) VALUES
-- Job ID 1
(1, 'Amit Sharma', 'amit.sharma@example.com', '9876543210', 'resumes/amit.pdf', '2025-07-10 10:00:00'),
(1, 'Priya Verma', 'priya.verma@example.com', '9876543211', 'resumes/priya.pdf', '2025-07-11 11:30:00'),
(1, 'Rahul Das', 'rahul.das@example.com', '9876543212', 'resumes/rahul.pdf', '2025-07-12 09:45:00'),

-- Job ID 2
(2, 'Sana Iqbal', 'sana.iqbal@example.com', '9123456780', 'resumes/sana.pdf', '2025-07-08 13:20:00'),
(2, 'Vinay Mehta', 'vinay.mehta@example.com', '9123456781', 'resumes/vinay.pdf', '2025-07-09 10:10:00'),
(2, 'Karan Patel', 'karan.patel@example.com', '9123456782', 'resumes/karan.pdf', '2025-07-10 17:30:00'),
(2, 'Ritu Sen', 'ritu.sen@example.com', '9123456783', 'resumes/ritu.pdf', '2025-07-10 14:00:00'),

-- Job ID 3
(3, 'Anjali Rao', 'anjali.rao@example.com', '9012345670', 'resumes/anjali.pdf', '2025-07-06 09:30:00'),
(3, 'Mehul Shah', 'mehul.shah@example.com', '9012345671', 'resumes/mehul.pdf', '2025-07-07 10:45:00'),
(3, 'Sneha Kapoor', 'sneha.kapoor@example.com', '9012345672', 'resumes/sneha.pdf', '2025-07-08 11:15:00'),

-- Job ID 4
(4, 'Tanya Singh', 'tanya.singh@example.com', '9988776655', 'resumes/tanya.pdf', '2025-07-05 08:00:00'),
(4, 'Arjun Khanna', 'arjun.khanna@example.com', '9988776656', 'resumes/arjun.pdf', '2025-07-06 09:00:00'),
(4, 'Neha Jain', 'neha.jain@example.com', '9988776657', 'resumes/neha.pdf', '2025-07-07 10:30:00'),

-- Job ID 5
(5, 'Dev Mishra', 'dev.mishra@example.com', '9876012345', 'resumes/dev.pdf', '2025-07-11 16:00:00'),
(5, 'Rina Bhatt', 'rina.bhatt@example.com', '9876012346', 'resumes/rina.pdf', '2025-07-12 12:45:00'),
(5, 'Siddharth Malhotra', 'sid.malhotra@example.com', '9876012347', 'resumes/sid.pdf', '2025-07-13 09:20:00'),

(6, 'Aditya Rao', 'aditya.rao@example.com', '9800000001', 'resumes/a1.pdf', '2025-07-10 12:00:00'),
(6, 'Kriti Bansal', 'kriti.bansal@example.com', '9800000002', 'resumes/a2.pdf', '2025-07-11 13:00:00'),
(7, 'Nikhil Joshi', 'nikhil.joshi@example.com', '9800000003', 'resumes/a3.pdf', '2025-07-08 14:30:00'),
(7, 'Meera Pillai', 'meera.pillai@example.com', '9800000004', 'resumes/a4.pdf', '2025-07-09 10:00:00'),
(7, 'Sourav Mukherjee', 'sourav.m@example.com', '9800000005', 'resumes/a5.pdf', '2025-07-10 11:15:00'),
(8, 'Tanvi Agarwal', 'tanvi.a@example.com', '9800000006', 'resumes/a6.pdf', '2025-07-12 13:30:00'),
(9, 'Gaurav Sinha', 'gaurav.sinha@example.com', '9800000007', 'resumes/a7.pdf', '2025-07-13 10:10:00'),
(9, 'Ayesha Farooq', 'ayesha.farooq@example.com', '9800000008', 'resumes/a8.pdf', '2025-07-14 12:20:00'),
(10, 'Rajiv Nair', 'rajiv.nair@example.com', '9800000009', 'resumes/a9.pdf', '2025-07-13 16:00:00'),
(10, 'Divya Shetty', 'divya.shetty@example.com', '9800000010', 'resumes/a10.pdf', '2025-07-13 17:00:00'),
(11, 'Varun Thakur', 'varun.thakur@example.com', '9800000011', 'resumes/a11.pdf', '2025-07-13 18:00:00'),
(11, 'Chitra Anand', 'chitra.anand@example.com', '9800000012', 'resumes/a12.pdf', '2025-07-13 19:00:00'),
(12, 'Sanjay Bhatia', 'sanjay.b@example.com', '9800000013', 'resumes/a13.pdf', '2025-07-13 20:00:00'),
(13, 'Ekta Rathi', 'ekta.rathi@example.com', '9800000014', 'resumes/a14.pdf', '2025-07-13 21:00:00'),
(14, 'Imran Shaikh', 'imran.shaikh@example.com', '9800000015', 'resumes/a15.pdf', '2025-07-14 08:00:00'),
(15, 'Kavya Nanda', 'kavya.nanda@example.com', '9800000016', 'resumes/a16.pdf', '2025-07-14 09:00:00'),
(16, 'Aarav Jain', 'aarav.jain@example.com', '9800000017', 'resumes/a17.pdf', '2025-07-14 10:00:00'),
(17, 'Nisha Rao', 'nisha.rao@example.com', '9800000018', 'resumes/a18.pdf', '2025-07-14 11:00:00'),
(18, 'Kabir Saxena', 'kabir.saxena@example.com', '9800000019', 'resumes/a19.pdf', '2025-07-14 12:00:00'),
(19, 'Zoya Khan', 'zoya.khan@example.com', '9800000020', 'resumes/a20.pdf', '2025-07-14 13:00:00'),
(20, 'Harshita Goyal', 'harshita.goyal@example.com', '9800000021', 'resumes/a21.pdf', '2025-07-14 14:00:00'),
(21, 'Nitin Rawat', 'nitin.rawat@example.com', '9800000022', 'resumes/a22.pdf', '2025-07-14 15:00:00'),
(22, 'Isha Mehta', 'isha.mehta@example.com', '9800000023', 'resumes/a23.pdf', '2025-07-14 16:00:00'),
(23, 'Deepak Kaul', 'deepak.kaul@example.com', '9800000024', 'resumes/a24.pdf', '2025-07-14 17:00:00'),
(24, 'Nargis Jahan', 'nargis.jahan@example.com', '9800000025', 'resumes/a25.pdf', '2025-07-14 18:00:00'),
(25, 'Rehan Ali', 'rehan.ali@example.com', '9800000026', 'resumes/a26.pdf', '2025-07-14 19:00:00');
