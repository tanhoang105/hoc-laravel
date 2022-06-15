{{-- gọi tới layout muốn kế thừa --}}
@extends('layouts.client')
{{-- code thao tác với giao diện  --}}
{{-- đặt tên section giống như tên cảu yield đặt ở bên layout --}}

@section('title')
    Hoàng Nhật Tân
@endsection


@section('sidebar')
     {{-- kết thừ từ layout cha và bổ sung thêm thành phần con --}}
     @parent 
     <h4> {{$title}} </h4>  
    
@endsection

@section('content')
     @if(session('msg'))
          <div class="alert alert-success">{{session('msg')}}</div>
     @endif

     @if($errors->any())
         <div class="alert alert-danger">Dữ liệu nhập vào không hợp lệ</div>
     @endif
     <a href="products-add"><button class="btn btn-primary">Thêm User</button></a>
     <hr>
     <form action="" method="post">
          @csrf
          <div class="mb-3">
               <label for="">Họ và tên</label>
               <input type="text"class="form-control" name="fullname" id="" placeholder="fullname" value="{{old('fullname')}}">
               @error('fullname')
                   <span style="color: red"> {{$message}}  </span>
               @enderror
          </div>

          <div class="mb-3">
               <label for="">Email</label>
               <input type="text"class="form-control" name="email" id="" placeholder="email" value="{{old('email')}}">
               @error('email')
                   <span style="color: red">{{$message}} </span>
               @enderror
          </div>
          <a href="users-add"><button type="submit" class="btn btn-danger">Submit</button></a>
          
          <a href="{{route('user.index')}}">Quay lại</a>
          
     </form>
  
@endsection