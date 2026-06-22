<?php

class AppointmentController
{
    private function repository(): AppointmentRepository
    {
        $config = require __DIR__
            . '/../../config/database.php';

        $pdo = (new Database($config))
            ->getConnection();

        return new AppointmentRepository($pdo);
    }

    public function index(): void
    {
        try{
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

        $appointments =
            $repo->getPaginated(
                $q,
                $perPage,
                $offset,
                $sort,
                $direction
            );

        view(
            'appointments/index',
            [
                'appointments' => $appointments,
                'q' => $q,
                'page' => $page,
                'totalPages' => $totalPages
            ]
        );
        }
        catch (Throwable $e) {

            logError($e);

            http_response_code(500);

            view('errors/500');
        }
    }

    public function create(): void
    {
        view(
            'appointments/create',
            [
                'errors' => [],
                'old' => []
            ]
        );
    }

    public function store(): void
    {
        try{
        $data = [
            'appointment_code' =>
                trim($_POST['appointment_code'] ?? ''),

            'patient_name' =>
                trim($_POST['patient_name'] ?? ''),

            'patient_email' =>
                trim($_POST['patient_email'] ?? ''),

            'appointment_date' =>
                trim($_POST['appointment_date'] ?? ''),

            'status' =>
                $_POST['status']
                ?? 'Scheduled',

            'note' =>
                trim($_POST['note'] ?? '')
        ];

        $errors = [];

        if ($data['appointment_code'] === '') {
            $errors['appointment_code']
                = 'Appointment code is required.';
        }

        if ($data['patient_name'] === '') {
            $errors['patient_name']
                = 'Patient name is required.';
        }

        if ($data['patient_email'] === '') {
            $errors['patient_email']
                = 'Patient email is required.';
        }

        if (
            $data['patient_email'] !== ''
            && !filter_var(
                $data['patient_email'],
                FILTER_VALIDATE_EMAIL
            )
        ) {
            $errors['patient_email']
                = 'Invalid patient email.';
        }

        if ($data['appointment_date'] === '') {
            $errors['appointment_date']
                = 'Appointment date is required.';
        }

        if (!empty($errors)) {

            view(
                'appointments/create',
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
                'Appointment created successfully.'
            );

            redirect('/appointments');

        } catch (
            DuplicateRecordException $e
        ) {

            $errors['appointment_code']
                = 'Appointment code already exists.';

            view(
                'appointments/create',
                [
                    'errors' => $errors,
                    'old' => $data
                ]
            );
        }
        }
        catch (Throwable $e) {

            logError($e);

            http_response_code(500);

            view('errors/500');
        }
    }

    public function edit(): void
    {
        $id =
            (int) ($_GET['id'] ?? 0);

        $appointment =
            $this
                ->repository()
                ->findById($id);

        if (!$appointment) {

            http_response_code(404);

            view('errors/404');

            return;
        }

        view(
            'appointments/edit',
            [
                'appointment' => $appointment,
                'errors' => []
            ]
        );
    }

    public function update(): void
    {
        try{
        $id =
            (int) ($_POST['id'] ?? 0);

        $data = [
            'appointment_code' =>
                trim($_POST['appointment_code'] ?? ''),

            'patient_name' =>
                trim($_POST['patient_name'] ?? ''),

            'patient_email' =>
                trim($_POST['patient_email'] ?? ''),

            'appointment_date' =>
                trim($_POST['appointment_date'] ?? ''),

            'status' =>
                $_POST['status']
                ?? 'Scheduled',

            'note' =>
                trim($_POST['note'] ?? '')
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
                'Appointment updated successfully.'
            );

            redirect('/appointments');

        } catch (
            DuplicateRecordException $e
        ) {

            $data['id'] = $id;

            view(
                'appointments/edit',
                [
                    'appointment' => $data,
                    'errors' => [
                        'appointment_code'
                            => 'Appointment code already exists.'
                    ]
                ]
            );
        }
        
        }
        catch (Throwable $e) {

            logError($e);

            http_response_code(500);

            view('errors/500');
        }
    }

    public function delete(): void
    {
        try{
        $id =
            (int) ($_POST['id'] ?? 0);

        $this
            ->repository()
            ->delete($id);

        flash_set(
            'success',
            'Appointment deleted successfully.'
        );

        redirect('/appointments');
    }
    catch (Throwable $e) {

            logError($e);

            http_response_code(500);

            view('errors/500');
        }
    }
}