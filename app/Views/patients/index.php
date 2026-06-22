<?php ob_start(); ?>

<h1>Patient Management</h1>

<form method="GET">

    <input
        type="text"
        name="q"
        placeholder="Search patient..."
        value="<?= e($q ?? '') ?>"
    >

    <button type="submit">
        Search
    </button>

</form>

<p>

<a href="/patients/create">
    Create Patient
</a>

</p>

<table>

    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Gender</th>
        <th>Actions</th>
    </tr>

    <?php foreach ($patients as $patient): ?>

    <tr>

        <td>
            <?= $patient['id'] ?>
        </td>

        <td>
            <?= e($patient['full_name']) ?>
        </td>

        <td>
            <?= e($patient['email']) ?>
        </td>

        <td>
            <?= e($patient['phone']) ?>
        </td>

        <td>
            <?= e($patient['gender']) ?>
        </td>

        <td>

            <a href="/patients/edit?id=<?= $patient['id'] ?>">
                Edit
            </a>

            <form
                method="POST"
                action="/patients/delete"
                style="display:inline"
            >

                <input
                    type="hidden"
                    name="id"
                    value="<?= $patient['id'] ?>"
                >

                <button
                    onclick="return confirm('Delete patient?')"
                >
                    Delete
                </button>

            </form>

        </td>

    </tr>

    <?php endforeach; ?>

</table>

<?php

$content = ob_get_clean();

require __DIR__ . '/../layout.php';