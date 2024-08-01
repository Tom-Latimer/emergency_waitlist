<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand">Heem Hospital</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navigation">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="register.php">Register</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="account.php">Account</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <form action="/app/api.php?action=addUser" method="post" class="pt-4 needs-validation" novalidate>
            <fieldset>
                <legend>Patient Intake Form</legend>
                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label for="firstName" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="firstName" name="firstName" placeholder="Naoki"
                            required>
                        <div class="invalid-feedback">
                            Please enter a valid first name.
                        </div>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="lastName" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Urasawa"
                            required>
                        <div class="invalid-feedback">
                            Please enter a valid last name.
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 col-md-8">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" class="form-control" id="email" name="email"
                            placeholder="example@domain.com" required>
                        <div class="invalid-feedback">
                            Please enter a valid email address.
                        </div>
                    </div>
                    <div class="mb-3 col-md-4">
                        <label for="phone" class="form-label">Phone Number</label>
                        <input type="tel" class="form-control" id="phone" name="phone" placeholder="111 111-1111"
                            pattern="[0-9]{3} [0-9]{3}-[0-9]{4}" required>
                        <div class="invalid-feedback">
                            Please enter a valid phone number.
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 col-12">
                        <label for="homeAddress" class="form-label">Home Address</label>
                        <input type="text" class="form-control" id="homeAddress" name="homeAddress" required>
                        <div class="invalid-feedback">
                            Please enter your home address.
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 col-12">
                        <label for="dateOfBirth" class="form-label">Date of Birth</label>
                        <input type="date" class="form-control" id="dateOfBirth" name="dateOfBirth" required>
                        <div class="invalid-feedback">
                            Please enter your date of birth.
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 col-12">
                        <label for="bloodType" class="form-label">Blood Type</label>
                        <select id="bloodType" name="bloodType" class="form-select" required>
                            <option value="">Please Select Blood Type</option>
                            <option value="A+">A+</option>
                            <option value="A-">A-</option>
                            <option value="B+">B+</option>
                            <option value="B-">B-</option>
                            <option value="AB+">AB+</option>
                            <option value="AB-">AB-</option>
                            <option value="O+">O+</option>
                            <option value="O-">O-</option>
                        </select>
                        <div class="invalid-feedback">
                            Please select a valid blood type.
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 col-12">
                        <label for="medicine" class="form-label">Medicine</label>
                        <textarea class="form-control" id="medicine" name="medicine" rows="3"
                            placeholder="e.g. Vyvanse"></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 col-12">
                        <button class="btn btn-primary btn-submit" type="button">Submit</button>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
    <div id="register-modal" class="modal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Notice</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="../assets/js/register.js"></script>
</body>

</html>