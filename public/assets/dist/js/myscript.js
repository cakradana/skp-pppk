$(function() {
    //Data Tables
    $(document).ready(function() {
        $('#data-table').DataTable();
    });
    //Date Range Picker
    $('input[name="range"]').daterangepicker({
        format: 'yyyy-mm-dd'
    });
    //Initialize Select2 Elements
    $('.select2').select2({
        theme: 'bootstrap4'
    });           
    $('.select2bulan').select2({
        theme: 'bootstrap4'
    });
});
//Confirm Delete SweetAlert2
$('.delete-confirm').on('click', function (event) {
    event.preventDefault();
    var form = $(this).parents('form');
    Swal.fire({
        title: 'Yakin Hapus?',
        text: "Data yang telah dihapus tidak dapat dipulihkan!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Hapus!'
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        }
    });
});
//Confirm Delete SweetAlert2
$('.tolak-pengajuan').on('click', function (event) {
    event.preventDefault();
    const url = $(this).attr('href');
    Swal.fire({
        title: 'Tolak Pengajuan',
        text: "Anda dapat menyetujui pengajuan kembali",
        icon: 'info',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Tolak!'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = url;
        }
    })
});