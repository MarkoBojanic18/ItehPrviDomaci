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


function proveri() {
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

        $('#price').val(response[0]['price'].trim());
        console.log(response[0]['price'].trim());

        $('#id').val(checked.val());

        document.getElementById("nebitno").innerHTML = response[0]['email'].trim();

        console.log(response);
    });

    request.fail(function (jqXHR, textStatus, errorThrown) {
        console.error('The following error occurred: ' + textStatus, errorThrown);
    });

}





$('#btnDelete').click(function () {
    proveri();
    var trenutni = document.getElementById("nebitno").innerHTML;
    var ulogovani = document.getElementById("imejl").innerHTML;
    if (trenutni == ulogovani) {
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
                alert('Car post is successfully deleted!');
                console.log('Deleted');
            } else {
                console.log("Car post is NOT deleted " + res);
                alert("Car post is NOT deleted ");

            }
            console.log(res);
        });
    } else {
        alert("This is NOT your post");
    }


});




$('#btnPreview').click(function () {
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

        $('#price').val(response[0]['price'].trim());
        console.log(response[0]['price'].trim());

        $('#id').val(checked.val());

        document.getElementById('UserName').innerHTML = response[0]['userName'].trim();
        document.getElementById('Email').innerHTML = "  " + response[0]['email'].trim();
        document.getElementById('Price').innerHTML = "  " + response[0]['price'].trim() + " euros";
        if (response[0]['carName'].toUpperCase().includes("AUDI")) {
            document.getElementById("Img").src = 'img/audi_logo.png';
        } else if (response[0]['carName'].toUpperCase().includes("BMW")) {
            document.getElementById("Img").src = 'img/bmw.jfif';
        } else if (response[0]['carName'].toUpperCase().includes("JAGUAR")) {
            document.getElementById("Img").src = 'img/jaguar.png';
        }
        else {
            document.getElementById("Img").src = 'http://placehold.it/100x100';
        }

        console.log(response);
    });

    request.fail(function (jqXHR, textStatus, errorThrown) {
        console.error('The following error occurred: ' + textStatus, errorThrown);
    });

});







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

        document.getElementById('carNameEdit').value = response[0]['carName'].trim();
        document.getElementById('userNameEdit').value = response[0]['userName'].trim();
        document.getElementById('emailEdit').value = response[0]['email'].trim();
        document.getElementById('priceEdit').value = response[0]['price'].trim();
        document.getElementById('dateEdit').value = response[0]['date'].trim();
    });

    request.fail(function (jqXHR, textStatus, errorThrown) {
        console.error('The following error occurred: ' + textStatus, errorThrown);
    });

});

/*
//dugme za slanje UPDATE zahteva nakon popunjene forme
$('#changeModal').submit(function () {
    event.preventDefault();
    console.log("Izmene");
    const $form = $(this);
    const $inputs = $form.find('input, select, button, textarea');
    const serializedData = $form.serialize();
    console.log(serializedData);
    $inputs.prop('disabled', true);

    // kreirati request za UPDATE handler

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

$('#btn-pretraga').click(function () {

    var para = document.querySelector('#myInput');
    console.log(para);
    var style = window.getComputedStyle(para);
    console.log(style);
    if (!(style.display === 'inline-block') || ($('#myInput').css("visibility") == "hidden")) {
        console.log('block');
        $('#myInput').show();
        document.querySelector("#myInput").style.visibility = "";
    } else {
        document.querySelector("#myInput").style.visibility = "hidden";
    }
});

$('#btn').click(function () {
    $('#pregled').toggle();
});

$('#btnDodaj').submit(function () {
    $('#myModal').modal('toggle');
    return false;
});

$('#btnIzmeni').submit(function () {
    $('#myModal').modal('toggle');
    return false;
});
*/







