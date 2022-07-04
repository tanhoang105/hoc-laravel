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
     <form action="{{route('user.post-edit')}}" method="post">
          @csrf
          <div class="mb-3">
               <label for="">Họ và tên </label>
               <input type="text"class="form-control" name="fullname" id="" placeholder="fullname" value="{{ old('fullname') ?? $userDetail->fullname}}">
               @error('fullname')
                   <span style="color: red"> {{$message}}  </span>
               @enderror
          </div>

          <div class="mb-3">
               <label for="">Email</label>
               <input type="text"class="form-control" name="email" id="" placeholder="email" value="{{old('email') ?? $userDetail->email}}">
               @error('email')
                   <span style="color: red">{{$message}} </span>
               @enderror
          </div>
          <div class="mb-3">
               <label for="">Nhóm</label>
               <select name="group_id" class="form-control" id="">
                    <option value=group_id value="0">Chọn nhóm</option>
                    @if(!empty($groups))
                         @foreach($groups as  $key=>$value)
                              <option value="{{$value->id}}" {{old('group_id') == $value->id ? 'selected' : false}}>{{$value->name}}</option>
                         @endforeach
                    @endif
               </select>
               @error('group_id')
                   <span style="color: red">{{$message}} </span>
               @enderror
          </div>

          <div class="mb-3">
               <label for="">Trạng Thái</label>
               <select name="status" class="form-control" id="">
                    <option value="0" {{old('status') == 0 || $userDetail->status == 0 ? 'selected' : false}} >Chưa kích hoạt</option>
                    <option value="1" {{old('status') == 1 || $userDetail->status == 1 ? 'selected' : false}} >Kích hoạt</option>
               </select>
               
          </div>
          
          <a href=""><button type="submit" class="btn btn-danger">Submit</button></a>
          
          <a href="{{route('user.index')}}" class="btn btn-warning" >Quay lại</a>
     </form>
  
@endsection