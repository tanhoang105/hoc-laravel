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
     <h3>Home </h3>
@endsection 

@section('content')
     <h1>Trang chủ</h1>  
     {{-- khi không có dấu : ở trc thuộc tình thì cần thêm "" --}}
     <x-alert type="warning" content="{{$content}}" />
     {{-- khi có dấu : thì ko cần "" --}}
     <x-alert type="warning" :content=$content />
     {{-- gọi từ folder.file thì ko cần đăng ký component --}}
     {{-- <x-inputs.button />  --}}
     {{-- gọi như vậy thì cần đăng ký  --}}
     {{-- <x-button />  --}}
     
     <p>
          <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR56ylOyETFK3HWGE6AZUoMRGIn1CPlT9MFdDLyYcDh5w7kZ6TEBg-FXbyM-mms-QaESbs&usqp=CAU" alt="">
     </p>
     <a href="{{route('dowloadImg').'?img=' . public_path('storage/anh2.jpg')}}"><button class="btn btn-danger">Dowload</button></a>
@endsection 

@section('js')
    
@endsection