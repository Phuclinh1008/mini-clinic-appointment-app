<?php ob_start(); ?>

<h1>Create Appointment</h1>

<form
    method="POST"
    action="/appointments/store"
>

<label>Appointment Code</label>

<input
type="text"
name="appointment_code"
value="<?= e($old['appointment_code'] ?? '') ?>"

>

<div class="error">
    <?= $errors['appointment_code'] ?? '' ?>
</div>

<label>Patient Name</label>

<input
type="text"
name="patient_name"
value="<?= e($old['patient_name'] ?? '') ?>"

>

<div class="error">
    <?= $errors['patient_name'] ?? '' ?>
</div>

<label>Patient Email</label>

<input
type="email"
name="patient_email"
value="<?= e($old['patient_email'] ?? '') ?>"

>

<div class="error">
    <?= $errors['patient_email'] ?? '' ?>
</div>

<label>Appointment Date</label>

<input
type="date"
name="appointment_date"
value="<?= e($old['appointment_date'] ?? '') ?>"

>

<div class="error">
    <?= $errors['appointment_date'] ?? '' ?>
</div>

<label>Status</label>

<select name="status">

```
<option value="Scheduled">
    Scheduled
</option>

<option value="Completed">
    Completed
</option>

<option value="Cancelled">
    Cancelled
</option>
```

</select>

<label>Note</label>

<textarea
    name="note"
    rows="4"
><?= e($old['note'] ?? '') ?></textarea>

<br><br>

<button type="submit">
    Save Appointment
</button>

</form>

<?php

$content = ob_get_clean();

require __DIR__ . '/../layout.php';
?>
