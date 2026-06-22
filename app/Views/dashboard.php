<?php ob_start(); ?>

<h1 class="page-title">
    Mini Clinic Appointment
    Management System
</h1>

<div class="card-grid">

    <div class="card">
        <h3>Patients</h3>

        <p>
            Manage patient records
        </p>

        <a href="/patients">
            View Patients
        </a>
    </div>

    <div class="card">

        <h3>Appointments</h3>

        <p>
            Manage clinic appointments
        </p>

        <a href="/appointments">
            View Appointments
        </a>

    </div>

    <div class="card">

        <h3>Health Check</h3>

        <p>
            Verify database connection
        </p>

        <a href="/health">
            Open Health Check
        </a>

    </div>

</div>

<?php

$content = ob_get_clean();

require __DIR__ . '/layout.php';