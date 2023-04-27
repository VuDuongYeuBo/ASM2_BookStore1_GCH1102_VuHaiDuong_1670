@extends('admin.product.layout')
@section('content')
        <table class="table table-hover" id="cart">
              <thead>
                <th>Image</th>
                <th>Name</th>
                <th>Price</th>
                <th>Discount</th>
                <th>Edit</th>
                <th>Delete</th>
              </thead>
              <tbody>
                @fragment('cart-body')
                @foreach($products ?? '' as $product)
                  <tr>
                    <td><img src="{{asset('images/'. $product->image)}}" width="40" /></td>
                    <td>{{$product->name}} </td>
                    <td>{{$product->price}} </td>
                    <td>{{$product->discount}} </td>
                    <td><a href="{{route('product.edit', $product->id)}}" class="btn btn-primary"><i class="fa fa-edit"></i></a></td>
                    <td>
                      <button class="btn btn-danger" data-url="{{ route('product.destroy',['product' => $product->id]) }}">
                        <i class="fa fa-trash"></i></button>
                    </td>
                    </form>
                  </tr>
                @endforeach
                @endfragment
              </tbody>
          </table>
          <script type="text/javascript">
             $( document ).ready(function() {
              
              $("#cart").on('click', '.btn-danger', function (e) {
                console.log('vao')
                   e.preventDefault();                 
                   var ele = $(this);
        
                   var url = ele.attr("data-url");
        
                    $.ajax({
                        url: url,
                        method: "delete",
                        data: {
                          _token: '{{ csrf_token() }}',
                        },
                        success: function (response) {
                        //    window.location.reload();
                            // $('tr[data-product-id="'+id+'"]').remove();
        
                            $('#cart tbody').html(response.cart_body);
                       }
                    });
                });
             });
            </script>
@stop
  