@extends('home')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.0/jquery.min.js" integrity="sha512-suUtSPkqYmFd5Ls30Nz6bjDX+TCcfEzhFfqjijfdggsaFZoylvTj+2odBzshs0TCwYrYZhQeCgHgJEkncb2YVQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@section('content')
    <h1>Place an Order</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">

    <form action="{{ route('order.place') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="product_id">Select Product:</label>
            <select name="product_id" id="product_id" class="form-control" required>
                @foreach($products as $product)
                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="quantity">Quantity:</label>
            <input type="number" name="quantity" id="quantity" class="form-control" min="1" required>
        </div>

        <button type="submit" id="id_order" class="btn btn-primary">Place Order</button>
    </form>
@endsection

{{-- looping for concurrent request --}}

{{-- <script>

    // setTimeout(() => {
        
        for ($x = 1; $x <= 5; $x++) {
            create();
        }
        function create(){
            var $form = $( this ),
        url = "http://127.0.0.1:8000/order/place";

    var params= {
        'product_id': 5,
        'quantity': 5,
        '_token': 'GKuwyv7iWiNz2b7Hkr9sytgG60G93j2tongp6sMx'
    };
     console.log(params);
      //Ajax Function to send a get request
      $.ajax({
        method: "POST",
        url: url,
        data:params,
        success: function(response){
            //if request if made successfully then the response represent the data
            
        }
        
      
    });
        }      // Get some values from elements on the page:
      
// }, 5000);
    </script> --}}