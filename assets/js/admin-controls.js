document.addEventListener('DOMContentLoaded', function () {
    const data = [
        {
          "patientId": "1",
          "firstName": "Alice",
          "lastName": "Johnson",
          "email": "alice.johnson@example.com",
          "phone": "123 456-7890",
          "homeAddress": "789 Maple Street, Rivertown, TX",
          "dateOfBirth": "1975-08-22",
          "bloodType": "B+",
          "medicine": "Metformin, Lisinopril"
        },
        {
          "patientId": "2",
          "firstName": "Bob",
          "lastName": "Smith",
          "email": "bob.smith@example.com",
          "phone": "987 654-3210",
          "homeAddress": "456 Pine Avenue, Hilltown, CA",
          "dateOfBirth": "1985-12-11",
          "bloodType": "O-",
          "medicine": "Atorvastatin"
        },
        {
          "patientId": "3",
          "firstName": "Carol",
          "lastName": "Taylor",
          "email": "carol.taylor@example.com",
          "phone": "345 678-9012",
          "homeAddress": "123 Birch Road, Lakeview, FL",
          "dateOfBirth": "1992-03-30",
          "bloodType": "A-",
          "medicine": "Amlodipine, Omeprazole"
        },
        {
          "patientId": "4",
          "firstName": "David",
          "lastName": "Brown",
          "email": "david.brown@example.com",
          "phone": "654 321-0987",
          "homeAddress": "321 Cedar Lane, Forestville, WA",
          "dateOfBirth": "1968-07-17",
          "bloodType": "AB+",
          "medicine": "Gabapentin"
        }
      ];
    
    const patientAccordion = document.getElementById('patientAccordion');
    createPatientRecords(patientAccordion, data);
});

function createPatientRecords(container, data) {

    //clear the list
    container.innerHTML = '';

    //create the nodes
    data.forEach((patient, index) => {
        //create accordion item for patient record
        const html = template(index, patient.patientId, patient.firstName, patient.lastName, patient.email, patient.phone, patient.homeAddress, patient.dateOfBirth, patient.bloodType, patient.medicine);

        //add it to the container
        container.insertAdjacentHTML('beforeend', html);        
    });

    const forms = document.querySelectorAll('.needs-validation');
  
    // Loop over them and event listeners
    Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {
            if (!form.checkValidity()) {
            event.preventDefault()
            event.stopPropagation()
            }
    
            form.classList.add('was-validated')
        }, false)

        const fieldset = form.querySelector('fieldset');
        const editButton = form.querySelector('.btn-edit');
        const submitButton = form.querySelector('.btn-submit');
        const cancelButton = form.querySelector('.btn-cancel');

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
                        <form action="/public/api.php?action=update&patientId=${patientId}" method="post" class="pt-4 needs-validation" novalidate>
                            <fieldset disabled>
                                <div class="row">
                                    <div class="mb-3 col-md-6">
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
                                        <label for="dob" class="form-label">Date of Birth</label>
                                        <input type="date" class="form-control" id="dob" name="dateOfBirth" value="${dateOfBirth}" required>
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
