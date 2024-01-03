@extends('layouts.admin')
@section('content')
<!-- Form -->
<form id="myForm">
    <label for="kode">Kode:</label>
    <input type="text" id="kode" class="form-control" name="kode" autocomplete="off" required>
    <br>
    <label for="namabarang">Nama Barang:</label>
    <input type="text" id="namabarang" class="form-control" name="namabarang" autocomplete="off" required>
    <br>
    <label for="harga">Harga:</label>
    <input type="text" id="harga" class="form-control" name="harga" autocomplete="off" required>
    <br>
    <label for="stok">Stok:</label>
    <input type="text" id="stok" class="form-control" name="stok" autocomplete="off" required>
    <br>
    <label for="satuan_id">Satuan ID:</label>
    <input type="text" id="satuan_id" class="form-control" name="satuan_id" autocomplete="off" required>
    <br>
    <div class="mt-3">
        <!-- Submit Button for Editing -->
        <button type="submit" class="btn btn-sm btn-primary me-2">Create</button>
        <!-- Back Button (Can be a link to go back) -->
        <a href="/Barang" class="btn btn-sm btn-secondary">Back</a>
    </div>
</form>

<!-- Script to Handle Form Submission with Fetch API -->
<script>
    document.getElementById('myForm').addEventListener('submit', function(event) {
        event.preventDefault();

        // Get the values of the form inputs
        const kodeValue = document.getElementById('kode').value;
        const namabarangValue = document.getElementById('namabarang').value;
        const hargaValue = document.getElementById('harga').value;
        const stokValue = document.getElementById('stok').value;
        const satuan_idValue = document.getElementById('satuan_id').value;

        // Prepare the form data
        const formData = new FormData();
        formData.append('kode', kodeValue);
        formData.append('namabarang', namabarangValue);
        formData.append('harga', hargaValue);
        formData.append('stok', stokValue);
        formData.append('satuan_id', satuan_idValue);

        // Make a POST request using the Fetch API
        fetch('http://127.0.0.1:8081/api/Barang', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                // Handle the response from the server (you can replace this with your logic)
                console.log('Server response:', data);
                if (data !== null) {
                    window.location.href = '/Barang';
                }
            })
            .catch(error => {
                console.error('Error submitting form:', error);
            });
    });
</script>    
@endsection
