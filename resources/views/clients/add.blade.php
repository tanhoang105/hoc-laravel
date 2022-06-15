  {{-- gọi tới layout muốn kế thừa --}}
@extends('layouts.client')
{{-- code thao tác với giao diện  --}}
{{-- đặt tên section giống như tên cảu yield đặt ở bên layout --}}

@section('title')
     {{$title}}
@endsection


@section('sidebar')
     {{-- kết thừ từ layout cha và bổ sung thêm thành phần con --}}
    
     <h3>Thêm sản phẩm</h3>
@endsection 

@section('content')
          {{-- @if ($errors->any())
               
                    {{-- @foreach ($errors->all() as $error)
                         <span style="color : red">{{ $error }}</span>
                    @endforeach --}}

                    {{-- <p>vui lòng kiểm tra lại </p> --}}
               
          {{-- @endif --}}


          {{-- withValidate --}}
          {{-- đây chính là phần hiển thị ra thông báo sau khi validate xong ở method withValidate --}}
          @error('msg')
              <div class="alert alert-danger text-center">
               {{$message}}
              </div>
          @enderror
    <form action="" method="post">
         <div class="form-group">
               <label for="">Tên sản phẩm</label>
               {{-- <input type="hidden"name="_token" value="{{csrf_token}}" > --}}
               @csrf
               {{-- @method('PUT') --}}
               <input type="text" name="product-name" id="" class="form-control" placeholder="" aria-describedby="helpId" value="{{old('product-name')}}">
               @error('product-name')
                    <span style="color : red">{{$message}}</span>            
               @enderror
               <br>
               <label for="">Giá sản phẩm</label>
               {{-- thông báo lỗi cho từng trường dữ liệu  --}}
               <input type="text" name="product-price" id="" class="form-control" placeholder="" aria-describedby="helpId" value="{{old('product-price')}}">
               @error('product-price')
                    <span style="color : red">{{$message}}</span>            
               @enderror
         </div>
         <br>
         <button class="btn btn-success">Thêm</button>
    </form>
@endsection 

@section('js')
    <script>
         $(document).ready(function(){
              console.log('nhật tân');
         })
    </script>
@endsection