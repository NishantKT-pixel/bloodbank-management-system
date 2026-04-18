Blood Bank Management System Folder Structure:
bloodbank/old folder structure
│
├── config/
│   └── config.php
│
├── admin/
│   ├── login.php
│   ├── dashboard.php
│   └── logout.php
│
├── donor/
│   ├── add_donor.php
│   ├── view_donor.php
│   └── delete_donor.php
│
├── patient/
│   ├── add_patient.php
│   └── view_patient.php
│
|__blood_inventory/
|   |__
|
|
├── assets/
│   ├── css/
│   ├── js/
│   └── images/
│
├── index.php
└── README.md


New Folder structure
bloodbank/
│
├── config/
│   └── config.php                    # Database connection
│
├── admin/
│   ├── login.php
│   ├── dashboard.php
│   ├── logout.php
│   └── session_check.php            # NEW: Session verification
│
├── donor/
│   ├── add_donor.php
│   ├── view_donor.php
│   ├── edit_donor.php               # NEW
│   ├── delete_donor.php
│   └── search_donor.php             # NEW
│
├── patient/
│   ├── add_patient.php
│   ├── view_patient.php
│   ├── edit_patient.php             # NEW
│   └── delete_patient.php
│
├── blood_donation/
│   ├── add_donation.php
│   ├── view_donation.php
│   └── donation_history.php         # NEW
│
├── blood_request/
│   ├── add_request.php
│   ├── view_request.php
│   ├── approve_request.php
│   └── reject_request.php
│
├── blood_inventory/
│   ├── view_inventory.php
│   ├── low_stock_alerts.php         # NEW
│   └── inventory_report.php         # NEW
│
├── helpers/                          # NEW FOLDER
│   ├── validation.php
│   ├── auth.php
│   ├── database.php
│   └── error_handler.php
│
├── templates/                        # NEW FOLDER
│   ├── navbar.php
│   ├── header.php
│   ├── footer.php
│   └── messages.php                 # For success/error display
│
├── css/                              # NEW FOLDER (if using)
│   └── style.css
│
├── database/                         # NEW FOLDER
│   ├── schema.sql                   # CREATE TABLE statements
│   ├── sample_data.sql              # Sample data for testing
│   └── backup.sql                   # For backups
│
├── tests/                            # NEW FOLDER
│   ├── test_cases.md
│   ├── test_data.sql
│   └── test_results.txt
│
├── docs/                             # NEW FOLDER
│   ├── DEPLOYMENT.md
│   ├── TROUBLESHOOTING.md
│   ├── API_DOCUMENTATION.md
│   └── ARCHITECTURE.md
│
├── .gitignore                        # NEW: For version control
├── README.md                         # Updated
└── index.php

Database Query Format:
1. Admin
  CREATE TABLE admin (
  admin_id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100),
username VARCHAR(50),
password VARCHAR(100),
contact VARCHAR(15)
);

2. Donor
CREATE TABLE donor (
donor_id INT AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(100),
age INT,
gender VARCHAR(10),
blood_group VARCHAR(5),
phone VARCHAR(15),
address TEXT
);

3. Patient
CREATE TABLE patient (
patient_id INT AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(100),
age INT,
gender VARCHAR(10),
blood_group VARCHAR(5),
phone VARCHAR(15),
address TEXT
);

4. blood inventory
CREATE TABLE blood_inventory (
inventory_id INT AUTO_INCREMENT PRIMARY KEY,
blood_group VARCHAR(5),
units_available INT,
expiry_date DATE
);

5. blood donotion
CREATE TABLE blood_donation (
donation_id INT AUTO_INCREMENT PRIMARY KEY,
donor_id INT,
blood_group VARCHAR(5),
donation_date DATE,
quantity INT
);

6.  blood request
CREATE TABLE blood_request (
request_id INT AUTO_INCREMENT PRIMARY KEY,
patient_id INT,
blood_group VARCHAR(5),
request_date DATE,
quantity INT,
status VARCHAR(20) DEFAULT 'Pending'
);

Admin (Blood Bank Staff)
The admin performs everything:
Login to system
Add / update / delete donors
Add / update patients
Monitor blood inventory
Process blood requests
Issue blood

Admin
 ├── Manage Donors
 ├── Manage Patients
 ├── Manage Blood Inventory
 ├── Process Blood Requests
 └── Record Blood Donations

 Improvement
 1.Added dropdown in add_donation.
 2.Added Navigation Bar(For better user experience).