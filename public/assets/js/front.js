$(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
    });

    function renderErrors($container, errors) {
        var html = '<div class="alert alert-danger"><ul class="mb-0">';
        Object.keys(errors).forEach(function (field) {
            errors[field].forEach(function (message) {
                html += '<li>' + message + '</li>';
            });
        });
        html += '</ul></div>';
        $container.html(html);
    }

    function renderSuccess($container, message) {
        $container.html('<div class="alert alert-success">' + message + '</div>');
    }

    $('#booking-form').on('submit', function (e) {
        e.preventDefault();

        var $form = $(this);
        var $alert = $('#booking-alert');
        var $button = $form.find('button[type="submit"]');

        $button.prop('disabled', true).text('Submitting...');

        $.ajax({
            url: '/booking',
            method: 'POST',
            data: $form.serialize(),
        }).done(function (response) {
            renderSuccess($alert, response.message);
            $form.trigger('reset');
        }).fail(function (xhr) {
            if (xhr.status === 422) {
                renderErrors($alert, xhr.responseJSON.errors);
            } else {
                renderErrors($alert, { general: ['Something went wrong. Please try again.'] });
            }
        }).always(function () {
            $button.prop('disabled', false).text('Submit Booking Request');
        });
    });

    $('#enquiry-form').on('submit', function (e) {
        e.preventDefault();

        var $form = $(this);
        var $alert = $('#enquiry-alert');
        var $button = $form.find('button[type="submit"]');

        $button.prop('disabled', true).text('Sending...');

        $.ajax({
            url: '/enquiry',
            method: 'POST',
            data: $form.serialize(),
        }).done(function (response) {
            renderSuccess($alert, response.message);
            $form.trigger('reset');
        }).fail(function (xhr) {
            if (xhr.status === 422) {
                renderErrors($alert, xhr.responseJSON.errors);
            } else {
                renderErrors($alert, { general: ['Something went wrong. Please try again.'] });
            }
        }).always(function () {
            $button.prop('disabled', false).text('Send Enquiry');
        });
    });
});
