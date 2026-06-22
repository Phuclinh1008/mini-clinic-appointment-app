<?php

$pdo = new PDO(
    "mysql:host=localhost;dbname=clinic_management_db;charset=utf8mb4",
    "root",
    "admin"
);

for ($i = 1; $i <= 200; $i++) {

    $stmt = $pdo->prepare(
        "
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
            :code,
            :name,
            :email,
            :date,
            :status,
            :note
        )
        "
    );

    $stmt->execute([
        'code' => 'APT-' . str_pad($i, 4, '0', STR_PAD_LEFT),
        'name' => 'Patient ' . $i,
        'email' => "patient{$i}@gmail.com",
        'date' => date(
            'Y-m-d',
            strtotime("+{$i} days")
        ),
        'status' => [
            'Scheduled',
            'Completed',
            'Cancelled'
        ][rand(0, 2)],
        'note' => 'Auto generated'
    ]);
}

echo "Seed completed";