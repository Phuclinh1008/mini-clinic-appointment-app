<?php

class HealthController
{
    private function db(): PDO
    {
        $config = require __DIR__
            . '/../../config/database.php';

        return (new Database($config))
            ->getConnection();
    }

    public function index(): void
    {
        header('Content-Type: application/json');

        try {

            $this->db();

            echo json_encode([
                'status' => 'ok',
                'database' => 'connected',
                'application' =>
                    'Mini Clinic Appointment DB App',
                'timestamp' =>
                    date('Y-m-d H:i:s')
            ]);

        } catch (Exception $e) {

    echo json_encode([
        'status' => 'error',
        'message' => $e->getMessage()
    ]);
}
    }
}