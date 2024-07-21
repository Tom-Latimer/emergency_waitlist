<?php

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign-Up</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-primary fixed-top" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Heem Hospital</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navigation">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link">Register</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="d-flex vh-100">
        <div class="carousel slide h-100 w-75" id="mainCarousel" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#mainCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#mainCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#mainCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner h-100">
                <div class="carousel-item active h-100">
                    <img src="../assets/images/doctor.jpg" class="d-block w-100 h-100">
                </div>
                <div class="carousel-item h-100">
                    <img src="../assets/images/mri-machine.jpg" class="d-block w-100 h-100">
                </div>
                <div class="carousel-item h-100">
                    <img src="../assets/images/reception.jpg" class="d-block w-100 h-100">
                </div>
            </div>
        </div>
        <div class="d-flex flex-column align-items-center justify-content-center gap-3 w-25 ps-4 pe-4 bg-body-tertiary">
            <h1>Welcome to Heem Hospital!</h1>
            <p>Where exceptional care meets cutting-edge technology. Our dedicated team of healthcare professionals is committed to providing the highest standard of patient care in a compassionate and nurturing environment. From routine check-ups to advanced medical treatments, Heem Hospital is here to support your health and well-being every step of the way. Discover the difference at Heem Hospital, where your health is our priority.</p>
            <button class="btn btn-primary btn-l">Register Today!</button>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>