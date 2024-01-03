@extends('layouts.admin')
@section('content')    
    <!-- Form for Editing Penjualan -->
    <form id="editForm">
        <label for="nomorTransaksi">Nomor Transaksi:</label>
        <input type="text" id="nomorTransaksi" class="form-control" autocomplete="off" name="nomorTransaksi" required>
        <br>
        <br>
        <label for="totalHarga">Total Harga:</label>
        <input type="text" id="totalHarga" class="form-control" autocomplete="off" name="totalHarga" required>
        <br>
        <br>

        <label for="userId">User ID:</label>
        <select name="user_id" id="userId" class="form-control" required>
            <option value="">--Pilih User--</option>
            @foreach ($user as $item)
                <option value="{{ $item->id }}">{{ $item->name }}</option>
            @endforeach
        </select>
        <br>
        <br>
        <!-- Hidden input for storing the ID of the item being edited -->
        <input type="hidden"  id="editItemId" name="editItemId">

        <!-- Submit Button for Editing -->
        <button type="submit" class="btn btn-sm btn-primary me-2">Update</button>

        <!-- Back Button (Can be a link to go back) -->
        <a href="/Penjualan" class="btn btn-sm btn-secondary">Back</a>
    </form>

    <!-- Script to Populate Form with Existing Data -->
    <script>
          const urlParams = new URLSearchParams(window.location.search);
            // Get the value of the 'data' parameter
            const dataValue = urlParams.get('data');

            // Convert the data value to a number if needed
            const itemId = parseInt(dataValue);

        // Fetch existing data for editing
        fetch(`http://127.0.0.1:8081/api/Penjualan/${itemId}`)
            .then(response => response.json())
            .then(existingData => {
                // Fill the form fields with existing data
                document.getElementById('nomorTransaksi').value = existingData.nomortransaksi;
                document.getElementById('totalHarga').value = existingData.totalharga;
                const userIdSelect = document.getElementById('userId');
                for (let i = 0; i < userIdSelect.options.length; i++) {
                    if (userIdSelect.options[i].value == existingData.user_id) {
                        userIdSelect.options[i].selected = true;
                        break;
                    }
                }
                document.getElementById('editItemId').value = existingData.id;
            })
            .catch(error => {
                console.error('Error fetching existing data:', error);
            });
    </script>

    <!-- Script to Handle Edit Form Submission -->
    <script>
        document.getElementById('editForm').addEventListener('submit', function(event) {
            event.preventDefault();
            // Get the edited values
            const editedNomorTransaksi = document.getElementById('nomorTransaksi').value;
            const editedTotalHarga = document.getElementById('totalHarga').value;
            const itemId = document.getElementById('editItemId').value;
            const editedUserId = document.getElementById('userId').value;

            // Prepare the data to be sent to the server for update
            const updatedData = {
                id: itemId,
                nomortransaksi: editedNomorTransaksi,
                totalharga: editedTotalHarga,
                user_id: editedUserId,
            };

            // Make a PUT request using the Fetch API (replace 'http://example.com/update-endpoint' with your actual update endpoint)
            fetch(`http://127.0.0.1:8081/api/Penjualan/${itemId}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(updatedData),
                })
                .then(response => response.json())
                .then(data => {
                    // Handle the response from the server
                    console.log('Update response:', data);

                    // Redirect to /Penjualan on successful update
                    if (data !== null) {
                        window.location.href = '/Penjualan';
                    }
                })
                .catch(error => {
                    console.error('Error updating data:', error);
                });
        });
    </script>
@endsection
