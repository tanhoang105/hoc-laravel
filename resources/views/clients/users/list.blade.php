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
     <form action="" method="get" enctype="multipart/form-data">
          <div class="row">
               <div class="col-3">
                    <select name="group_id" id="" class="form-control">
                         <option value="0">Tất cả các nhóm</option>
                         @if(!empty(getAllGroup()))
                              @foreach(getAllGroup() as $item)
                                   <option value="{{$item->id}}" {{request()->group_id == $item->id ? 'selected' : false}}>{{$item->name}}</option>
                              @endforeach
                         @endif
                        
                    </select>
               </div>

               <div class="col-3">
                    <select name="status" id="" class="form-control">
                         <option value="0">Tất cả trạng thái</option>
                         <option value="active" {{request()->status=='active'?'selected':'' }} >Kích hoạt</option>
                         <option value="inactive" {{request()->status=='inactive'?'selected':'' }} >Không kích hoạt</option>
                    </select>
               </div>

               <div class="col-3">
                    <input type="search" value="{{request()->keyword}}" name="keyword" id="" placeholder="Từ khóa tìm kiếm..." class="form-control">
                    
               </div>
               <div class="col-3">
                    <button class="btn btn-primary btn-block">Tìm kiếm</button>                    
               </div>
          </div>
     </form>
     <hr>
     <table class="table table-bordered">
          <thead>
               <tr>
                    <th width=5%>STT</th>
                    <th>
                         <a href="?sort-by=fullname&sort-type={{$sortType}}">Tên</a>
                    </th>
                    <th>
                         <a href="?sort-by=email&sort-type={{$sortType}}">Email</a>
                    </th>
                    <th>
                         <a href="?sort-by=creat_at&sort-type={{$sortType}}">Thời gian</a>
                    </th>
                    <th>Nhóm</th>
                    <th>Trạng thái</th>
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
                              <td>{{$item->name}}</td>
                              <td> {!! $item->status === 1 ? '<button class="btn btn-success btn-block">Active</button>' : '<button class="btn btn-danger btn-block">Inactive </button>' !!}</td>
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
     {{-- <div class="d-flex justify-content">
          {{ $listUsers->links() }}       
     </div> --}}
@endsection