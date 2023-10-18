@extends('home')

@section('content')
<div><h1>Product List</h1></div>
<div class="row">
    <div class="column">
      <a href="{{ route('products.create') }}" class="btn btn-primary">Create Product</a>
      </div>
      <div class="column">
        <input id="myInput" type="text" placeholder="Search..">
        <div id="autocomplete-list"></div>
    </div>
      <div class="column">
      <div class="filter-group">
              <label>Status</label>
              <select style="width:150px;" id="mylist" onchange="filterFunction()" class="form-control">
                <option>INSTOCK</option>
                <option>Out of Stock</option>
              </select>
              <a> <img src="{{ url('storage/icons/icons8-refresh-50.png') }}" alt="" title=""  id="RBWT" /></a>
            </div>
            <span class="filter-icon"><i class="fa fa-filter"></i></span>
      </div>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>Product ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="myTable">
            @foreach($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->name }}</td>
                <td class="prod-descrip">{{ $product->description }}</td>
                <td>{{ $product->quantity }}</td>
                <td>{{ $product->price }}</td>
                @if($product->quantity > 0 )
                    <td>INSTOCK</td>
                @else
                    <td>Out of STOCK</td>
                @endif
                <td>
                    <a href="{{ route('products.show', $product->id) }}" class="btn btn-info">Show</a>
                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary">Edit</a>
                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                    <a href="#" class="btn btn-success add-stock" data-product-id="{{ $product->id }}">Add Stock</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Add Stock Modal -->
<div class="modal fade" id="addStockModal" tabindex="-1" role="dialog" aria-labelledby="addStockModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addStockModalLabel">Add Stock</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="addStockForm" action="{{ route('products.addStock') }}" method="POST">
                @csrf
                <input type="hidden" name="product_id" id="product_id">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="quantity">Quantity to Add:</label>
                        <input type="number" class="form-control" id="quantity" name="quantity" min="1" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" onclick="submitForm()">Add Stock</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

<script>
    $(document).ready(function() {
    $('#myInput').on('keyup', function() {
        let query = $(this).val();

        $.ajax({
            url: "{{route('search')}}",
            method: 'GET',
            data: { query: query },
            success: function(response) {
                let suggestions = response;
                let autocomplete = $('#autocomplete-list');

                autocomplete.empty();

                suggestions.forEach(function(item) {
                    let option = $('<div>').text(item);
                    autocomplete.append(option);
                });

                $('#autocomplete-list div').on('click', function() {
                    $('#myInput').val($(this).text());
                    autocomplete.empty();
                });
            }
        });
    });
});
</script>
