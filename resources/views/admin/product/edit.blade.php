@extends('admin.product.layout')
@section('content')
<form action="{{route("product.update", $product->id)}}" method="POST" enctype="multipart/form-data" id = 'cart'>
    @csrf
   <div class="form-group">
     <label for="idcat">Category:</label>
        <select name="idcat" class="form-control">
            @foreach ($category as $cate)
            <option value="{{$cate->id}}">{{$cate->name}}</option>
                
            @endforeach
        </select>
   </div>
    <div class="form-group">
     <label for="name">Name:</label>
     <input type="text" class="form-control" name="name" value="{{$product->name}}">
   </div>
   <div class="form-group">
     <label for="images">Image:</label>
     <input type="file" class="form-control"name="images" value="{{$product->images}}">
   </div>
   <div class="form-group">
    <label for="price">Price:</label>
    <input type="text" class="form-control"name="price" value="{{$product->price}}">
  </div>
  <div class="form-group">
    <label for="discount">Discount:</label>
    <input type="text" class="form-control"name="discount" value="{{$product->discount}}">
  </div>
  <div class="form-group">
    <label for="content">Content:</label>
    <textarea class="form-control" name="content">{!! $product->content !!}</textarea>
  </div>

   <button name="btn_editproduct"class="btn btn-primary" id = 'editbtn'>Thực Hiện</button>

 </form>
 <script type="text/javascript">
  $( document ).ready(function() {
   
   $("#cart").on('click', '#editbtn', function (e) {

        e.preventDefault();

        var data = $("#cart").serializeArray();

        console.log(data)

        var ele = $(this);

        var url = $("#cart").attr("action");

         $.ajax({
             url: url,
             method: "put",
             data: data,
             success: function (response) {
              if(response.success) {
                window.location.href = '{{ route('product.index') }}';
              } else {
                // alert loi
                alert(response.message)
              }
              
             //    window.location.reload();
                 // $('tr[data-product-id="'+id+'"]').remove();

                //  $('#cart tbody').html(response.cart_body);
            }
         });
     });
  });
 </script>
 </div>
 @stop
