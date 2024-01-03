@extends('layouts.admin')
@section('content')
<!-- Form -->
    <form id="myForm">
        <label for="nomortransaksi">Nomor Transaksi:</label>
        <input type="text" id="nomortransaksi" class="form-control" autocomplete="off" name="nomortransaksi" required>
        <br>
        <label for="totalharga">Total Harga:</label>
        <input type="text" id="totalharga" class="form-control" autocomplete="off" name="totalharga" required>
        <br>
        <label for="user_id">User ID:</label>
        {{-- <input type="text" id="user_id" name="user_id" required> --}}
        <select name="user_id" id="user_id" class="form-control" required>
            <option value="">--Pilih User--</option>
            @foreach ($user as $item)
                <option value="{{ $item->id }}">{{ $item->name }}</option>
            @endforeach
        </select>
        <br>
        <!-- Submit Button -->
        <button type="submit" class="btn btn-sm btn-primary me-2">Submit</button>

        <!-- Back Button (Can be a link to go back) -->
        <a href="/Penjualan" class="btn btn-sm btn-secondary">Back</a>
    </form>

    <!-- Script to Handle Form Submission with Fetch API -->
    <script>
        document.getElementById('myForm').addEventListener('submit', function(event) {
            event.preventDefault();

            // Get the values of the form inputs
            const nomortransaksiValue = document.getElementById('nomortransaksi').value;
            const totalhargaValue = document.getElementById('totalharga').value;
            const user_idValue = document.getElementById('user_id').value;

            // Prepare the form data
            const formData = new FormData();
            formData.append('nomortransaksi', nomortransaksiValue);
            formData.append('totalharga', totalhargaValue);
            formData.append('user_id', user_idValue);

            // Make a POST request using the Fetch API
            fetch('http://127.0.0.1:8081/api/Penjualan', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    // Handle the response from the server (you can replace this with your logic)
                    console.log('Server response:', data);
                    if (data !== null) {
                        window.location.href = '/Penjualan';
                    }
                })
                .catch(error => {
                    console.error('Error submitting form:', error);
                });
        });

        // Script to handle the detail button click
        document.getElementById('detailButton').addEventListener('click', function() {
            
            console.log('Detail button clicked');
        });
    </script>
    
@endsection