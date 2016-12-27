$(document).ready(function () {
    var url = "http://tedis-ukraine/api.php";
    $.get(url, {tree: true}).done(function (data) {
        $("#catalog").html(data);
    });

    $("#createForm").submit(function () {
        var form = $(this);
        var error = false;
        form.find('input').each(function () {
            if ($(this).val() == '') {
                alert('Зaпoлнитe пoлe "' + $(this).attr('placeholder') + '"!');
                error = true;
            }
        });
        if (!error) {
            var data = form.serialize();
            $.ajax({
                type: 'POST',
                url: url,
                dataType: 'json',
                data: data,
                beforeSend: function (data) {
                    form.find('input[type="submit"]').attr('disabled', 'disabled');
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert(xhr.status);
                    alert(thrownError);
                },
                complete: function (data) {
                    form.find('input[type="submit"]').prop('disabled', false);
                    $("#catalog").html(data.responseText);
                }

            });
        }
        return false;
    });
});