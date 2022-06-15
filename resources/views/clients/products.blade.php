{{-- gọi tới layout muốn kế thừa --}}
@extends('layouts.client')
{{-- code thao tác với giao diện  --}}
{{-- đặt tên section giống như tên cảu yield đặt ở bên layout --}}

@section('title')
     {{$title}}
@endsection


@section('sidebar')
     {{-- kết thừ từ layout cha và bổ sung thêm thành phần con --}}
     @parent 
     <h3>Products</h3>
@endsection

@section('content')
     @if(session('msg'))
          <div class="alert alert-success">{{session('msg')}}</div>
     @endif
     <h1>Prducts</h1>  
@endsection 

@section('js')
    
@endsection