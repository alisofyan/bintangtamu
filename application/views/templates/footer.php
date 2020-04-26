<div class="row foot">
    <div class="col text-center">
        <p>2019 All Rights &copy Reserved By CargiGS</p>
    </div>
</div>
<!-- akhi footer -->

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="<?= base_url(); ?>assets/js/jquery-3.3.1.slim.min.js"></script>
<script src="<?= base_url(); ?>assets/js/jquery-3.3.1.min.js"></script>
<script src="<?= base_url(); ?>assets/js/popper.min.js"></script>
<script src="<?= base_url(); ?>assets/js/bootstrap.min.js"></script>
<script src="<?= base_url(); ?>assets/js/style.js"></script>

<script>
    var data = {
        "band": "band",
        "penari": "penari",
        "stand up comedy": "stand up comedy"
    };
    $('#cari').click(function() {
        var gs1 = $('#genregs1 option:selected').val();
        var gs2 = $('#genregs2 option:selected').val();
        var gs3 = $('#genregs3 option:selected').val();
        var lks1 = $('#lokasigs1 option:selected').val();
        var lks2 = $('#lokasigs2 option:selected').val();
        var lks3 = $('#lokasigs3 option:selected').val();
        var lks4 = $('#lokasigs4 option:selected').val();
        var lks5 = $('#lokasigs5 option:selected').val();
        if (gs1 == gs2 ||
            gs2 == gs3 ||
            gs3 == gs1) {
            // $('#modalpop').modal('show');
            alert("Pilih jenis pertunjukan yang berbeda!");
            return false;
        }
        if (lks1 == lks2 ||
            lks1 == lks3 ||
            lks1 == lks4 ||
            lks1 == lks5 ||
            lks2 == lks3 ||
            lks2 == lks4 ||
            lks2 == lks5 ||
            lks3 == lks4 ||
            lks3 == lks5 ||
            lks4 == lks5
        ) {
            alert("Pilih lokasi yang berbeda!");
            return false;
            // window.stop();
        }
    });
    $(document).ready(function() {
        // var str = document.getElementById("genregs1").value;
        // var str1 = document.getElementById("genregs2").value;
        // console.log(str);


        function getAllSelectValue() {
            return ["data"]; //
        };

        function populateValue() {
            // get all select value => penari
            //each element select {
            $("#filter-pertama option").each(function() {
                var valuenya = ($(this).val());
                // $.each(data, function(key, value) {
                //     console.log(key + ": " + value);
                // });
            });
            //loop data not "get all select value"

            //options isi

            //$(this).
            //}
        };
        $("#filter-pertama select").on("change", function() {
            // var selectedJenis = $(this).children("option:selected").val();
            //console.log(selectedJenis);
            // populateValue();
            //   $('#genregs1').append('<option value="foo" selected="selected">Foo</option>');

        });
    });
</script>
</body>

</html>