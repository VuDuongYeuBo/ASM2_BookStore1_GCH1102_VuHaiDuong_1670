@extends('admin.category.layout')
@section('content')
<table class="table table-hover">
  <thead>
    <th>Image</th>
    <th>Name</th>
    <th>View product</th>
    <th>Edit</th>
    <th>Delete</th>
  </thead>
  <tbody>
    @foreach($cate ?? '' as $category)
      <tr>
        <td><img src="{{asset('images/'. $category->image)}}" width="40" /></td>
        <td>{{$category->name}} </td>
        <td><a href="{{route('category.productlist', $category->id)}}" class="btn btn-outline-primary"><i class="fa fa-eye"></i></a></td>
        <td><a href="{{route('category.edit', $category->id)}}" class="btn btn-primary"><i class="fa fa-edit"></i></a></td>
        <td>
        <form action="{{route('category.destroy', $category->id)}}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
        </td>
       
        </form>
      </tr>
      @endforeach
  </tbody>
</table>
@stop
  