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
                    NULL,
                    $_POST['homeAddress'],
                    $_POST['dateOfBirth'],
                    $_POST['medicine'],
                    $_POST['bloodType']
                );
                $user->save();  // Save the new user to the database
                error_log('Successfully added user');
                error_log('Headers sent: ' . implode(', ', headers_list()));
                echo json_encode(['status' => 'success', 'message' => 'User added']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
            }
            break;

        case 'getAllUsers':
            if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                error_log('Got request for all users');
                $stmt = $pdo->query("SELECT patient_id as patientId, first_name as firstName, last_name as lastName, email, phone, home_address as homeAddress, dob as dateOfBirth, blood_type as bloodType, medicine FROM public.patient");
                $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
                error_log(json_encode($users));
                echo json_encode($users);
            }
            break;

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
                error_log('Api hit: updateUser');
                if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['patientId'])) {
                    error_log('Post statement passed');
                    $patientId = $_POST['patientId'];
                    $user = User::findByPatientId($pdo, $patientId);
                    error_log('Patient found to update');
                    if ($user) {
                        $updates = [
                            'first_name' => $_POST['firstName'] ?? $user->getFirstName(),
                            'last_name' => $_POST['lastName'] ?? $user->getLastName(),
                            'email' => $_POST['email'] ?? $user->getEmail(),
                            'phone' => $_POST['phone'] ?? $user->getPhone(),
                            'home_address' => $_POST['homeAddress'] ?? $user->getHomeAddress(),
                            'dob' => $_POST['dateOfBirth'] ?? $user->getdob(),
                            'medicine' => $_POST['medicine'] ?? $user->getMedicine(),
                            'blood_type' => $_POST['bloodType'] ?? $user->getBloodType()
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
