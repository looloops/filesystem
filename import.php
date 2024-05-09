<?php
include_once __DIR__ . "/db.php";

$file_name = 'files/export.csv';
if ($file_handle = fopen($file_name, "r")) {
    fgetcsv($file_handle);
    while ($data = fgetcsv($file_handle)) {
        $stmt = $pdo->prepare("
            INSERT INTO users
            (nome, email, eta)
            VALUES
            (:nome, :email, :eta)"
        );
        $stmt->execute([
            'nome' => $data[1],
            'email' => $data[2] ?: null,
            'eta' => $data[3] ?: null,
        ]);
    }
    fclose($file_handle);
}