<h1>đã gán view cho respone thành công - {{$title}}</h1>
@if(session('mess'))
     <div class="alert alert-success">
          {{session('mess')}}
     </div>
@endif     
<form action="" method="post">
     @csrf
     <input type="text" name="user"  value="{{old('user')}}">
     
     <button type="submit">submit</button>
</form>