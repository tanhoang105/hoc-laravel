<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //
    public function cate(Request $request){
        // dd($request);
        echo $request->name;
        // echo 'đây là trang cate - danh sách sản phẩm';
    }

    public function addcate(){
       return view('category.add-form');
    }

    public function post(Request $request){
        // lấy ra tất cả dữ liệu cả post hoặc get
        $datarequest = $request->all();
        dd($datarequest);

    }

    // hàm showw file 
    public function showFormUpload(){
        return view('category.uploadFile');
    }

    // hàm xử lý file
    public function handle(Request $request){
        // $file = $request->file('photo');
        // dd($file); 
        echo 'hoàng nhật tân';
    }
}
