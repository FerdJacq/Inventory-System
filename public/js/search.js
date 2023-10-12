$(document).ready(function(){
    $("#myInput").on("keyup", function() {
      var value = $(this).val().toLowerCase();
      $("#myTable tr").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
      });
    });
  });



$(document).ready(function(){
    $('#myTable').on('click', '.add-stock', function() {
        var product_id = $(this).data('product-id');
        $('#product_id').val(product_id);
        $('#addStockModal').modal('show');
    });
});


    function submitForm() {
        var quantity = $('#quantity').val();
        var product_id = $('#product_id').val();

        $.ajax({
            url: "{{ route('products.addStock') }}",
            type: 'POST',
            data: {
                _token: "{{ csrf_token() }}",
                product_id: product_id,
                quantity: quantity
            },
            success: function(data) {
                alert(data.message);
                window.history.back(); // Redirect to the previous page
            },
            error: function(xhr) {
                alert('Error adding stock');
            }
        });
    }


