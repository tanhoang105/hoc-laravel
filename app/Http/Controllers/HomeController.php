<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
// use để sử dụng cho cách 1 : validate tử lớp request


use App\Http\Requests\productRequest;
// use để sử dụng cho cách 2 : validate từ form request 

use Illuminate\Support\Facades\Validator;
// use để sử dụng cho cách 3 : validate từ lớp validator()

use  App\Rules\UpperCase;
// user để có thêm sử dụng đc những rule mà chúng ta tự custom 


use Illuminate\Support\Facades\DB; 
// cách 1 :  để chúng ta có thể truy vấn với database
// use DB;
// cách 2 :  để chúng ta có thể truy vấn với database

class HomeController extends Controller
{
     public function index(){
          $title = 'Trang chủ';
          $content = "đặt hàng thành công";
          // $user = DB::select('SELECT * from users where id=1');
          // $user =  DB::select('select * from users where id = ?', [1]);
          $user =  DB::select('select * from users where email=:email', [
               'email' => 'long@gmail.com'
          ]);
         
          return view('clients.home', compact('title', 'content'));
     }

     public function products(){
          $title = 'Sản phẩm';
          return view('clients.products', compact('title'));
     }

     public function getadd(){
          $title = 'Thêm sản phẩm';
          $data =  '';
          return view('clients.add' , compact('title'));
     }

     public function postadd(
          // Request $request 
          // khai báo cho cách 1 khi chúng ta sử dụng phương thức validate từ lớp request

          // productRequest $request
          // khai báo cho cách 2 khi chúng ta sử dụng form request

          Request $request 
          // khai báo cho cách 1 và cách 3 khi chúng ta sử dụng lớp validator()
     
     ){
          // cách 1 
          // validate($rules , $message )
          // $rules là 1 array trong đó key là các input-name và value là các rule mà chúng ta muốn ràng buộc
          // $message là 1 array nếu ko điền thì nó sẽ tự hiện thông báo mặc định 
          // $request->validate([
          //           'product-name' => 'required | min:6 | integer'
          // ] , 
          // [
          //      'product-name.required' => ':attribute bắt buộc phải nhập ',
          //      'product-name.min' => 'dữ liệu không được nhỏ hơn :min ký tự ',
          //      'integer' => 'dữ liệu bắt buộc là số'

          // ]);
          //===================================================================
          // cách 2 
          //     dd($request->all());
     


          //=======================================================================
          //   dd($request->all());


          // cách 3
          // những thuộc tính mà chúng ta muốn validate cho trường dữ liệu 
          $rules = [
               // 'product-name' => 'required | min:6 ' 
               // sử dụng khi chúng ta ko tạo ra rule mới

               'product-name' => ['required', 'min:6' , new UpperCase] ,

               // 'product-price' => ['required', 'min:6' , new UpperCase] 
               // cách 2 
               'product-price' => ['required', 'min:6' , function ($attributes , $value , $fail  ){
                   if($value != mb_strtoupper($value , 'UTF-8')){
                         $fail('Trường :attribute không hợp lệ');
                   }
               }] 


          
          ];
          // $message = [
          //      'product-name.required' => ':attribute bắt buộc phải nhập ',
          //      'product-name.min' => 'dữ liệu không được nhỏ hơn :min ký tự ',
          //      'integer' => 'dữ liệu bắt buộc là số'
          // ];
          
          // thông báo khi hiển thị lỗi 
          $message = [
                    'required' => ':attribute bắt buộc phải nhập nhé',
                    'min' => 'dữ liệu không được nhỏ hơn :min ký tự ',
                    'integer' => 'dữ liệu bắt buộc là số'
     
          ];
          // thay đổi trường dữ liệu
          $attributes = [
               'product-name' => 'tên sản phẩm',
               'product-price' => 'giá sản phẩm'
          ];

          $Validator = Validator::make( $request->all() , $rules, $message  , $attributes); // tạo ra thôi nhưng chưa thực hiện 
          // $Validator->validate(); // bắt đầu validate() và giúp hiện thị thông báo lỗi

          // khi validate thật bại ví dụ như ko có : $Validator->validate() thì có nghĩa là validate thất bại
          if($Validator->fails()){
               // return 'validate thật bại' ; 
               //khi validate không thành công muốn hiển thị ra thông báo thì ta làm như sau 
               $Validator->errors()->add('msg' , 'vui lòng kiểm tra lại dữ liệu nhập');
          }else{
               // return 'validate thành công';
               return redirect()->route('products')->with('msg' , 'validate thành công bạn đã được chuyển hướng đến trang sản phẩm');
          }
          // khi validate không thành công thì chuyển hướng và mang theo biến validator 
          return back()->withErrors($Validator);




         // khi validate thành công thì sẽ cho dữ liệu vào database .....
         // các công việc khi validate thành công       
     } 

     public function putadd(Request $request){
          dd($request);
          
     } 

     public function getArray(){
          // 
          $arrayContent = [
               'name '=> 'laravel 8x',
               'lession' => 'khóa học lập trình laravel unicode',
          ];
               return $arrayContent;
     }

     public function dowloadImg(Request $request){
          if(!empty($request->img)){
               $img = trim($request->img);
               // dd($request->img);
               // khi sử dụng link ảnh từ bên ngoài k trong nội bộ thì chúng ta sử dụng hàm streamDownload
               // hàm này sẽ có 2 tham số 1 tham số là hàm ẩn danh , tham số còn lại là tên file chúng ta muốn đặt khi chúng ta download về máy

               // tạo ra tên ngẫu nhiên để đặt cho tên file khi tải về
               // $fileName = 'img_' . uniqid() . '.jpg';

               // giữ nguyên tên file tải về để lưu luôn vào máy
               $baseName = basename($img) ;
               // return response()->streamDownload(function() use ($img) {
               //      // đọc file 
               //      $imgContent = file_get_contents($img);

               //      echo $imgContent;
               // },$baseName);
               
               // khi chúng ta muốn định dạng type tải về thì bổ sung thêm $headers 
               $headers = [
                    'Content-Type' => 'application/pdf'
               ];
               // nếu ảnh trong nội bộ thì mới sử dụng hàm dowload 
               return response()->download($img , $baseName, $headers);
          }
     }
}
