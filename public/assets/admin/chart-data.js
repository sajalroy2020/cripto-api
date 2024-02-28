$(document).ready(function() {

    $('#submitForm').on('click', function(e) {
        e.preventDefault();

        $.ajax({
            url: $('#chart-store-route').val(),
            type: 'POST',
            data: $('#chartForm').serialize(),
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },

            success: function(response) {
                $('#modaldemo1').modal('hide');
                $('#example1').load(location.href+' #example1');
                successNotifications('Data added successfully');
                setTimeout(function(){
                  location.reload();
                }, 3000);
            },
            error: function(xhr) {
                if (xhr.status === 422) {
                    var errors = xhr.responseJSON.errors;
                    $('.error-text').text('');

                    $('.error-message').remove();
                    $.each(errors, function(key, value) {
                        var inputField = $('[name="' + key + '"]');
                        inputField.after('<div class="text-danger error-text">' + value + '</div>');
                    });

                    $('#modaldemo1').modal('show');
                    errorNotifications('something went rong !..');
                }
            }

        });
    });

    // show edit data
    $(document).on('click', '.editDataBtn', function() {
        let id = $(this).data('id');
        let close = $(this).data('close');
        let low = $(this).data('low');
        let high = $(this).data('high');
        let open = $(this).data('open');
        let time = $(this).data('time');

        $('#id').val(id);
        $('#close').val(close);
        $('#low').val(low);
        $('#high').val(high);
        $('#open').val(open);
        $('#time').val(time);
    });

    $('#submitEditForm').on('click', function(e) {
        e.preventDefault();

        $.ajax({
            url: $('#chart-store-route').val(),
            type: 'POST',
            data: $('#chartEditForm').serialize(),
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },

            success: function(response) {
                $('#editModel').modal('hide');
                $('#example1').load(location.href+' #example1');
                successNotifications('Data updated successfully');
                setTimeout(function(){
                  location.reload();
                }, 3000);
            },
            error: function(xhr) {
                if (xhr.status === 422) {
                    var errors = xhr.responseJSON.errors;
                    $('.error-text').text('');

                    $('.error-message').remove();
                    $.each(errors, function(key, value) {
                        var inputField = $('[name="' + key + '"]');
                        inputField.after('<div class="text-danger error-text">' + value + '</div>');
                    });

                    $('#editModel').modal('show');
                    errorNotifications('something went rong !..');
                }
            }

        });
    });

});
