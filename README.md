# Blood Bank Management System (BBMS)

A professional, web-based management system built using Software Development Life Cycle (SDLC) principles. This project focuses on secure data handling, relational database integrity, and efficient inventory management for blood bank operations.

## 🚀 Features
- **Secure Admin Authentication:** Protected login using PHP sessions and Prepared Statements to prevent SQL injection.
- **Donor Management:** Complete CRUD (Create, Read, Update, Delete) operations with strict age and phone validation.
- **Patient Management:** Dedicated module for tracking patients requiring blood transfusions.
- **Blood Inventory System:** Real-time monitoring of 8 blood groups (A+, A-, B+, B-, O+, O-, AB+, AB-) with low-stock alerts.
- **Transaction Logic:** Automated stock updates. Adding a donation increases inventory; approving a request decreases it.
- **Audit Logs:** Permanent record of approved and rejected blood requests for accountability.

## 🛠️ Tech Stack
- **Backend:** PHP 8.x
- **Database:** MySQL
- **Environment:** XAMPP 
- **Frontend:** HTML5, CSS3 (Clean, professional UI)

## 📥 Installation & Setup
1. **Clone/Download** the repository and place the `bloodbank` folder into your `htdocs` directory (e.g., `C:/xampp/htdocs/bloodbank`).
2. **Start XAMPP:** Open XAMPP Control Panel and start **Apache** and **MySQL**.
3. **Import Database:**
   - Go to [http://localhost/phpmyadmin/](http://localhost/phpmyadmin/).
   - Create a new database named `bloodbank_db`.
   - Click the **Import** tab and select the `bloodbank_db.sql` file located in the `/database` folder of this project.
4. **Configure Connection:**
   - Open `config/db.php` and verify the database credentials (default is `root` with no password).
5. **Access the App:**
   - Open your browser and go to `http://localhost/bloodbank/admin/login.php`.

## 🔑 Admin Credentials
- **Username:** `admin`
- **Password:** `admin123`

## 📂 Project Structure
- `/admin`: Authentication and Dashboard logic.
- `/donor`: Donor registration and records.
- `/patient`: Patient registration and records.
- `/blood_donation`: Logic for increasing blood inventory.
- `/blood_request`: Workflow for approving/rejecting blood issues.
- `/blood_inventory`: Real-time stock status.
- `/config`: Centralized database connection.
- `/includes`: Reusable UI components (header/navigation).
- `/database`: Contains the SQL export file.

## 📝 Software Engineering Practices Applied
- **SDLC Model:** Structured approach from Requirement Gathering to Testing.
- **Security:** Use of Prepared Statements and Input Sanitization (`htmlspecialchars`).
- **Data Integrity:** Foreign Key constraints and Transactional Logic.
- **DRY Principle:** Modularized code using PHP `include` for headers and database config.