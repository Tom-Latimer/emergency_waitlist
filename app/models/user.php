<?php

require 'db.php';
class User {
    //Properties
    private $pdo;
    private $firstName;
    private $lastName;
    private $email;
    private $phone;
    private $patientId;
    private $homeAddress;
    private $dob;
    private $medicine;
    private $bloodType;

    // Constructor
    public function __construct($pdo, $firstName, $lastName, $email, $phone, $patientId, $homeAddress, $dob, $medicine, $bloodType) {
        $this->pdo = $pdo;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->phone = $phone;
        $this->patientId = $patientId;
        $this->homeAddress = $homeAddress;
        $this->dob = $dob;
        $this->medicine = $medicine;
        $this->bloodType = $bloodType;
    }

    // Setters
    
    public function setFirstName($firstName) {
        $this->firstName = $firstName;
    }
    
    public function setLastName($lastName) {
        $this->lastName = $lastName;
    }
    
    public function setEmail($email) {
        $this->email = $email;
    }
    
    public function setPhone($phone) {
        $this->phone = $phone;
    }
    
    public function setPatientId($patientId) {
        $this->patientId = $patientId;
    }
    
    public function setHomeAddress($homeAddress) {
        $this->homeAddress = $homeAddress;
    }
    
    public function setdob($dob) {
        $this->dob = $dob;
    }
    
    public function setMedicine($medicine) {
        $this->medicine = $medicine;
    }
    
    public function setBloodType($bloodType) {
        $this->bloodType = $bloodType;
    }
    


    // Getters
    public function getFirstName() {
        return $this->firstName;
    }
    
    public function getLastName() {
        return $this->lastName;
    }
    
    public function getEmail() {
        return $this->email;
    }
    
    public function getPhone() {
        return $this->phone;
    }
    
    public function getPatientId() {
        return $this->patientId;
    }
    
    public function getHomeAddress() {
        return $this->homeAddress;
    }
    
    public function getdob() {
        return $this->dob;
    }
    
    public function getMedicine() {
        return $this->medicine;
    }
    
    public function getBloodType() {
        return $this->bloodType;
    }
    public function save() {
        // Insert new patient
        $stmt = $this->pdo->prepare("INSERT INTO public.patient (first_name, last_name, email, phone, home_address, dob, medicine, blood_type) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$this->firstName, $this->lastName, $this->email, $this->phone, $this->homeAddress, $this->dob, $this->medicine, $this->bloodType]);
        //$this->patientId = $this->pdo->lastInsertId(); // Set patientId if it's the primary key
        
    }

    public function updateUser($updates) {
        $updateQuery = "UPDATE public.patient SET ";
        $updateParts = [];
        $params = [];

        // Dynamically build the SQL query based on the fields provided in $updates
        foreach ($updates as $key => $value) {
            if (property_exists($this, $key) && $value !== $this->$key) {
                $updateParts[] = "$key = ?";
                $params[] = $value;
                $this->$key = $value; // Update the property value
            }
        }

        if (!empty($updateParts)) {
            $updateQuery .= implode(', ', $updateParts);
            $updateQuery .= " WHERE patient_id = ?";
            $params[] = $this->patientId;

            $stmt = $this->pdo->prepare($updateQuery);
            $stmt->execute($params);
        }
    }

    public static function remove(PDO $pdo, $patientId) {
        if (!empty($patientId)) {
            $stmt = $pdo->prepare("DELETE FROM public.patient WHERE patient_id = ?");
            // Execute the statement with patientId
            $success = $stmt->execute([$patientId]);
        } 
    }


    public static function findByPatientId(PDO $pdo, $patientId) {
        $stmt = $pdo->prepare("SELECT * FROM public.patient WHERE patient_id = ?");
        $stmt->execute([$patientId]);
        $data = $stmt->fetch();

        if ($data) {
            return new self(
                $pdo,
                $data['first_name'],
                $data['last_name'],
                $data['email'],
                $data['phone'],
                $data['patient_id'],
                $data['home_address'],
                $data['dob'],
                $data['medicine'],
                $data['blood_type']
            );
        } else {
            return null;
        }
    }

    
}