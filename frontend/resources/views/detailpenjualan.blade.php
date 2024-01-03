@extends('layouts.admin')
@section('content')
<div class="d-flex  justify-content-end">
    <a href="{{ route('DetailPenjualan.create') }}" class="btn btn-sm btn-primary mb-3">Tambah</a>
</div>
    <table class="table table-borderless">
        <thead>
            <tr>
                <th>ID</th>
                <th>Penjualan ID</th>
                <th>Barang ID</th>
                <th>Kuantitas</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody id="table-detail">

        </tbody>
    </table>
    <script>
    $(document).ready(function () {
     loadBarang();
     function loadBarang(){
       $.ajax({
         type: "GET",
         url: "http://127.0.0.1:8081/api/DetailPenjualan",
         dataType: "JSON",
         success: function (response) {
             var row ='';
             var no = 1;
             if (response.length === 0) {
                     row = '<tr><td  class="text-center" colspan="5">Data Tidak Ditemukan</td></tr>';
                   }else {
                     for (i = 0; i < response.length; i++) {
                       row += '<tr class="">' +
                       '<td>' + no++ + '</td>' +
                       '<td>' + response[i].penjualan.nomortransaksi + '</td>' +
                       '<td>' + response[i].barang.namabarang + '</td>' +
                       '<td>' + response[i].kuantitas + '</td>' +
                       '<td>' + 
                        // '<a href="#" class="btn btn-warning btn-sm edit-btn" data-id="' + response[i].id + '" style="margin-left:5px"><i class="mdi mdi-pencil" ></i>Edit</a>' +
                        '<button type="button" data-id="' + response[i].id + '" class="btn btn-sm btn-danger delete" style="margin-left:5px"><i class="mdi mdi-delete"></i>Hapus</button>'
                         +
                       '</td>' +
                      '</tr>';
                     }
                 }
                 $('#table-detail').html(row);
                //  $('.edit-btn').click(function() {
                //     var id = $(this).data('id');
                //     window.location.href = '/Barang/' + id + '/edit?data=' + id;
                // });
                $('.delete').click(function() {
                  var id = $(this).data('id');
                  Swal.fire({
                      icon : 'warning',
                      title: "Apakah Anda Yakin?",
                      text : "Data akan dihapus selamanya",
                      showDenyButton: true,
                      showCancelButton: false,
                      confirmButtonText: "Iya",
                      denyButtonText: `Tidak`
                    }).then((result) => {
                      /* Read more about isConfirmed, isDenied below */
                      if (result.isConfirmed) {
                        
                        $.ajax({
                          type: "DELETE",
                          url: "http://127.0.0.1:8081/api/DetailPenjualan/" + id,
                          success: function (response) {
                            loadBarang();
                            Swal.fire("Data Berhasil Dihapus", "", "success");
                          }
                        });
                      }
                    });
                });
         }
       });
     }
});
    </script>
@endsection