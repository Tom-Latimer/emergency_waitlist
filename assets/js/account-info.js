$(document).ready(function () {
    // Initialize Bootstrap modal
    const modal = new bootstrap.Modal(document.getElementById('account-modal'));
    const modalContent = $('#account-modal .modal-body p');

    const form = $('#account-form');

    const fieldset = form.find('fieldset');
    const editButton = form.find('.btn-edit');
    const submitButton = form.find('.btn-submit');
    const cancelButton = form.find('.btn-cancel');

    form.on('submit', function (event) {
        // Stop default form behavior, make custom request later
        event.preventDefault();

        // Add class for bootstrap visuals
        form.addClass('was-validated');
        if (!form[0].checkValidity()) {
            event.stopPropagation();
            return;
        }

        var requestData = form.serialize();
        requestData += '&action=updateUser&subAction=login';

        $.ajax({
            type: 'POST',
            url: '/app/api.php',
            data: requestData,
            success: function (response) {
                if (response.status === 'success') {
                    form.removeClass('was-validated');
                    // Make form uneditable
                    fieldset.prop('disabled', true);

                    // Hide and show buttons
                    editButton.toggleClass('visually-hidden');
                    submitButton.toggleClass('visually-hidden');
                    cancelButton.toggleClass('visually-hidden');

                    // Display modal message
                    modalContent.text('Account information updated successfully');
                    modal.show();
                } else {
                    fieldset.prop('disabled', true);

                    // Hide and show buttons
                    editButton.toggleClass('visually-hidden');
                    submitButton.toggleClass('visually-hidden');
                    cancelButton.toggleClass('visually-hidden');

                    modalContent.text('An error occurred when updating account information');
                    modal.show();
                }
            },
            error: function () {
                fieldset.prop('disabled', true);

                // Hide and show buttons
                editButton.toggleClass('visually-hidden');
                submitButton.toggleClass('visually-hidden');
                cancelButton.toggleClass('visually-hidden');

                modalContent.text('The request ran into a critical error');
                modal.show();
            }
        });
    });

    editButton.on('click', function () {
        // Make form editable
        fieldset.prop('disabled', false);

        // Hide and show buttons
        editButton.toggleClass('visually-hidden');
        submitButton.toggleClass('visually-hidden');
        cancelButton.toggleClass('visually-hidden');
    });

    cancelButton.on('click', function () {
        // Make form uneditable
        fieldset.prop('disabled', true);

        // Hide and show buttons
        editButton.toggleClass('visually-hidden');
        submitButton.toggleClass('visually-hidden');
        cancelButton.toggleClass('visually-hidden');
    });
});
