<?php

require 'db.php'; 
require 'User.php'; 

// Creating a new User object with sample data
//$user = new User($pdo, 'Alice', 'Johnson', 'alice.johnson@example.com', '555-0123', 'AJ2024', '123 Maple Street, Springfield', '2003-05-20', 'Lipitor', 'AB+');

// Saving the new user to the database
//$user->save();

//User::remove($pdo, 'A');
//echo "New user inserted successfully!";
$user = User::findByPatientId($pdo, 'PID001');

// Check if a user was found and display their information
if ($user) {
    echo "User Found:<br/>";
    echo "Patient ID: " . $user->getPatientId() . "<br/>";
    echo "First Name: " . $user->getFirstName() . "<br/>";
    echo "Last Name: " . $user->getLastName() . "<br/>";
    echo "Email: " . $user->getEmail() . "<br/>";
    echo "Phone: " . $user->getPhone() . "<br/>";
    echo "Home Address: " . $user->getHomeAddress() . "<br/>";
    echo "Date of Birth: " . $user->getdob() . "<br/>";
    echo "Medicine: " . $user->getMedicine() . "<br/>";
    echo "Blood Type: " . $user->getBloodType() . "<br/>";
} else {
    echo "No user found with Patient ID: " . $patientId;
}

