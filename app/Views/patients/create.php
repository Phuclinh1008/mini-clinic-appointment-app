<?php ob_start(); ?>

<h1>Create Patient</h1>

<form
    method="POST"
    action="/patients/store"
>

<label>Name</label>

<input
    type="text"
    name="full_name"
    value="<?= e($old['full_name'] ?? '') ?>"
>

<div class="error">
    <?= $errors['full_name'] ?? '' ?>
</div>

<label>Email</label>

<input
    type="email"
    name="email"
    value="<?= e($old['email'] ?? '') ?>"
>

<div class="error">
    <?= $errors['email'] ?? '' ?>
</div>

<label>Phone</label>

<input
    type="text"
    name="phone"
    value="<?= e($old['phone'] ?? '') ?>"
>

<div class="error">
    <?= $errors['phone'] ?? '' ?>
</div>

<label>Gender</label>

<select name="gender">

    <option value="Male">
        Male
    </option>

    <option value="Female">
        Female
    </option>

    <option value="Other">
        Other
    </option>

</select>

<br><br>

<button type="submit">
    Save Patient
</button>

</form>

<?php

$content = ob_get_clean();

require __DIR__ . '/../layout.php';