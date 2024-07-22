<?php
require_once 'models/database.php'; 

header('Content-Type: application/json');

try {
    $stmt = $pdo->query("SELECT patient_id as patientId, first_name as firstName, last_name as lastName, email, phone, home_address as homeAddress, date_of_birth as dateOfBirth, blood_type as bloodType, medicine FROM users");
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($users);

} catch (PDOException $e) {
    http_response_code(500); // Internal Server Error
    echo json_encode(['error' => $e->getMessage()]);
}

