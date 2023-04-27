@extends('FrontEnd.product.layout')

@section('title', 'Cart')

@section('content')`
<form id="cart-form">
    <table id="cart" class="table table-hover table-condensed">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        
        <thead>
        <tr>    
            <th style="width:50%">Product</th>
            <th style="width:10%">Price</th>
            <th style="width:8%">Quantity</th>
            <th style="width:22%" class="text-center">Thành tiền</th>
            <th style="width:10%"></th>
        </tr>
        </thead>
        <tbody>

        @fragment('cart-body')
        <?php $total = 0 ;?>

        @if(session('cart'))
            @foreach(session('cart') as $id => $details)

                <?php $total += $details['price'] * $details['quantity'] ?>

                <input type="hidden" name="items[{{$id}}][quantity]" value="{{$details['quantity']}}">
                <input type="hidden" name="items[{{$id}}][product_id]" value="{{ $id }}">
                <input type="hidden" name="items[{{$id}}][price]" value="{{ $details['price'] }}">

                <tr data-product-id="{{ $id }}">
                    <td data-th="Product">
                        <div class="row">
                            <div class="col-sm-3 hidden-xs">
                            <img src="{{ asset('images/'.$details['image']) }}" width="100" height="100" class="img-responsive"/>
                            </div>
                            <div class="col-sm-9">
                                <h4 class="nomargin">{{ $details['name'] }}</h4>
                            </div>
                        </div>
                    </td>
                    <td data-th="Price">${{ $details['price'] }}</td>
                    <td data-th="Quantity">
                        <input type="number" value="{{ $details['quantity'] }}" class="form-control quantity" />
                    </td>
                    <td data-th="Subtotal" class="text-center">{{ number_format($details['price'] * $details['quantity']) }}</td>
                    <td class="actions" data-th="">
                        <button class="btn btn-primary btn update-cart" data-id="{{ $id }}"><i class="fas fa-sync-alt"></i></button>
                        <button class="btn btn-danger btn remove-from-cart" data-id="{{ $id }}"><i class="fas fa-trash"></i></button>
                    </td>
                </tr>
            @endforeach
        @endif

        @endfragment
        </tbody>
        <tfoot>
            @fragment('cart-footer')
            <tr class="visible-xs">
                <td class="text-center"><strong>Tạm tính {{ number_format($total) }}đ</strong></td>
            </tr>
            <tr>
                <td><a href="{{ url('/product') }}" class="btn btn-warning"><i class="fa fa-angle-left"></i> Tiếp tục mua hàng</a></td>
                <td colspan="2" class="hidden-xs"></td>
                <td class="hidden-xs text-center">
                    <strong>Tổng tiền {{ number_format($total) }}đ</strong>
                    <div>
                        <button type="button" class="btn btn-primary btn thanh-toan-btn">Thanh toan</button>
                    </div>
                </td>
            </tr>
            @endfragment
        </tfoot>
    </table>
</form>
@endsection

@section('scripts')


    <script type="text/javascript">

    $('#cart-form').on('click', '.thanh-toan-btn', function (e) {
        e.preventDefault();
        var data = $('#cart-form').serializeArray();

        // console.log(data);

        $.ajax({
            url: '{{ route('order.create') }}',
            method: "post",
            data: data,
            success: function (response) {
                window.location.reload();
                // if(response.success) {
                   
                // }
            }
            });
    });

    $("#cart").on('click', '.update-cart', function (e) {
           e.preventDefault();

           var ele = $(this);

           var id = ele.attr("data-id");

            $.ajax({
                url: '{{ route('update-cart') }}',
                method: "patch",
                data: {_token: '{{ csrf_token() }}',
                id: ele.attr("data-id"),
                quantity: ele.parents("tr").find(".quantity").val()},
                success: function (response) {
                //    window.location.reload();
                    // $('tr[data-product-id="'+id+'"]').remove();

                    $('#cart tbody').html(response.cart_body);
                    $('#cart tfoot').html(response.cart_footer);
               }
            });
        });

        $("#cart").on('click', '.remove-from-cart', function (e) {
            e.preventDefault();

            var ele = $(this);

            var id = ele.attr("data-id");

            if(confirm("Are you sure")) {
                $.ajax({
                    url: '{{ route('remove-from-cart') }}',
                    method: "DELETE",
                    data: {
                        _token: '{{ csrf_token() }}', 
                        id: id
                    },
                    success: function (response) {
                        // $('tr[data-product-id="'+id+'"]').remove();

                        $('#cart tbody').html(response.cart_body);
                        $('#cart tfoot').html(response.cart_footer);
                        

                        // window.location.reload();
                    }
                });
            }
        });

    </script>

@endsection