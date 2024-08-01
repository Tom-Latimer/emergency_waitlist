## Students
Name: Tom Latimer  
Student Number: 300250278  

Name: Ash Bhattarai  
Student Number: 300236157

# Patient Management System

A web-based application for managing patient information. This system allows administrators to add, update, delete, and retrieve patient information, while patients can register their details. The system is built with PHP, JavaScript, and PostgreSQL, and uses Bootstrap for the user interface.

## Table of Contents

- [Installation](#installation)
- [Usage](#usage)
  - [Admin Perspective](#admin-perspective)
  - [Patient Perspective](#patient-perspective)
- [API Endpoints](#api-endpoints)
- [Database Schema](#database-schema)
- [Contributing](#contributing)
- [License](#license)

## Installation

### Prerequisites

- Docker and Docker Compose
- PHP 7.4 or higher (if running locally without Docker)
- Composer (for managing PHP dependencies, if running locally)
- Node.js and npm (for managing JavaScript dependencies, if running locally)

### Setup with Docker

1. **Clone the Repository:**

   ```bash
   git clone https://github.com/Tom-Latimer/emergency_waitlist.git
   cd emergency_waitlist

2. **Run the Application with Docker:**
    Navigate to the emergency_waitlist directory and run the following command to start the application and database: 'docker compose up'
    This command will set up the PostgreSQL database and the PHP server, making the application accessible.
    Note: Ensure you have docker compose installed
    https://www.docker.com

3. **Access the Application:**  
    Patient Page: Accessible at http://localhost:8000/public/index.php
    Admin Page: Accessible at http://localhost:8000/public/admin.php

## API Endpoints

The system's RESTful API allows for managing patient data. Here's a brief overview of each endpoint:

### Add User

- **Endpoint:** `POST /api.php?action=addUser`
- **Purpose:** Adds a new patient to the database.
- **Parameters:** firstName, lastName, email, phone, homeAddress, dateOfBirth, bloodType, medicine
- **Method:** POST

### Get All Users

- **Endpoint:** `GET /api.php?action=getAllUsers`
- **Purpose:** Retrieves a list of all registered patients.
- **Method:** GET

### Get User

- **Endpoint:** `GET /api.php?action=getUser`
- **Purpose:** Fetches details for a specific patient using their ID.
- **Parameters:** patientId
- **Method:** GET

### Update User

- **Endpoint:** `POST /api.php?action=updateUser`
- **Purpose:** Updates details for an existing patient.
- **Parameters:** patientId (required), other patient fields (optional)
- **Method:** POST

### Delete User

- **Endpoint:** `POST /api.php?action=deleteUser`
- **Purpose:** Removes a patient record from the database.
- **Parameters:** patientId
- **Method:** POST

## Database Schema

The system utilizes a PostgreSQL database to store patient information. Below is the schema for the primary table used in the system:

### Table: `patient`

- **patient_id** (integer): The primary key, auto-incremented.
- **first_name** (text): The patient's first name.
- **last_name** (text): The patient's last name.
- **email** (text): The patient's email address.
- **phone** (text): The patient's phone number.
- **home_address** (text): The patient's home address.
- **dob** (date): The patient's date of birth.
- **medicine** (text): Any medicine the patient is currently taking.
- **blood_type** (text): The patient's blood type.

SQL
CREATE TABLE IF NOT EXISTS public.patient
(
    patient_id SERIAL PRIMARY KEY,
    first_name TEXT NOT NULL,
    last_name TEXT NOT NULL,
    email TEXT NOT NULL,
    phone TEXT NOT NULL,
    home_address TEXT NOT NULL,
    dob DATE NOT NULL,
    medicine TEXT,
    blood_type TEXT NOT NULL
);

## Usage

### Admin Perspective

http://localhost:8000/public/admin.php

Administrators have full control over the patient management system and can perform the following tasks:

- **Dashboard Overview:** Administrators are greeted with a dashboard that provides a summary of total registered patients, recent patient registrations, and system notifications.

- **Add New Patient:**
  - Navigate to the 'Add Patient' form through the admin interface.
  - Fill out the patient intake form with details such as name, email, phone number, home address, date of birth, blood type, and current medications.
  - Submit the form to add the patient to the database.

- **View All Patients:**
  - Access a comprehensive list of all registered patients.
  - Use filters and search capabilities to quickly find specific patients.
  - Each patient's profile can be clicked for more detailed information.

- **Update Patient Information:**
  - From the patient's profile, select the 'Edit' option.
  - Update any necessary details such as contact information, medical records, or emergency contact details.
  - Save changes to update the patient’s record in the database.

- **Delete Patient:**
  - From the patient's profile, select the 'Delete' option.
  - Confirm deletion to permanently remove a patient’s record from the system.

- **Generate Reports:**
  - Generate various reports such as patient statistics, medication reports, and visit histories.
  - Export reports in multiple formats like PDF, CSV, or Excel for offline analysis.

### Patient Perspective

Patients interact with the system through a simplified public interface, which allows them to:

- **Register:**
  - Visit the public registration page at [http://localhost:8000/public/index.php](http://localhost:8000/public/index.php).
  - Fill out the registration form with personal and medical details.
  - Submit the form to create a new patient record in the system.


This Markdown formatted `README.md` includes all necessary details to get the project up and running, as well as information on how it can be used from both the admin and patient perspectives.


