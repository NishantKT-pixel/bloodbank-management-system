-- Blood Bank Management System Database Export
-- Database: bloodbank_db

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- --------------------------------------------------------

-- Table structure for table `admin`
CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `fullname` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL UNIQUE,
  `password` varchar(255) NOT NULL,
  `contact` varchar(15) NOT NULL UNIQUE,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `admin` (`fullname`, `username`, `password`, `contact`) VALUES
('System Admin', 'admin', 'admin123', '1234567890');

-- Table structure for table `donor`
CREATE TABLE `donor` (
  `donor_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `age` int(11) NOT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `blood_group` varchar(5) NOT NULL,
  `phone` varchar(15) NOT NULL UNIQUE,
  `address` text DEFAULT NULL,
  PRIMARY KEY (`donor_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Table structure for table `patient`
CREATE TABLE `patient` (
  `patient_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `age` int(11) NOT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `blood_group` varchar(5) NOT NULL,
  `phone` varchar(15) NOT NULL UNIQUE,
  `address` text DEFAULT NULL,
  PRIMARY KEY (`patient_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Table structure for table `blood_inventory`
CREATE TABLE `blood_inventory` (
  `inventory_id` int(11) NOT NULL AUTO_INCREMENT,
  `blood_group` varchar(5) NOT NULL UNIQUE,
  `units_available` int(11) DEFAULT 0,
  PRIMARY KEY (`inventory_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `blood_inventory` (`blood_group`, `units_available`) VALUES
('A+', 0), ('A-', 0), ('B+', 0), ('B-', 0),
('O+', 0), ('O-', 0), ('AB+', 0), ('AB-', 0);

-- Table structure for table `blood_donation`
CREATE TABLE `blood_donation` (
  `donation_id` int(11) NOT NULL AUTO_INCREMENT,
  `donor_id` int(11) NOT NULL,
  `blood_group` varchar(5) NOT NULL,
  `donation_date` date DEFAULT current_timestamp(),
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`donation_id`),
  FOREIGN KEY (`donor_id`) REFERENCES `donor` (`donor_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Table structure for table `blood_request`
CREATE TABLE `blood_request` (
  `request_id` int(11) NOT NULL AUTO_INCREMENT,
  `patient_id` int(11) NOT NULL,
  `blood_group` varchar(5) NOT NULL,
  `request_date` date DEFAULT current_timestamp(),
  `quantity` int(11) NOT NULL,
  `status` varchar(20) DEFAULT 'Pending',
  PRIMARY KEY (`request_id`),
  FOREIGN KEY (`patient_id`) REFERENCES `patient` (`patient_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

COMMIT;