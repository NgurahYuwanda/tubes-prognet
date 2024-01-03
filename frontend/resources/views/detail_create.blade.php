@extends('layouts.admin')
@section('content')
    <form id="myForm">
        <label for="penjualan_id">Penjualan ID:</label>
        <select name="penjualan_id" id="penjualan_id" class="form-control">
            <option value="">--Pilih Nomor Transaksi--</option>
            @foreach ($penjualan as $item)
                <option value="{{ $item->id }}">{{ $item->nomortransaksi }}</option>
            @endforeach
        </select>
        <br>
        <label for="barang_id">Barang ID:</label>
        <select name="barang_id" id="barang_id" class="form-control">
            <option value="">--Pilih Barang--</option>
            @foreach ($barang as $b)
                <option value="{{ $b->id }}">{{ $b->namabarang }}</option>
            @endforeach
        </select>
        <br>
        <label for="kuantitas">Kuantitas:</label>
        <input type="text" id="kuantitas" class="form-control" autocomplete="off" name="kuantitas" required>
        <br>
        <!-- Submit Button -->
        <button type="submit" class="btn btn-sm btn-primary me-2">Submit</button>

        <!-- Back Button (Can be a link to go back) -->
        <a href="/DetailPenjualan" class="btn btn-sm btn-secondary">Back</a>
    </form>

    <!-- Script to Handle Form Submission with Fetch API -->
    <script>
        document.getElementById('myForm').addEventListener('submit', function(event) {
            event.preventDefault();

            // Get the values of the form inputs
            const penjualan_idValue = document.getElementById('penjualan_id').value;
            const barang_idValue = document.getElementById('barang_id').value;
            const kuantitasValue = document.getElementById('kuantitas').value;

            // Prepare the form data
            const formData = new FormData();
            formData.append('penjualan_id', penjualan_idValue);
            formData.append('barang_id', barang_idValue);
            formData.append('kuantitas', kuantitasValue);

            // Make a POST request using the Fetch API
            fetch('http://127.0.0.1:8081/api/DetailPenjualan', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    // Handle the response from the server (you can replace this with your logic)
                    console.log('Server response:', data);
                    if (data !== null) {
                        window.location.href = '/DetailPenjualan';
                    }
                })
                .catch(error => {
                    console.error('Error submitting form:', error);
                });
        });
    </script>
@endsection