<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request; 
use App\Http\Controllers;
use Illuminate\Http\Response;


//  use namespce để có thể sử dụng 
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Login;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Response as HttpResponse;
use App\Models\Users;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/', function(){
//     return view('welcome');
// });

// Route::get('form', function(){
//     // return 'đây là phương thức get';
//     return view('form');
// });


// Route::post('form', function(){
//     return 'đây là phương thức post';
// });


// Route::match(['get', 'post'], 'form' , function(){
//     return $_SERVER['REQUEST_METHOD'];
// });

// Route::any('form',function(Request $request){
//     return $request->method();
// });

// Route::get('show-form',function(){
//     return view('form');
// });


// nghĩa là khi có url là unicode thì tự động chuyển hướng đến url là  show-form
// gồm 3 tham số : url trang bắt đầu , url trang muốn điều hướng đên , trạng thái (301 , 404 , .... reponse code)
// Route::redirect('unicode' , 'show-form');

// chỉ hỗ trợ cho phương thức get và delete
// Route::view('show-form' , 'form');

// cách 1 là thực hiện code chức năng ở tại đây
// Route::get('/', function(){
//     return view('home');
// })->name('home');
// cách 2 là thực hiện code chức năng ở File bên Controller
// Route::get('cate', 'App\Http\Controllers\CategoryController@cate');
// // cách 3 là thực hiện code chức năng ở File bên Controller
// Route::get('new/{id}', [HomeController::class, 'new']);


// Route::get('login' , [Login::class , 'index']);

// nhóm các route có tiền tố chung 
// Route::middleware('checkLogin')->prefix('admin')->group(function(){
//     Route::get('show-form' , function(){
//         return view('form');
//     // đặt tên cho url
//     })->name('admin.show-form');

//     // tham số trong đường dẫn
//     // tham số ko bắt buộc thì có ? cuối 
//     Route::get('unicode/{id}/{name?}', function($id , $name = null){
//         $mess = 'tham số là :';
//         $mess .= $id . '<br>';
//         $mess .= $name;
//         return $mess ;
//     })->where([
//         // validate cho tham số
//         'id' => "[0-9]",
//         'name'=> "[a-z]"
//     ])->name('admin.unicode');


//     Route::get('/' , [DashboardController::class , 'index']);
    

// });

// code htttp
// Route::get('cate/add', [CategoryController::class , 'addcate']);
// Route::post('cate/add', [CategoryController::class , 'post']);
// Route::get('cate/upload', [CategoryController::class , 'showFormUpload']);
// Route::post('cate/upload', [CategoryController::class , 'handle'])->name('cate.upload');




// ============= layout

Route::get('/', [HomeController::class , 'index'])->name('home');
Route::prefix('user')->name('user.')->group(function(){

     Route::get('users', [UserController::class , 'index'])->name('index');
     Route::get('users-add', [UserController::class , 'add'])->name('get-add');
     Route::post('users-add', [UserController::class , 'Postadd'])->name('post-add');
     Route::get('users-edit/{id}' , [UserController::class , 'edit'])->name('get-edit');
     Route::post('update' , [UserController::class , 'Postedit'])->name('post-edit');
     Route::get('delete/{id}' , [UserController::class , 'delete'])->name('delete-user');

});




Route::get('add-sp', [HomeController::class , 'getadd'])->name('getadd');
Route::get('getArray', [HomeController::class , 'getArray'])->name('getArray');
Route::post('add-sp', [HomeController::class , 'postadd'])->name('postadd');
// Route::put('add-sp', [HomeController::class , 'putadd'])->name('putadd');

// HTTP respone 

// Route::get('demo_response' , function(){
//      $arrayContent = [
//           'name '=> 'laravel 8x',
//           'lession' => 'demo http respone',
//      ];
//           return $arrayContent;
// });


// use  Illuminate\Http\Response;
Route::get('demo_response' , function() {
     // $response = new Response();
     // dd($response);
     //  helper
     $content =  'thay đổi type';
     $response2 = (new Response($content))->header('Content-Type ', 'text') ;
     $response  = response('học lập trình' , 404);
     dd($response);
});


// khi return về array thì laravel tự động chuyển về chuỗi json
Route::get('return-array', function(){
     $arrayContent = [
          'name' => 'tan',
          'age' => 20,
          'address' => 'hà nội'
     ];
     dd($arrayContent);
     return $arrayContent;
});
// sử dụng response instance cách 1
Route::get('responseInstance', function(){
     $response = new Response();
     dd($response);
});
 
// sử dụng response instance cách 2 - helper 
// nên sử dụng cách này để dẽ dàng thao tác với các phương thức của nó 
Route::get('responseInstance2', function () {
     $response2 = Response();
     dd($response2);
});


// change status code
// lưu ý cả response là 1 obj nên muốn truy cập 1 phương thức của nó thì cần nhóm response vào trong ()
Route::get('changeStatus', function () {
     $response2 = new Response('học lập trình',404);
     $responseHepler = response('học lập trình' , 201);
     return $responseHepler;
     
});

// gán thông tin header vào response 
Route::get('header', function () {
     $content = '<h2>Học lập trình </h2>';
     $responseHepler = response( $content , 201)->header('Content-Type' , 'text/plain');
     return $responseHepler;
     
});

// gán cookie vào response 
Route::get('cookie', function(){
     $content = '<h2>Học lập trình </h2>';
     $responseHepler = response( $content , 201)->cookie('tan' , 'hoàng nhật tân' , 30);
     return $responseHepler;
     

});

Route::get('cookie2', function( Request $request){
     return $request->cookie('tan2' , 'hoàng nhật tân 2' , 30);
});

// gán view cho response
Route::get('ganView', function(){
     $title = 'Hoàng Nhật Tân';
     $response = response()
          ->view('clients.block.ganview' , compact('title') , 200)
          ->header('Content-Type' , 'text/plain');
     return $response;
});

// response json 
Route::get('response-json',function(){
     $arrayContent = [
          'name' => 'tan',
          'age' => 20,
          'address' => 'hà nội'
     ];
     
     return response()->json($arrayContent)->header('Api-key' , 1234);
});

// hàm chuyển hướng 
// giúp ta chuyển hướng đến 1 PATH nào đó 
Route::post('redirect', function(Request $request){
     if(!empty($request->user)){
          return back()->withInput()->with('mess' , 'thành công ');

          // return 'đã điền username thành công';
           //  hoặc chúng ta có thể sử dụng back()->withInput() là 1 trường hợp redirect đặc biệt
         
     }else {
          // khi chưa nhập dữ liệu thì quay trở lại form để client nhập lại 
          // return redirect('redirect') ; cách thủ công
          // return redirect()->route('demo_redirect');


          return redirect()->route('demo_redirect')->with('mess' , 'không thành công');

          
         
     }
    
});

Route::get('redirect', function(){
     $title = 'Hoàng Nhật Tân';
     return view('clients.block.ganview' , compact('title') ) ;
})->name('demo_redirect');


// response dowload 
Route::get('dowload-img' , [HomeController::class ,  'dowloadImg'])->name('dowloadImg');