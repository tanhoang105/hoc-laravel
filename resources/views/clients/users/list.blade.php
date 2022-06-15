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
     <a href="users-add"><button class="btn btn-primary">Thêm User</button></a>
     <hr>
     <table class="table table-bordered">
          <thead>
               <tr>
                    <th width=5%>STT</th>
                    <th>Tên</th>
                    <th>Email</th>
                    <th>Thời gian</th>
                    <th>Sửa</th>
                    <th>Xóa</th>
               </tr>
          </thead>
          <tbody>
               @if (!@empty($listUsers))
                   @foreach ($listUsers as $item)                 
                         <tr>
                              <td> {{$item->id}} </td>
                              <td> {{$item->fullname}} </td>
                              <td> {{$item->email}} </td>
                              <td> {{$item->creat_at}} </td>
                              <td><a href="{{route('user.get-edit' , ['id'=> $item->id])}}" class="btn btn-warning btn-sm">Sửa</a></td>
                              <td><a onclick="return confirm('xác nhận xóa user') " href="{{route('user.delete-user' , ['id'=> $item->id])}}" class="btn btn-danger btn-sm">Xóa</a></td>
                         </tr>
                   @endforeach
             
                   
               @else
                    <tr>
                         
                         <td colspan="4">Không có người dùng nào</td>
                    </tr>         
               @endif
          </tbody>
     </table>
  
@endsection