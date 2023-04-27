@extends('admin.user.layout')
@section('content')   
         <form action="{{ route('user.edit', ['id' => $user->id]) }}" method="POST">
           {{ csrf_field() }}
          <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" name="txtname" value="{{$user->name}}">
          </div>
           <div class="form-group">
            <label for="email">Email:</label>
            <input type="text" class="form-control" id="email" name="txtemail" value="{{$user->email}}">
          </div>
          <div class="form-group">
            <label for="role">Role:</label>
            <select name="role">
              <option value="admin" {{$user->role == 'admin' ? 'selected' : ''}}>Admin</option>
              <option value="user" {{$user->role == 'user' ? 'selected' : ''}}>User</option>
            </select>
          </div>
          <div class="form-group">
            <label for="pwd">Password:</label>
            <input type="text" class="form-control" id="pwd" name="txtpassword" value="">
          </div>
             <div class="form-group">
                 <label for="status">Status:</label>
                 <select name="status">
                     <option value="1" {{$user->status == 1 ? 'selected' : ''}}>Active</option>
                     <option value="0" {{$user->status == 0 ? 'selected' : ''}}>Inactive</option>
                 </select>
             </div>
          <button type="submit" name="btnregister"class="btn btn-primary">Thực Hiện</button>
        </form>
<@stop