<?php ob_start(); ?>

<h1>Appointment Management</h1>

<form method="GET">

```
<input
    type="text"
    name="q"
    placeholder="Search appointment..."
    value="<?= e($q ?? '') ?>"
>

<button type="submit">
    Search
</button>
```

</form>

<p>

<a href="/appointments/create">
    Create Appointment
</a>

</p>

<table>

```
<tr>
    <th>ID</th>
    <th>
    <a href="?sort=appointment_code&direction=asc">
    Code ↑
    </a>

    <a href="?sort=appointment_code&direction=desc">
    ↓
    </a>

    </th>
    <th>

    <a href="?sort=patient_name&direction=asc">
    Patient ↑
    </a>

    <a href="?sort=patient_name&direction=desc">
    ↓
    </a>

    </th>
    <th>Patient Email</th>
    <th>

    <a href="?sort=appointment_date&direction=asc">
    Date ↑
    </a>

    <a href="?sort=appointment_date&direction=desc">
    ↓
    </a>

    </th>
    <th>
    <a href="?sort=status&direction=asc">
    Status ↑
    </a>

    <a href="?sort=status&direction=desc">
    ↓
    </a>

    </th>
    <th>Actions</th>
</tr>

<?php foreach ($appointments as $appointment): ?>

<tr>

    <td>
        <?= $appointment['id'] ?>
    </td>

    <td>
        <?= e($appointment['appointment_code']) ?>
    </td>

    <td>
        <?= e($appointment['patient_name']) ?>
    </td>

    <td>
        <?= e($appointment['patient_email']) ?>
    </td>

    <td>
        <?= e($appointment['appointment_date']) ?>
    </td>

    <td>
    <span class="
    status
    status-<?= strtolower(
    $appointment['status']
    ) ?>
    ">

    <?= e($appointment['status']) ?>

    </span>

    </td>

    <td>

        <a href="/appointments/edit?id=<?= $appointment['id'] ?>">
            Edit
        </a>

        <form
            method="POST"
            action="/appointments/delete"
            style="display:inline"
        >

            <input
                type="hidden"
                name="id"
                value="<?= $appointment['id'] ?>"
            >

            <button
                onclick="return confirm('Delete appointment?')"
            >
                Delete
            </button>

        </form>

    </td>

</tr>

<?php endforeach; ?>
```

</table>

<?php if (($totalPages ?? 1) > 1): ?>

<div style="margin-top:20px;">

```
<?php for ($i = 1; $i <= $totalPages; $i++): ?>

    <a
        href="?q=<?= urlencode($q ?? '') ?>&page=<?= $i ?>"
        style="
            margin-right:10px;
            <?= ($page == $i)
                ? 'font-weight:bold;'
                : '' ?>
        "
    >
        <?= $i ?>
    </a>

<?php endfor; ?>
```

</div>

<?php endif; ?>

<?php if ($totalPages > 1): ?>

<div class="pagination">

    <?php for ($i = 1; $i <= $totalPages; $i++): ?>

        <a
            href="?q=<?= urlencode($q) ?>&page=<?= $i ?>&sort=<?= $_GET['sort'] ?? 'created_at' ?>&direction=<?= $_GET['direction'] ?? 'desc' ?>"
            class="<?= $page == $i ? 'active-page' : '' ?>"
        >
            <?= $i ?>
        </a>

    <?php endfor; ?>

</div>

<?php endif; ?>

<?php $content = ob_get_clean();

require __DIR__ . '/../layout.php';
?>
