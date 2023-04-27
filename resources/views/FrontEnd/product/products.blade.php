@extends('FrontEnd.product.layout')

@section('title', 'Products')

@section('content')
    <?php //unset(session('cart')) ?>
    <div class="container products">

        <div class="row">

            @foreach($products as $product)
                <div class="col-xs-18 col-sm-6 col-md-3">
                    <div class="thumbnail">
                        <img src="{{asset('images/'. $product->image)}}" width="500" height="300" />
                        <div class="caption">
                            <h4>{{ $product->name }}</h4>
                            <p>{{ strtolower($product->description) }}</p>
                            <p><strong>Price: </strong> {{ number_format($product->price) }} đ</p>

                                <p class="btn-holder"><a href="#" 
                                    class="btn btn-warning btn-block text-center add-to-cart-btn" role="button" data-url="{{ route('add-to-cart', ['id' => $product->id]) }}">Thêm vào giỏ hàng</a> </p>
                        </div>
                    </div>
                </div>
            @endforeach

        </div><!-- End row -->

    </div>

    <script>
        $( document ).ready(function() {
            $('.add-to-cart-btn').click(function(event) {
                event.preventDefault();

                var url = $(this).attr('data-url');
                // lay crsf token tren header   
                var token = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    method: "POST",
                    url: url,
                    headers: {
                        'X-CSRF-TOKEN': token
                    }
                })
                .done(function( response ) {
                    $('#cart-items').html(response.cart);
                    console.log(response)
                    // alert( "Data Saved: " + msg );
                });
            });
        });
    </script>

@endsection