$('#addform').submit(function () {
    event.preventDefault();
    console.log("Dodaj je pokrenuto");
    const $form = $(this);
    const $input = $form.find('input,select,button,textarea');
    const serijalizacija = $form.serialize();
    console.log(serijalizacija);

    $input.prop('disabled', true);

    request = $.ajax({
        url: 'handler/add.php',
        type: 'post',
        data: serijalizacija
    });

    request.done(function (response, textStatus, jqXHR) {
        if (response === "Success") {
            alert("New car is successfully added");
            console.log("Uspesno dodavanje");
            location.reload(true);
        }
        else {
            console.log("New car is NOT added" + response);
        }
    });

    request.fail(function (jqXHR, textStatus, errorThrown) {
        console.error('Error message: ' + textStatus, errorThrown);
    });
});