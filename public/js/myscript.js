$(document).on('click','#start_date',function(e){
        e.preventDefault();
      
        $('#date_start').removeAttr('disabled');
})

 $('#end_date').on('click',function(e){
        e.preventDefault();
        $('#date_end').removeAttr('disabled');
})
const flashData = $('.flash-data').data('flashdata');
if (flashData) {
    Swal.fire({
        title: 'Data ' + flashData,
        text: 'berhasil ditambahkan',
        icon: 'success',
        confirmButtonText: 'Ok'
    });
};
const validate = $('.validate').data('validate');
if (validate) {
    $('#modalPeminjaman').modal('show')
};

const flashDalete = $('.flash-delete').data('delete');
const flash_Dalete = $('.flash-delete').data('flashdelete');
if (flashDalete || flash_Dalete) {
    Swal.fire(
        'Deleted!',
        'Your data has been deleted.',
        'success'
    )
};

const flash_Gagal = $('.flash-gagal').data('gagal');
if (flash_Gagal) {
    Swal.fire(
        'Gagal!',
        'Tidak bisa meminjam buku lebih dari 3 kali.',
        'warning'
    )
};
const flash_perpanjang = $('.flash-perpanjang').data('perpanjang');
if (flash_perpanjang) {
    Swal.fire(
        'Gagal!',
        'Tidak bisa perpanjang buku lebih dari 1 kali.',
        'warning'
    )
};

const flashUpdate = $('.flash-update').data('update');
if (flashUpdate) {
    Swal.fire({
        title: 'Data ' + flashUpdate,
        text: 'berhasil diupdate',
        icon: 'success',
        confirmButtonText: 'Ok'
    });
};





$('.edit-peminjaman').on('click', function() {
    const id = $(this).data('id');
    $.ajax({
        type: 'POST',
        data: {
            id: id
        },
        dataType: 'JSON',
        url: base_url + "ajax/editPeminjaman",
        async: true,
        success: function(data) {
            console.log(data);
            $.each(data, function() {
                $('#e_id').val(data.id_peminjaman);
                $('#e_bk2').val(data.id_buku);
                $('#e_tgl').val(data.tgl_pinjam);
                $('#e_anggota').val(data.id_anggota);
                $('#e_buku').val(data.id_buku);
                $('#e_status').val(1);

            });
        }
    })
});

    // contoh insert dengan ajax
    //  $('#edit_petugas').on('submit',function(){

//      $.ajax({
//         type : 'POST',
//         data : $(this).serialize(),
//         dataType:'JSON',
//         url: base_url+"ajax/updatePetugas",
//         async: true,
//         success:function(data){
//             Swal.fire({
//             title: 'Data Petugas',
//             text: 'berhasil diubah',
//             icon: 'success',
//             confirmButtonText: 'Ok'
//     });
//         }
//      });
//  });

