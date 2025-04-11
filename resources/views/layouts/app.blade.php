<!DOCTYPE html>
<html>

<head>
    <title>@yield('title', 'Product App')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css">

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light px-4">
        <a class="navbar-brand" href="#">My Store</a>
    </nav>

    <main class="py-4">
        <div class="container">
            @yield('content')
        </div>
    </main>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.js"></script>
    <script>
    $(document).ready(function() {
    function updateQuantity(value) {
        $('#quantity_total').val(value);
        $('#buyQuantity').val(value);
    }

    $('.minus').click(function() {
        var $input = $(this).parent().find('input');
        var count = parseInt($input.val()) - 1;
        count = count < 1 ? 1 : count;
        updateQuantity(count);
        return false;
    });

    $('.plus').click(function() {
        var $input = $(this).parent().find('input');
        var count = parseInt($input.val()) + 1;
        var productId = $(this).data('product-id');
        console.log("productId",productId);
        
        let $this = $(this); // store current button
    $.ajax({
        url: "{{ route('check.total') }}",
        method: 'POST',
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            product_id: productId,
            requested_quantity: count
        },
        success: function(response) {
            if (response.available) {
                $input.val(count); 
                updateQuantity(count);
            } else {
                $("#stock_in").text("Only " + parseInt($input.val()) + " " + " left in stock.").addClass("text-info");
                alert('Out of stock or not enough items available');
                $this.hide();
            }
        }
    });
        return false;
    });
});
    </script>
</body>

</html>