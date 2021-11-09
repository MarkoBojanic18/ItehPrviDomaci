$('#addButton').submit(function () {
    event.preventDefault();
    console.log("Dodaj je pokrenuto");
    const $form = $(this);
    const $inputs = $form.find('input,select,button,textarea');

})