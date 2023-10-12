@extends('home') <!-- If you have a custom layout you want to extend -->

@section('content')
    <h1>Add Stock</h1>

    <form id="addStockForm">
        @csrf
        <div class="form-group">
            <label for="quantity">Quantity to Add:</label>
            <input type="number" class="form-control" id="quantity" name="quantity" min="1" required>
        </div>
        <button type="submit" class="btn btn-primary">Add Stock</button>
    </form>

    <script>
        $(document).ready(function(){
            $('#addStockForm').on('submit', function(e){
                e.preventDefault();
                var quantity = $('#quantity').val();

                $.ajax({
                    url: "{{ route('products.addStock', $product->id) }}",
                    type: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                        quantity: quantity
                    },
                    success: function(data) {
                        alert(data.message);
                        location.reload(); // Refresh the page after successful stock addition
                    },
                    error: function(xhr) {
                        alert('Error adding stock');
                    }
                });
            });
        });
    </script>
@endsection
