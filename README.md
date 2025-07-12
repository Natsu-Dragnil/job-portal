# 🧑‍💼 Job Application Portal

A web-based Job Application Portal built using PHP, MySQL, JavaScript, HTML, and CSS.

This portal allows:
- Admins to post, manage, and review job listings and applicants.
- Applicants to view job openings and apply by uploading their resumes (PDF only).

---

## 📂 File Structure

job-portal/
├── admin/
│ ├── login.php
│ ├── dashboard.php
│ ├── add_job.php
│ ├── edit_job.php
│ ├── delete_job.php
│ ├── toggle_status.php
│ ├── applicants.php
│ └── export_csv.php
│
├── public/
│ ├── index.php
│ ├── job.php
│ └── apply.php
│
├── config/
│ └── db.php
│
├── uploads/
│ └── resumes/
│
├── assets/
│ ├── css/
│ │ └── style.css
│ └── js/
│ └── main.js
│
├── sql/
│ └── job_portal.sql
│
├── .htaccess
├── index.php
└── README.md

---

## 📦 Clone or Download

git clone https://github.com/Natsu-Dragnil/job-portal.git
cd job-portal

---

## ⚙️ Setup Instructions

1. **Database**
   - Import the SQL dump: `sql/job_portal.sql` into your MySQL server
   - Default database name: `job_portal`

2. **Configuration**
   - Set your DB credentials in `config/db.php`:
     ```php
     $host = 'localhost';
     $db = 'job_portal';
     $user = 'root';
     $pass = '';
     ```

3. **Start Local Server (XAMPP/WAMP/LAMP)**
   - Place project folder in `htdocs/` or your local server directory
   - Visit: `http://localhost/job-portal/`

4. **Admin Login**
   - URL: `http://localhost/job-portal/admin/login.php`
   - Username: `admin`
   - Password: `admin123` (hardcoded for simplicity)

---

## ✅ Features Implemented

### 🔐 Admin Panel
- Admin login (basic form-based, session protected)
- Add, edit, delete job postings
- Toggle job status (Open/Closed)
- View applicants for each job
- Export applicants to CSV

### 🌍 Public Portal
- View all open job listings
- Filter jobs by location and keyword
- Detailed job view
- Apply to jobs with name, email, phone, resume (PDF only)
- Prevent duplicate applications (same email per job)
- AJAX-based application form

### 🖌️ UI Design
- Clean and responsive CSS (`assets/css/style.css`)
- Fully styled forms, tables, buttons, alerts

---

## 🔐 Security Measures

- Resume upload restricted to PDF only
- `.htaccess` prevents execution of uploaded files
- Input sanitized using prepared statements
- Directory listing disabled

---

## 📎 Known Issues / Not Yet Implemented

- ❌ Pagination
- ❌ SEO-friendly job URLs
- ❌ Email notifications
- ❌ Password-based admin users (currently hardcoded)

---

## 💡 Future Enhancements (Optional)

- Pagination for job listing and applicant views
- Admin logout and session timeout
- Friendly URLs like `/job/software-developer`
- Applicant email confirmation
- Admin panel with analytics (total jobs, applicants, etc.)

---

## 📤 Deployment

- Works on any standard LAMP/XAMPP server
- Upload entire `job-portal/` folder
- Ensure `/uploads/resumes/` is writable (`chmod 755`)

---

## 👨‍💻 Author

Built for practical experience in:
- PHP & MySQL backend logic
- File handling and validation
- Frontend interactivity with JavaScript & AJAX
- Clean modular coding structure

---