$('.custom-file input').change(function (e) {
    if (e.target.files.length) {
        $(this).next('.custom-file-label').html(e.target.files[0].name);
    }
});

$(function () {
    //Data Tables
    $(document).ready(function () {
        $("#data-table").DataTable();
    });
    //Date Range Picker
    $('input[name="range"]').daterangepicker({
        format: "yyyy-mm-dd",
    });
    //Initialize Select2 Elements
    $(".select2").select2({
        theme: "bootstrap4",
    });
    $(".select2bulan").select2({
        theme: "bootstrap4",
    });
});
//Confirm Delete SweetAlert2
$(".delete-confirm").on("click", function (event) {
    event.preventDefault();
    var form = $(this).parents("form");
    Swal.fire({
        title: "Yakin Hapus?",
        text: "Data yang telah dihapus tidak dapat dipulihkan!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Hapus!",
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        }
    });
});
//Confirm Delete SweetAlert2
$(".tolak-pengajuan").on("click", function (event) {
    event.preventDefault();
    const url = $(this).attr("href");
    Swal.fire({
        title: "Tolak Pengajuan",
        text: "Anda dapat menyetujui pengajuan kembali",
        icon: "info",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Tolak!",
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = url;
        }
    });
});
//Confirm Reset Rencana SweetAlert2
$(".reset-rencana-confirm").on("click", function (event) {
    event.preventDefault();
    var form = $(this).parents("form");
    Swal.fire({
        title: "Yakin Reset Rencana Ini?",
        text: "Rencana yang telah direset dapat dipilih kembali",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Reset!",
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        }
    });
});
//Confirm Reset Rencana SweetAlert2
$(".reset-realisasi-confirm").on("click", function (event) {
    event.preventDefault();
    var form = $(this).parents("form");
    Swal.fire({
        title: "Yakin Reset Realisasi Ini?",
        text: "Realisasi yang telah direset dapat dipilih kembali",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Reset!",
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        }
    });
});
//Confirm Reset Perilaku SweetAlert2
$(".reset-perilaku-confirm").on("click", function (event) {
    event.preventDefault();
    var form = $(this).parents("form");
    Swal.fire({
        title: "Yakin Reset Nilai Perilaku Ini?",
        text: "Nilai Perilaku yang telah direset dapat dimasukkan kembali",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Reset!",
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        }
    });
});

$(document).ready(function () {
    var countre = 1;
    // var max_fields = 3; //maximum input boxes allowed
    var wrapper = $(".input_fields_wrap"); //Fields wrapper
    var add_button = $(".add_field_button"); //Add button ID

    countre += 1;
    html =
        '<div class="form-group row" id="row' +
        countre +
        '">\
    <label for="kuantitas" class="col-sm-3 col-form-label"></label>\
    <div class="col-sm-2">\
        <input type="number" value="1" min="1"\
            class="form-control" id="kuantitas"\
            name="target_kuantitas[]" required>\
    </div>\
    <div class="col-sm-3">\
        <select class="select2 form-control" name="bulan[]"\
            data-placeholder="Pilih Bulan" style="width: 100%;" required>\
            <option value="" hidden>Pilih Bulan</option>\
            <option value="Januari">Januari</option>\
            <option value="Februari">Februari</option>\
            <option value="Maret">Maret</option>\
            <option value="April">April</option>\
            <option value="Mei">Mei</option>\
            <option value="Juni">Juni</option>\
            <option value="Juli">Juli</option>\
            <option value="Agustus">Agustus</option>\
            <option value="September">September</option>\
            <option value="Oktober">Oktober</option>\
            <option value="November">November</option>\
            <option value="Desember">Desember</option>\
        </select>\
    </div>\
    <div class="col-sm-2">\
        <button class="btn btn-outline-danger remove_field" type="button">Remove</button></div>\
    </div>\
</div>';

    var x = 1; //initlal text box count
    $(add_button).click(function (e) {
        //on add input button click
        e.preventDefault();
        if (x < 12) {
            //max input box allowed
            x++; //text box increment
            $(wrapper).append(html); //add input box
        }
    });

    $(wrapper).on("click", ".remove_field", function (e) {
        //user click on remove text
        e.preventDefault();
        $(this).parent("div").parent("div").remove();
        x--;
    });
});

/* Dengan Rupiah */
var dengan_rupiah = document.getElementById('dengan-rupiah');
dengan_rupiah.addEventListener('keyup', function(e)
{
    dengan_rupiah.value = formatRupiah(this.value, 'Rp. ');
});

/* Fungsi */
function formatRupiah(angka, prefix)
{
    var number_string = angka.replace(/[^,\d]/g, '').toString(),
        split    = number_string.split(','),
        sisa     = split[0].length % 3,
        rupiah     = split[0].substr(0, sisa),
        ribuan     = split[0].substr(sisa).match(/\d{3}/gi);
        
    if (ribuan) {
        separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
    }
    
    rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
    return prefix == undefined ? rupiah : (rupiah ? 'Rp' + rupiah : '');
}

