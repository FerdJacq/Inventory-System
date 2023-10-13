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
            },
            error: function(xhr) {
                alert('Error adding stock');
            }
        });
    }


    function filterFunction() {
        var input, filter, table, tr, td, i;
        input = document.getElementById("mylist");
        filter = input.value.toUpperCase();
        table = document.getElementById("myTable");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
          td = tr[i].getElementsByTagName("td")[5];
          //console.log(i, td);
          if (td) {
            if (td.innerHTML.toUpperCase().indexOf(filter) ===0) {
              tr[i].style.display = "";
            } else {
              tr[i].style.display = "none";
            }
          }
        }
      }


      //refresh button

      $(document).ready(function () { 
        $("button").button(); 

        $("#RBWT").on('click', function () { 
            location.reload(true);
                console.log('ress')
        }); 
    }); 