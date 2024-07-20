<?php
class User {
    //Properties
    private $firstName;
    private $lastName;
    private $email;
    private $phone;
    private $patientId;
    private $homeAddress;
    private $age;
    private $medicine;
    private $bloodType;

    // Constructor
    public function __construct($firstName, $lastName, $email, $phone, $patientId, $homeAddress, $age, $medicine, $bloodType) {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->phone = $phone;
        $this->patientId = $patientId;
        $this->homeAddress = $homeAddress;
        $this->age = $age;
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
    
    public function setAge($age) {
        $this->age = $age;
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
    
    public function getAge() {
        return $this->age;
    }
    
    public function getMedicine() {
        return $this->medicine;
    }
    
    public function getBloodType() {
        return $this->bloodType;
    }
    
}