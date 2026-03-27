Blood Bank Management System Folder Structure:
bloodbank/
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