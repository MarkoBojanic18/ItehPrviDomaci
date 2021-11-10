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


// dugme koje je na glavnoj formi i otvara dijalog za izmenu
$('#btnChange').click(function () {
    const checked = $('input[name=checked-donut]:checked');
    //pristupa informacijama te konkretne forme i popunjava dijalog
    request = $.ajax({
        url: 'handler/get.php',
        type: 'post',
        data: { 'id': checked.val() },
        dataType: 'json'
    });


    request.done(function (response, textStatus, jqXHR) {
        console.log('Popunjena');
        $('#carName').val(response[0]['carName']);
        console.log(response[0]['carName']);

        $('#userName').val(response[0]['userName'].trim());
        console.log(response[0]['userName'].trim());

        $('#email').val(response[0]['email'].trim());
        console.log(response[0]['email'].trim());

        $('#date').val(response[0]['date'].trim());
        console.log(response[0]['date'].trim());

        $('#id').val(checked.val());

        console.log(response);
    });

    request.fail(function (jqXHR, textStatus, errorThrown) {
        console.error('The following error occurred: ' + textStatus, errorThrown);
    });

});

//dugme za slanje UPDATE zahteva nakon popunjene forme
$('#editform').submit(function () {
    event.preventDefault();
    console.log("Izmene");
    const $form = $(this);
    const $inputs = $form.find('input, select, button, textarea');
    const serializedData = $form.serialize();
    console.log(serializedData);
    $inputs.prop('disabled', true);

    // kreirati request za UPDATE handler
    request = $.ajax({
        url: 'handler/update.php',
        type: 'post',
        data: serializedData
    });

    request.done(function (response, textStatus, jqXHR) {


        if (response === 'Success') {
            console.log('Kolokvijum je izmenjen');
            location.reload(true);
            //$('#izmeniForm').reset;
        }
        else console.log('Kolokvijum nije izmenjen ' + response);
        console.log(response);
    });

    request.fail(function (jqXHR, textStatus, errorThrown) {
        console.error('The following error occurred: ' + textStatus, errorThrown);
    });


    //$('#izmeniModal').modal('hide');
});