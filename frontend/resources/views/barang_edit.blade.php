@extends('layouts.admin')
@section('content')
        <!-- Form for Editing Barang -->
        <form id="editForm">
            <label for="kode">Kode:</label>
            <input type="text" id="kode" class="form-control" name="kode" required>
            <br>
            <br>
            <label for="nama">Nama Barang:</label>
            <input type="text" id="nama" class="form-control" name="nama" required>
            <br>
            <br>
            <label for="harga">Harga:</label>
            <input type="text" id="harga" class="form-control" name="harga" required>
            <br>
            <br>
            <label for="stok">Stok:</label>
            <input type="text" id="stok" class="form-control" name="stok" required>
            <br>
            <br>
            <label for="satuan">Satuan ID:</label>
            <input type="text" id="satuan" class="form-control"  name="satuan" required>
    
            <!-- Hidden input for storing the ID of the item being edited -->
            <input type="hidden" id="editItemId" class="form-control" name="editItemId">
    
            <div class="mt-3">
                <!-- Submit Button for Editing -->
                <button type="submit" class="btn btn-sm btn-primary me-2">Update</button>
                <!-- Back Button (Can be a link to go back) -->
                <a href="/Barang" class="btn btn-sm btn-secondary">Back</a>
            </div>
        </form>
    
        <!-- Script to Populate Form with Existing Data -->
        <script>
            // Get the item ID from the URL
            const urlParams = new URLSearchParams(window.location.search);
            // Get the value of the 'data' parameter
            const dataValue = urlParams.get('data');

            // Convert the data value to a number if needed
            const itemId = parseInt(dataValue);
            // Fetch existing data for editing
            fetch(`http://127.0.0.1:8081/api/Barang/${itemId}`)
                .then(response => response.json())
                .then(existingData => {
                    // Fill the form fields with existing data
                    document.getElementById('kode').value = existingData.kode;
                    document.getElementById('nama').value = existingData.namabarang;
                    document.getElementById('harga').value = existingData.harga;
                    document.getElementById('stok').value = existingData.stok;
                    document.getElementById('satuan').value = existingData.satuan_id;
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
                const editedKode = document.getElementById('kode').value;
                const editedNama = document.getElementById('nama').value;
                const editedHarga = document.getElementById('harga').value;
                const editedStok = document.getElementById('stok').value;
                const editedSatuan = document.getElementById('satuan').value;
                const itemId = document.getElementById('editItemId').value;
                
                // Prepare the data to be sent to the server for update
                const updatedData = {
                    id: itemId,
                    kode: editedKode,
                    namabarang: editedNama,
                    harga: editedHarga,
                    stok: editedStok,
                    satuan_id: editedSatuan,
                };
    
                // Make a PUT request using the Fetch API (replace 'http://example.com/update-endpoint' with your actual update endpoint)
                fetch(`http://127.0.0.1:8081/api/Barang/${itemId}`, {
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
    
                        // Redirect to /Barang on successful update
                        if (data !== null) {
                            window.location.href = '/Barang';
                        }
                    })
                    .catch(error => {
                        console.error('Error updating data:', error);
                    });
            });
        </script>
@endsection
