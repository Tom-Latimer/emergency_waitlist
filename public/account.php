<?php
session_start();
$userInfo = isset($_SESSION["log_user_info"]) ? $_SESSION["log_user_info"] : [];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account</title>
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
                        <a class="nav-link" href="register.php">Register</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="account.php">Account</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <?php if (isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"] === true): ?>
        <div class="container">
            <form action="" method="post" id="account-form" class="pt-4 needs-validation" novalidate>
                <fieldset disabled>
                    <legend class="display-6">Patient Account Information</legend>
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <input type="hidden" name="patientId"
                                value="<?php echo htmlspecialchars($userInfo['log_patientId'] ?? ''); ?>">
                            <label for="firstName" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="firstName" name="firstName" placeholder="Naoki"
                                value="<?php echo htmlspecialchars($userInfo['log_firstName'] ?? ''); ?>" required>
                            <div class="invalid-feedback">
                                Please enter a valid first name.
                            </div>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="lastName" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Urasawa"
                                value="<?php echo htmlspecialchars($userInfo['log_lastName'] ?? ''); ?>" required>
                            <div class="invalid-feedback">
                                Please enter a valid last name.
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-md-8">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="example@domain.com"
                                value="<?php echo htmlspecialchars($userInfo['log_email'] ?? ''); ?>" required>
                            <div class="invalid-feedback">
                                Please enter a valid email address.
                            </div>
                        </div>
                        <div class="mb-3 col-md-4">
                            <label for="phone" class="form-label">Phone Number</label>
                            <input type="tel" class="form-control" id="phone" name="phone" placeholder="111 111-1111"
                                pattern="[0-9]{3} [0-9]{3}-[0-9]{4}"
                                value="<?php echo htmlspecialchars($userInfo['log_phone'] ?? ''); ?>" required>
                            <div class="invalid-feedback">
                                Please enter a valid phone number.
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-12">
                            <label for="homeAddress" class="form-label">Home Address</label>
                            <input type="text" class="form-control" id="homeAddress" name="homeAddress"
                                value="<?php echo htmlspecialchars($userInfo['log_homeAddress'] ?? ''); ?>" required>
                            <div class="invalid-feedback">
                                Please enter your home address.
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-12">
                            <label for="dateOfBirth" class="form-label">Date of Birth</label>
                            <input type="date" class="form-control" id="dateOfBirth" name="dateOfBirth"
                                value="<?php echo htmlspecialchars($userInfo['log_dob'] ?? ''); ?>" required>
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
                                <option value="A+" <?php echo (isset($userInfo['log_bloodType']) && $userInfo['log_bloodType'] == 'A+') ? 'selected' : ''; ?>>A+</option>
                                <option value="A-" <?php echo (isset($userInfo['log_bloodType']) && $userInfo['log_bloodType'] == 'A-') ? 'selected' : ''; ?>>A-</option>
                                <option value="B+" <?php echo (isset($userInfo['log_bloodType']) && $userInfo['log_bloodType'] == 'B+') ? 'selected' : ''; ?>>B+</option>
                                <option value="B-" <?php echo (isset($userInfo['log_bloodType']) && $userInfo['log_bloodType'] == 'B-') ? 'selected' : ''; ?>>B-</option>
                                <option value="AB+" <?php echo (isset($userInfo['log_bloodType']) && $userInfo['log_bloodType'] == 'AB+') ? 'selected' : ''; ?>>AB+</option>
                                <option value="AB-" <?php echo (isset($userInfo['log_bloodType']) && $userInfo['log_bloodType'] == 'AB-') ? 'selected' : ''; ?>>AB-</option>
                                <option value="O+" <?php echo (isset($userInfo['log_bloodType']) && $userInfo['log_bloodType'] == 'O+') ? 'selected' : ''; ?>>O+</option>
                                <option value="O-" <?php echo (isset($userInfo['log_bloodType']) && $userInfo['log_bloodType'] == 'O-') ? 'selected' : ''; ?>>O-</option>
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
                                placeholder="e.g. Vyvanse"><?php echo htmlspecialchars($userInfo['log_medicine'] ?? ''); ?></textarea>
                        </div>
                    </div>
                </fieldset>
                <div class="row">
                    <div class="mb-3 col-12">
                        <button class="btn btn-primary btn-edit" type="button">Edit</button>
                        <button class="btn btn-success btn-submit visually-hidden" type="submit">Submit</button>
                        <button class="btn btn-danger btn-cancel visually-hidden" type="button">Cancel</button>
                    </div>
                </div>
            </form>
            <div>
                <form action="/app/api.php" class="row">
                    <input type="hidden" name="action" value="logout">
                    <button class="btn btn-warning mb-3 col-auto" type="submit">Logout</button>
                </form>
            </div>
        </div>
    <?php else: ?>
        <div class="container d-flex flex-column justify-content-center align-items-center">
            <h1 class="display-6 mb-1 mt-3">Welcome!</h1>
            <p class="lead mb-3">Please log in to view your account details.</p>
            <form action="/app/api.php" method="get" class="row">
                <input type="hidden" name="action" value="login">
                <div class="col-auto">
                    <label for="patientLogin" class="form-label">Patient Id</label>
                </div>
                <div class="col-auto">
                    <input type="number" class="form-control" id="patientLogin" name="patientLogin" required>
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary mb-3">Login</button>
                </div>
            </form>
        </div>
    <?php endif; ?>
    <div id="account-modal" class="modal" tabindex="-1">
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
    <script src="../assets/js/account-info.js"></script>
</body>

</html>