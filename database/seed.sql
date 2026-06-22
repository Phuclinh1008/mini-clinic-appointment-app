USE clinic_management_db;

INSERT INTO users (name, email, password_hash, role)
VALUES
('Admin User', 'admin@clinic.com', '$2y$10$examplehashadmin', 'admin'),
('Clinic Staff', 'staff@clinic.com', '$2y$10$examplehashstaff', 'staff');

INSERT INTO patients
(full_name, email, phone, gender)
VALUES
('Nguyen Van An', 'an@gmail.com', '0901000001', 'Male'),
('Tran Thi Mai', 'mai@gmail.com', '0901000002', 'Female'),
('Le Minh Khoa', 'khoa@gmail.com', '0901000003', 'Male'),
('Pham Thu Ha', 'ha@gmail.com', '0901000004', 'Female'),
('Vo Quoc Bao', 'bao@gmail.com', '0901000005', 'Male'),
('Do Ngoc Lan', 'lan@gmail.com', '0901000006', 'Female'),
('Hoang Gia Huy', 'huy@gmail.com', '0901000007', 'Male'),
('Bui Thanh Truc', 'truc@gmail.com', '0901000008', 'Female'),
('Nguyen Tuan Kiet', 'kiet@gmail.com', '0901000009', 'Male'),
('Tran Bao Chau', 'chau@gmail.com', '0901000010', 'Female'),
('Pham Quoc Viet', 'viet@gmail.com', '0901000011', 'Male'),
('Le Kim Ngan', 'ngan@gmail.com', '0901000012', 'Female'),
('Vo Minh Tam', 'tam@gmail.com', '0901000013', 'Male'),
('Nguyen Thu Trang', 'trang@gmail.com', '0901000014', 'Female'),
('Tran Hoang Nam', 'nam@gmail.com', '0901000015', 'Male');

INSERT INTO appointments
(
appointment_code,
patient_name,
patient_email,
appointment_date,
status,
note
)
VALUES
(
'APT-2026-0001',
'Nguyen Van An',
'an@gmail.com',
'2026-06-25',
'Scheduled',
'General checkup'
),

(
'APT-2026-0002',
'Tran Thi Mai',
'mai@gmail.com',
'2026-06-26',
'Completed',
'Dental consultation'
),

(
'APT-2026-0003',
'Le Minh Khoa',
'khoa@gmail.com',
'2026-06-27',
'Cancelled',
'Patient unavailable'
),

(
'APT-2026-0004',
'Pham Thu Ha',
'ha@gmail.com',
'2026-06-28',
'Scheduled',
'Blood test'
),

(
'APT-2026-0005',
'Vo Quoc Bao',
'bao@gmail.com',
'2026-06-29',
'Completed',
'Eye examination'
),

(
'APT-2026-0006',
'Do Ngoc Lan',
'lan@gmail.com',
'2026-06-30',
'Scheduled',
'Routine health check'
),

(
'APT-2026-0007',
'Hoang Gia Huy',
'huy@gmail.com',
'2026-07-01',
'Scheduled',
'Vaccination'
),

(
'APT-2026-0008',
'Bui Thanh Truc',
'truc@gmail.com',
'2026-07-02',
'Cancelled',
'Rescheduled'
),

(
'APT-2026-0009',
'Nguyen Tuan Kiet',
'kiet@gmail.com',
'2026-07-03',
'Completed',
'ENT consultation'
),

(
'APT-2026-0010',
'Tran Bao Chau',
'chau@gmail.com',
'2026-07-04',
'Scheduled',
'Physical examination'
),

(
'APT-2026-0011',
'Pham Quoc Viet',
'viet@gmail.com',
'2026-07-05',
'Scheduled',
'Cardiology visit'
),

(
'APT-2026-0012',
'Le Kim Ngan',
'ngan@gmail.com',
'2026-07-06',
'Completed',
'Follow-up appointment'
),

(
'APT-2026-0013',
'Vo Minh Tam',
'tam@gmail.com',
'2026-07-07',
'Scheduled',
'Nutrition consultation'
),

(
'APT-2026-0014',
'Nguyen Thu Trang',
'trang@gmail.com',
'2026-07-08',
'Cancelled',
'Patient requested cancellation'
),

(
'APT-2026-0015',
'Tran Hoang Nam',
'nam@gmail.com',
'2026-07-09',
'Scheduled',
'General consultation'
);