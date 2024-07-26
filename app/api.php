<?php
require_once 'models/db.php'; 
require_once 'models/user.php';

header('Content-Type: application/json');

$action = $_REQUEST['action'] ?? null;

try {
    switch ($action) {
        case "addUser":
            // Expecting POST requests to add a new user
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $user = new User(
                    $pdo,
                    $_POST['firstName'],
                    $_POST['lastName'],
                    $_POST['email'],
                    $_POST['phone'],
                    $_POST['patientId'],
                    $_POST['homeAddress'],
                    $_POST['dob'],
                    $_POST['medicine'],
                    $_POST['bloodType']
                );
                $user->save();  // Save the new user to the database
                echo json_encode(['status' => 'success', 'message' => 'User added']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
            }
            break;

        case 'getAllUsers':
            if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                $stmt = $pdo->query("SELECT patient_id as patientId, first_name as firstName, last_name as lastName, email, phone, home_address as homeAddress, dob as dateOfBirth, blood_type as bloodType, medicine FROM public.patient");
                $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
                echo json_encode($users);
            }

        case "getUser":
            // Expecting GET requests to retrieve a user by patientId
            if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['patientId'])) {
                $user = User::findByPatientId($pdo, $_GET['patientId']);
                echo json_encode($user ? [
                    'patientId' => $user->getPatientId(),
                    'firstName' => $user->getFirstName(),
                    'lastName' => $user->getLastName(),
                    'email' => $user->getEmail(),
                    'phone' => $user->getPhone(),
                    'homeAddress' => $user->getHomeAddress(),
                    'dob' => $user->getdob(),
                    'medicine' => $user->getMedicine(),
                    'bloodType' => $user->getBloodType()
                ] : ['status' => 'error', 'message' => 'User not found']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Invalid request method or missing parameters']);
            }
            break;

            case "updateUser":
                if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['patientId'])) {
                    $patientId = $_POST['patientId'];
                    $user = User::findByPatientId($pdo, $patientId);
            
                    if ($user) {
                        $updates = [
                            'firstName' => $_POST['firstName'] ?? $user->getFirstName(),
                            'lastName' => $_POST['lastName'] ?? $user->getLastName(),
                            'email' => $_POST['email'] ?? $user->getEmail(),
                            'phone' => $_POST['phone'] ?? $user->getPhone(),
                            'homeAddress' => $_POST['homeAddress'] ?? $user->getHomeAddress(),
                            'dob' => $_POST['dob'] ?? $user->getdob(),
                            'medicine' => $_POST['medicine'] ?? $user->getMedicine(),
                            'bloodType' => $_POST['bloodType'] ?? $user->getBloodType()
                        ]; 
                        $user->updateUser($updates);
                        echo json_encode(['status' => 'success', 'message' => 'User updated']);
                    } else {
                        echo json_encode(['status' => 'error', 'message' => 'User not found']);
                    }
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Invalid request method or missing parameters']);
                }
                break;
            

        case "deleteUser":
            // Expecting POST requests to delete a user by patientId
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['patientId'])) {
                User::remove($pdo, $_POST['patientId']);
                echo json_encode(['status' => 'success', 'message' => 'User deleted']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Invalid request method or missing parameters']);
            }
            break;

        default:
            echo json_encode(['status' => 'error', 'message' => 'Invalid action']);
            break;
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => 'Internal Server Error: ' . $e->getMessage()]);
}
