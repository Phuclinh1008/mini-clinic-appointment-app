<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">

    <title>
        Mini Clinic Appointment App
    </title>

    <link rel="stylesheet"
          href="/assets/style.css">
</head>

<body>

<nav class="navbar">

    <div class="menu">

        <a href="/">
        Dashboard
        </a>

        <a href="/patients">
        Patients
        </a>

        <a href="/patients/create">
        Add Patient
        </a>

        <a href="/appointments">
        Appointments
        </a>

        <a href="/appointments/create">
        Add Appointment
        </a>

        <a href="/health">
        Health
        </a>

    </div>

</nav>

<div class="container">

    <?php
    if ($message = flash_get('success')):
    ?>

        <div class="success">
            <?= e($message) ?>
        </div>

    <?php endif; ?>

    <?= $content ?>

</div>

</body>
</html>