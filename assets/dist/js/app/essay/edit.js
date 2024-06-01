$(document).ready(function() {

    $("#essay").submit(function(event) {
        event.preventDefault();

        var formData = $(this).serialize();
        $.ajax({
            type: "POST",
            url: base_url + 'essay/save',
            data: formData,
            success: function () {
                    Swal.fire({
                        icon: "success",
                        title: "Data Berhasil disimpan",
                        showConfirmButton: false,
                        timer: 2000
                    });
            }
        });
    });
});

