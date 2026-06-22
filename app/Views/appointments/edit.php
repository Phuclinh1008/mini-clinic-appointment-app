<?php ob_start(); ?>

<h1>Edit Appointment</h1>

<form
    method="POST"
    action="/appointments/update"
>

<input
type="hidden"
name="id"
value="<?= $appointment['id'] ?>"

>

<label>Appointment Code</label>

<input
type="text"
name="appointment_code"
value="<?= e($appointment['appointment_code']) ?>"

>

<div class="error">
    <?= $errors['appointment_code'] ?? '' ?>
</div>

<label>Patient Name</label>

<input
type="text"
name="patient_name"
value="<?= e($appointment['patient_name']) ?>"

>

<label>Patient Email</label>

<input
type="email"
name="patient_email"
value="<?= e($appointment['patient_email']) ?>"

>

<label>Appointment Date</label>

<input
type="date"
name="appointment_date"
value="<?= e($appointment['appointment_date']) ?>"

>

<label>Status</label>

<select name="status">

```
<option
    value="Scheduled"
    <?= $appointment['status'] === 'Scheduled'
        ? 'selected'
        : '' ?>
>
    Scheduled
</option>

<option
    value="Completed"
    <?= $appointment['status'] === 'Completed'
        ? 'selected'
        : '' ?>
>
    Completed
</option>

<option
    value="Cancelled"
    <?= $appointment['status'] === 'Cancelled'
        ? 'selected'
        : '' ?>
>
    Cancelled
</option>
```

</select>

<label>Note</label>

<textarea
    name="note"
    rows="4"
><?= e($appointment['note'] ?? '') ?></textarea>

<br><br>

<button type="submit">
    Update Appointment
</button>

</form>

<?php

$content = ob_get_clean();

require __DIR__ . '/../layout.php';
?>
