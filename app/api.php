<?php
session_start();
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
        
        case "login":
            if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['patientLogin'])) {
                $user = User::findByPatientId($pdo, $_GET['patientLogin']);
                if ($user != null) {
                    $_SESSION["loggedIn"] = true;
                    error_log(json_encode($_SESSION["loggedIn"]));
                    $_SESSION["log_user_info"] = [
                        'log_patientId' => $user->getPatientId(),
                        'log_firstName' => $user->getFirstName(),
                        'log_lastName' => $user->getLastName(),
                        'log_email' => $user->getEmail(),
                        'log_phone' => $user->getPhone(),
                        'log_homeAddress' => $user->getHomeAddress(),
                        'log_dob' => $user->getdob(),
                        'log_medicine' => $user->getMedicine(),
                        'log_bloodType' => $user->getBloodType()
                    ];
                }
            }
            header('Location: /public/account.php');
            exit();

        case "logout":
            if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                unset($_SESSION["log_user_info"]);
                $_SESSION["loggedIn"] = false;
            }
            header('Location: /public/account.php');
            exit();

            case "updateUser":
                error_log('Api hit: updateUser');
                if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['patientId'])) {
                    error_log('Post statement passed');
                    $patientId = $_POST['patientId'];
                    $user = User::findByPatientId($pdo, $patientId);
                    error_log('Patient found to update');
                    if ($user) {
                        $updates = [
                            'firstName' => $_POST['firstName'] ?? $user->getFirstName(),
                            'lastName' => $_POST['lastName'] ?? $user->getLastName(),
                            'email' => $_POST['email'] ?? $user->getEmail(),
                            'phone' => $_POST['phone'] ?? $user->getPhone(),
                            'homeAddress' => $_POST['homeAddress'] ?? $user->getHomeAddress(),
                            'dob' => $_POST['dateOfBirth'] ?? $user->getdob(),
                            'medicine' => $_POST['medicine'] ?? $user->getMedicine(),
                            'bloodType' => $_POST['bloodType'] ?? $user->getBloodType()
                        ]; 

                        $user->updateUser($updates);
                        if (isset($_POST['subAction']) && $_POST['subAction'] === 'login') {
                            $_SESSION["log_user_info"] = [
                                'log_firstName' => $_POST['firstName'],
                                'log_lastName' => $_POST['lastName'],
                                'log_email' => $_POST['email'],
                                'log_phone' => $_POST['phone'],
                                'log_homeAddress' => $_POST['homeAddress'],
                                'log_dob' => $_POST['dateOfBirth'],
                                'log_medicine' => $_POST['medicine'],
                                'log_bloodType' => $_POST['bloodType']
                            ];
                        }
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
