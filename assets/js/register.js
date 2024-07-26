document.addEventListener('DOMContentLoaded', function () {
  'use strict'

  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  const forms = document.querySelectorAll('.needs-validation');
  const modal = new bootstrap.Modal(document.getElementById('register-modal'))
  const modalContent= document.querySelector('#register-modal .modal-body p');

  // Loop over them and prevent submission
  Array.from(forms).forEach(form => {

    form.querySelector(".btn-submit").addEventListener('click', event => {
      if (!form.checkValidity()) {
        event.preventDefault();
        event.stopPropagation();
        form.classList.add('was-validated');
        return;
      }

      $.ajax({
        type: 'POST',
        url: '/app/api.php',
        data: {
          action: 'addUser',
          firstName: $('#firstName').val(),
          lastName: $('#lastName').val(),
          email: $('#email').val(),
          phone: $('#phone').val(),
          homeAddress: $('#homeAddress').val(),
          dateOfBirth: $('#dateOfBirth').val(),
          medicine: $('#medicine').val(),
          bloodType: $('#bloodType').val()
        },
        success: function (response) {
          if (response.status === 'success') {
            form.classList.remove('was-validated');
            form.reset();
            modalContent.innerText = 'Patient record added succesfuly';
            modal.toggle();
          } else {
            modalContent.innerText = 'An error occurred when adding patient record';
            modal.toggle();
          }
        },
        error: function () {
          alert('An error occurred while processing your request.');
        }
      });

    });
  });

  //Validate patient intake form
  const firstName = document.getElementById('firstName');

});