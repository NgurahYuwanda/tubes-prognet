@extends('layouts.admin')
@section('content')    
  <form id="myForm">
    <label for="satuan">Satuan:</label>
    <input type="text" id="satuan" class="form-control" name="satuan" autocomplete="off" required>
    <br>
    <!-- Submit Button -->
    <button type="submit" class="btn btn-sm btn-primary me-1">Submit</button>

    <!-- Back Button (Can be a link to go back) -->
    <a href="/SatuanBarang" class="btn btn-sm btn-secondary">Back</a>
  </form>

  <!-- Script to Handle Form Submission with Fetch API -->
  <script>
    document.getElementById('myForm').addEventListener('submit', function(event) {
      event.preventDefault();

      // Get the value of the 'satuan' input
      const satuanValue = document.getElementById('satuan').value;

      // Prepare the form data
      const formData = new FormData();
      formData.append('satuan', satuanValue);

      // Make a POST request using the Fetch API
      fetch('http://127.0.0.1:8081/api/SatuanBarang', {
          method: 'POST',
          body: formData
        })
        .then(response => response.json())
        .then(data => {
          // Handle the response from the server (you can replace this with your logic)
          console.log('Server response:', data);
          if (data !== null) {
            window.location.href = '/SatuanBarang';
          }
        })
        .catch(error => {
          console.error('Error submitting form:', error);
        });
    });
  </script>
@endsection
