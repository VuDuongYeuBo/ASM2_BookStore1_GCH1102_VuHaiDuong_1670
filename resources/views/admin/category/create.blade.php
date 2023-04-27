@extends('admin.category.layout')
@section('content')
<form action="{{route('category.store')}}" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="form-group">
     <label for="name">Name:</label>
     <input type="text" class="form-control" name="name">
   </div>
   <div class="form-group">
     <label for="image">Image:</label>
     <input type="file" class="form-control"name="image">
   </div>
  <div class="form-group">
    <label for="content">Content:</label>
    <textarea class="form-control" id="contents" name="content"></textarea>
    <script>CKEDITOR.replace('contents');</script>
  </div>
   <button type="submit" name="btn_addcategory"class="btn btn-primary">Thực Hiện</button>
 </form>
 </div>
 @stop
