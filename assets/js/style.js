$(document).ready(function () {


    function populateValue() {
        // get all select value => penari
        //each element select {
        $("#filter-pertama option").each(function () {
            var valuenya = ($(this).val());
            // $.each(data, function(key, value) {
            console.log(key + ": " + value);
            // });
        });
    };
    $("#filter-pertama select").on("change", function () {
        var selectedJenis = $(this).children("option:selected").val();
        // console.log(selectedJenis);
        // populateValue();
        //   $('#genregs1').append('<option value="foo" selected="selected">Foo</option>');
    });
});