<?php

class PatientController
{
    private function repository(): PatientRepository
    {
        $config = require __DIR__
            . '/../../config/database.php';

        $pdo = (new Database($config))
            ->getConnection();

        return new PatientRepository($pdo);
    }

    public function index(): void
    {
        $q = trim($_GET['q'] ?? '');

        $page = max(
            1,
            (int) ($_GET['page'] ?? 1)
        );

        $perPage = 10;

        $sort =
            $_GET['sort']
            ?? 'created_at';

        $direction =
            $_GET['direction']
            ?? 'desc';

        $offset =
            ($page - 1)
            * $perPage;

        $repo = $this->repository();

        $total =
            $repo->countAll($q);

        $totalPages = max(
            1,
            (int) ceil(
                $total / $perPage
            )
        );

        if ($page > $totalPages) {

            $page = $totalPages;

            $offset =
                ($page - 1)
                * $perPage;
        }

        $patients =
            $repo->getPaginated(
                $q,
                $perPage,
                $offset,
                $sort,
                $direction
            );

        view(
            'patients/index',
            [
                'patients' => $patients,
                'q' => $q,
                'page' => $page,
                'totalPages' => $totalPages
            ]
        );
    }

    public function create(): void
    {
        view(
            'patients/create',
            [
                'errors' => [],
                'old' => []
            ]
        );
    }

    public function store(): void
    {
        $data = [
            'full_name' =>
                trim($_POST['full_name'] ?? ''),
            'email' =>
                trim($_POST['email'] ?? ''),
            'phone' =>
                trim($_POST['phone'] ?? ''),
            'gender' =>
                $_POST['gender']
                ?? 'Other'
        ];

        $errors = [];

        if ($data['full_name'] === '') {
            $errors['full_name']
                = 'Patient name is required.';
        }

        if ($data['email'] === '') {
            $errors['email']
                = 'Email is required.';
        }

        if (
            $data['email'] !== ''
            && !filter_var(
                $data['email'],
                FILTER_VALIDATE_EMAIL
            )
        ) {
            $errors['email']
                = 'Invalid email.';
        }

        if ($data['phone'] === '') {
            $errors['phone']
                = 'Phone is required.';
        }

        if (!empty($errors)) {

            view(
                'patients/create',
                [
                    'errors' => $errors,
                    'old' => $data
                ]
            );

            return;
        }

        try {

            $this
                ->repository()
                ->create($data);

            flash_set(
                'success',
                'Patient created successfully.'
            );

            redirect('/patients');

        } catch (
            DuplicateRecordException $e
        ) {

            $errors['email']
                = 'Email already exists.';

            view(
                'patients/create',
                [
                    'errors' => $errors,
                    'old' => $data
                ]
            );
        }
    }

    public function edit(): void
    {
        $id =
            (int) ($_GET['id'] ?? 0);

        $patient =
            $this
            ->repository()
            ->findById($id);

        if (!$patient) {

            http_response_code(404);

            view('errors/404');

            return;
        }

        view(
            'patients/edit',
            [
                'patient' => $patient,
                'errors' => []
            ]
        );
    }

    public function update(): void
    {
        $id =
            (int) ($_POST['id'] ?? 0);

        $data = [
            'full_name' =>
                trim($_POST['full_name'] ?? ''),
            'email' =>
                trim($_POST['email'] ?? ''),
            'phone' =>
                trim($_POST['phone'] ?? ''),
            'gender' =>
                $_POST['gender']
                ?? 'Other'
        ];

        try {

            $this
                ->repository()
                ->update(
                    $id,
                    $data
                );

            flash_set(
                'success',
                'Patient updated successfully.'
            );

            redirect('/patients');

        } catch (
            DuplicateRecordException $e
        ) {

            $data['id'] = $id;

            view(
                'patients/edit',
                [
                    'patient' => $data,
                    'errors' => [
                        'email' =>
                            'Email already exists.'
                    ]
                ]
            );
        }
    }

    public function delete(): void
    {
        $id =
            (int) ($_POST['id'] ?? 0);

        $this
            ->repository()
            ->delete($id);

        flash_set(
            'success',
            'Patient deleted successfully.'
        );

        redirect('/patients');
    }
}