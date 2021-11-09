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

function check() {
    document.getElementById("box").checked = true;
}


$('#btnDelete').click(function () {
    if (confirm("Are you sure?")) {
        console.log("Brisanje");

        const checked = $('input[name=checked-donut]:checked');

        req = $.ajax({
            url: 'handler/delete.php',
            type: 'post',
            data: { 'id': checked.val() }
        });

        req.done(function (res, textStatus, jqXHR) {
            if (res == "Success") {
                checked.closest('tr').remove();
                alert('Your car post is successfully deleted');
                console.log('Obrisan');
            } else {
                console.log("Your car post is NOT deleted " + res);
                alert("Your car post is NOT deleted ");

            }
            console.log(res);
        });
    }
});