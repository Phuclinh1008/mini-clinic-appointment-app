CREATE DATABASE clinic_management_db
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE clinic_management_db;
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(150) UNIQUE NOT NULL,
    password_hash VARCHAR(255) NOT NULL,
    role ENUM('admin','staff') DEFAULT 'staff',
    status ENUM('active','inactive') DEFAULT 'active',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP
);
CREATE TABLE patients (
    id INT AUTO_INCREMENT PRIMARY KEY,

    full_name VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL,
    phone VARCHAR(30) NOT NULL,

    gender ENUM(
        'Male',
        'Female',
        'Other'
    ) DEFAULT 'Other',

    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,

    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP,

    UNIQUE KEY unique_patient_email(email),

    INDEX idx_patient_phone(phone),
    INDEX idx_patient_created(created_at),
    INDEX idx_patient_gender_created(gender,created_at)
);
CREATE TABLE appointments (
    id INT AUTO_INCREMENT PRIMARY KEY,

    appointment_code VARCHAR(30) NOT NULL,

    patient_name VARCHAR(100) NOT NULL,

    patient_email VARCHAR(150) NOT NULL,

    appointment_date DATE NOT NULL,

    status ENUM(
        'Scheduled',
        'Completed',
        'Cancelled'
    ) DEFAULT 'Scheduled',

    note TEXT,

    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,

    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP,

    UNIQUE KEY unique_appointment_code
        (appointment_code),

    INDEX idx_appointment_date
        (appointment_date),

    INDEX idx_appointment_status_date
        (status,appointment_date),

    INDEX idx_appointment_email
        (patient_email)
);