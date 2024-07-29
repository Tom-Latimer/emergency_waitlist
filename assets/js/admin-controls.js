document.addEventListener('DOMContentLoaded', function () {

    $.ajax({
        type: 'GET',
        url: '/app/api.php',
        data: {
            action: 'getAllUsers'
        },
        dataType: 'json',
        success: function (response) {
            console.log(response);
            const patientAccordion = document.getElementById('patientAccordion');
            createPatientRecords(patientAccordion, response);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.error('Request failed:');
            console.error('Status:', textStatus);
            console.error('Error:', errorThrown);
        }
    });
});

function createPatientRecords(container, data) {

    //clear the list
    container.innerHTML = '';

    //create the nodes
    data.forEach((patient, index) => {
        //create accordion item for patient record
        const html = template(index, patient.patientid, patient.firstname, patient.lastname, patient.email, patient.phone, patient.homeaddress, patient.dateofbirth, patient.bloodtype, patient.medicine);

        //add it to the container
        container.insertAdjacentHTML('beforeend', html);
    });

    const forms = document.querySelectorAll('.needs-validation');

    // Loop over them and event listeners
    Array.from(forms).forEach(form => {

        const modal = new bootstrap.Modal(document.getElementById('admin-modal'));
        const modalContent = document.querySelector('#admin-modal .modal-body p');

        const fieldset = form.querySelector('fieldset');
        const editButton = form.querySelector('.btn-edit');
        const submitButton = form.querySelector('.btn-submit');
        const cancelButton = form.querySelector('.btn-cancel');

        form.addEventListener('submit', event => {
            //stop default form behaviour, make custom request later
            event.preventDefault();

            //add class for bootstrap visuals
            form.classList.add('was-validated');
            if (!form.checkValidity()) {
                event.stopPropagation();
                return;
            }

            var requestData = $(form).serialize();

            requestData += '&action=updateUser';

            console.log(requestData);

            $.ajax({
                type: 'POST',
                url: '/app/api.php',
                data: requestData,
                success: function (response) {
                    if (response.status === 'success') {
                        form.classList.remove('was-validated');
                        //make form uneditable
                        fieldset.disabled = true;

                        //hide and show buttons
                        editButton.classList.toggle('visually-hidden');
                        submitButton.classList.toggle('visually-hidden');
                        cancelButton.classList.toggle('visually-hidden');

                        //display modal message
                        modalContent.innerText = 'Patient record updated succesfuly';
                        modal.toggle();
                    } else {
                        fieldset.disabled = true;

                        //hide and show buttons
                        editButton.classList.toggle('visually-hidden');
                        submitButton.classList.toggle('visually-hidden');
                        cancelButton.classList.toggle('visually-hidden');

                        modalContent.innerText = 'An error occurred when updating patient record';
                        modal.toggle();
                    }

                },
                error: function (response) {
                    fieldset.disabled = true;

                    //hide and show buttons
                    editButton.classList.toggle('visually-hidden');
                    submitButton.classList.toggle('visually-hidden');
                    cancelButton.classList.toggle('visually-hidden');

                    modalContent.innerText = 'The request ran into a critical error';
                    modal.toggle();
                }
            });

        }, false);

        editButton.addEventListener('click', () => {
            //make form editable
            fieldset.removeAttribute('disabled');

            //hide and show buttons
            editButton.classList.toggle('visually-hidden');
            submitButton.classList.toggle('visually-hidden');
            cancelButton.classList.toggle('visually-hidden');
        });

        cancelButton.addEventListener('click', () => {
            //make form uneditable
            fieldset.disabled = true;

            //hide and show buttons
            editButton.classList.toggle('visually-hidden');
            submitButton.classList.toggle('visually-hidden');
            cancelButton.classList.toggle('visually-hidden');
        });
    });
}

const template = (index, patientId, firstName, lastName, email, phone, homeAddress, dateOfBirth, bloodType, medicine) => `
    <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse${index}">
                        Patient: ${patientId} &nbsp;&nbsp;&nbsp; Name: ${firstName} ${lastName}
                    </button>
                </h2>
                <div id="collapse${index}" class="accordion-collapse collapse" data-bs-parent="#patientAccordion">
                    <div class="accordion-body">
                        <form method="post" class="pt-4 needs-validation" novalidate>
                            <fieldset disabled>
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <input type="hidden" name="patientId" value="${patientId}">
                                        <label for="firstName" class="form-label">First Name</label>
                                        <input type="text" class="form-control" id="firstName" name="firstName" placeholder="Naoki" value="${firstName}" required>
                                        <div class="invalid-feedback">
                                            Please enter a valid first name.
                                        </div>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="lastName" class="form-label">Last Name</label>
                                        <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Urasawa" value="${lastName}" required>
                                        <div class="invalid-feedback">
                                            Please enter a valid last name.
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-md-8">
                                        <label for="email" class="form-label">Email Address</label>
                                        <input type="email" class="form-control" id="email" name="email" placeholder="example@domain.com" value="${email}" required>
                                        <div class="invalid-feedback">
                                            Please enter a valid email address.
                                        </div>
                                    </div>
                                    <div class="mb-3 col-md-4">
                                        <label for="phone" class="form-label">Phone Number</label>
                                        <input type="tel" class="form-control" id="phone" name="phone" placeholder="111 111-1111" pattern="[0-9]{3} [0-9]{3}-[0-9]{4}" value="${phone}" required>
                                        <div class="invalid-feedback">
                                            Please enter a valid phone number.
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-12">
                                        <label for="homeAddress" class="form-label">Home Address</label>
                                        <input type="text" class="form-control" id="homeAddress" name="homeAddress" value="${homeAddress}" required>
                                        <div class="invalid-feedback">
                                            Please enter your home address.
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-12">
                                        <label for="dateOfBirth" class="form-label">Date of Birth</label>
                                        <input type="date" class="form-control" id="dateOfBirth" name="dateOfBirth" value="${dateOfBirth}" required>
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
                                            <option value="A+" ${bloodType === 'A+' ? 'selected' : ''}>A+</option>
                                            <option value="A-" ${bloodType === 'A-' ? 'selected' : ''}>A-</option>
                                            <option value="B+" ${bloodType === 'B+' ? 'selected' : ''}>B+</option>
                                            <option value="B-" ${bloodType === 'B-' ? 'selected' : ''}>B-</option>
                                            <option value="AB+" ${bloodType === 'AB+' ? 'selected' : ''}>AB+</option>
                                            <option value="AB-" ${bloodType === 'AB-' ? 'selected' : ''}>AB-</option>
                                            <option value="O+" ${bloodType === 'O+' ? 'selected' : ''}>O+</option>
                                            <option value="O-" ${bloodType === 'O-' ? 'selected' : ''}>O-</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Please select a valid blood type.
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-12">
                                        <label for="medicine" class="form-label">Medicine</label>
                                        <textarea class="form-control" id="medicine" name="medicine" rows="3" placeholder="e.g. Vyvanse">${medicine}</textarea>
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
                    </div>
                </div>
            </div>
`;
