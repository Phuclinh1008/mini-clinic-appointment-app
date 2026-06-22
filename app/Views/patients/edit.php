<?php ob_start(); ?>

<h1>Edit Patient</h1>

<form
    method="POST"
    action="/patients/update"
>

<input
    type="hidden"
    name="id"
    value="<?= $patient['id'] ?>"
>

<label>Name</label>

<input
    type="text"
    name="full_name"
    value="<?= e($patient['full_name']) ?>"
>

<label>Email</label>

<input
    type="email"
    name="email"
    value="<?= e($patient['email']) ?>"
>

<div class="error">
    <?= $errors['email'] ?? '' ?>
</div>

<label>Phone</label>

<input
    type="text"
    name="phone"
    value="<?= e($patient['phone']) ?>"
>

<label>Gender</label>

<select name="gender">

    <option
        value="Male"
        <?= $patient['gender'] === 'Male'
            ? 'selected'
            : '' ?>
    >
        Male
    </option>

    <option
        value="Female"
        <?= $patient['gender'] === 'Female'
            ? 'selected'
            : '' ?>
    >
        Female
    </option>

    <option
        value="Other"
        <?= $patient['gender'] === 'Other'
            ? 'selected'
            : '' ?>
    >
        Other
    </option>

</select>

<br><br>

<button type="submit">
    Update Patient
</button>

</form>

<?php

$content = ob_get_clean();

require __DIR__ . '/../layout.php';