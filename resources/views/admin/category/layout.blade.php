<!doctype html>
<html lang="en">
  <head>
  	<title>Admin Area</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="{!! asset('api/fontawesome/css/all.css') !!}">
    <link rel="stylesheet" href="{!! asset('admin/css/style.css') !!}">
    <script src="{!! asset('admin/ckeditor/ckeditor.js') !!}"></script>
  </head>
  <body>
	<div class="wrapper d-flex align-items-stretch">
        @include('admin.theme.sidebar')	
        <div id="content">
                @include('admin.theme.nav')
                @if(Session::has('message'))
                <div class="alert alert-success">
                  {{ Session::get('message') }}
                </div>
                @endif	   
                <div class="btn-group" role="group" aria-label="Basic example">
                    <a href="{{ url(Request::route()->getPrefix()) }}" class="btn btn-primary">Quản lý</a>
                    <a href="{{route('category.create')}}" class="btn btn-success">Thêm mới</a>
                </div>
        @yield('content')
        </div>
	</div>
    
  </body>
</html>
<script src="{!! asset('admin/js/jquery.min.js') !!}"></script>
    <script src="{!! asset('admin/js/popper.js') !!}"></script>
    <script src="{!! asset('admin/js/bootstrap.min.js') !!}"></script>
    <script src="{!! asset('admin/js/main.js') !!}"></script>
    
