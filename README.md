# Mini Clinic Appointment DB App

A simple PHP MVC web application for managing patients and clinic appointments. This project demonstrates the use of PDO, Repository Pattern, CRUD operations, pagination, searching, sorting, validation, error handling, and logging.

---

## Features

### Patient Management

* View patient list
* Search patients
* Create patient
* Edit patient
* Delete patient
* Unique email validation

### Appointment Management

* View appointment list
* Search appointments
* Create appointment
* Edit appointment
* Delete appointment
* Unique appointment code validation

### System Features

* PDO database connection
* Repository Pattern
* MVC architecture
* Pagination
* Safe sorting (whitelist)
* Input validation
* Duplicate record handling
* Health check endpoint
* Custom 404 page
* Custom 405 page
* Custom 500 page
* Error logging

---

## Technologies Used

* PHP 8+
* MySQL 8+
* PDO
* HTML5
* CSS3
* MVC Architecture
* Repository Pattern

---

## Project Structure

```text
project-root/
│
├── app/
│   ├── Controllers/
│   │   ├── AppointmentController.php
│   │   ├── PatientController.php
│   │   ├── HealthController.php
│   │   └── HomeController.php
│   │
│   ├── Core/
│   │   ├── Database.php
│   │   ├── Router.php
│   │   ├── helpers.php
│   │   └── DuplicateRecordException.php
│   │
│   ├── Repositories/
│   │   ├── AppointmentRepository.php
│   │   └── PatientRepository.php
│   │
│   └── Views/
│       ├── appointments/
│       ├── patients/
│       └── errors/
│
├── config/
│   └── database.php
│
├── database/
│   ├── schema.sql
│   └── seed.sql
│
├── public/
│   ├── assets/
│   │   └── style.css
│   └── index.php
│
└── storage/
    └── logs/
        └── app.log
```

---

## Database Setup

### Create Database

```sql
CREATE DATABASE clinic_management_db
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;
```

### Import Schema

Execute:

```sql
SOURCE database/schema.sql;
```

### Import Sample Data

Execute:

```sql
SOURCE database/seed.sql;
```

---

## Configuration

Edit:

```php
config/database.php
```

Example:

```php
<?php

return [
    'host' => 'localhost',
    'database' => 'clinic_management_db',
    'username' => 'root',
    'password' => '',
    'charset' => 'utf8mb4'
];
```

---

## Running the Application

Start the PHP development server:

```bash
php -S localhost:8000 -t public
```

Open:

```text
http://localhost:8000
```

---

## Available Routes

### Dashboard

```text
GET /
```

### Health Check

```text
GET /health
```

### Patients

```text
GET  /patients
GET  /patients/create
POST /patients/store
GET  /patients/edit?id={id}
POST /patients/update
POST /patients/delete
```

### Appointments

```text
GET  /appointments
GET  /appointments/create
POST /appointments/store
GET  /appointments/edit?id={id}
POST /appointments/update
POST /appointments/delete
```

---

## Health Check

Endpoint:

```text
/health
```

Example response:

```json
{
  "status": "ok",
  "database": "connected",
  "application": "Mini Clinic Appointment DB App"
}
```

---

## Error Handling

### 404 Not Found

Displayed when a route does not exist.

### 405 Method Not Allowed

Displayed when an unsupported HTTP method is used.

### 500 Internal Server Error

Displayed when an unexpected exception occurs.

All application errors are logged to:

```text
storage/logs/app.log
```

---

## Security Measures

### Prepared Statements

All SQL queries use PDO prepared statements.

### Safe Sorting

Sortable columns are restricted using a whitelist.

### Duplicate Validation

* Patient email must be unique.
* Appointment code must be unique.

### Output Escaping

All user-generated output is escaped using:

```php
e()
```

to prevent XSS attacks.

---

## Sample Test Cases

### Duplicate Appointment Code

Create an appointment with:

```text
APT-2026-0001
```

Expected:

```text
Appointment code already exists.
```

### Invalid Page Number

```text
/appointments?page=-5
```

Expected:

```text
Page 1 is displayed.
```

### Invalid Sort Parameter

```text
/appointments?sort=id desc;drop table appointments
```

Expected:

```text
Application continues normally.
Database remains unchanged.
```

---

## Author

Student Project

Mini Clinic Appointment DB App

Built using PHP, MySQL, PDO, and MVC Architecture.
