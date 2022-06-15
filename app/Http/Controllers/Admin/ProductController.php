<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * hàm __contruct thường được sử dụng để phân quyền 
     */
    
    public function __construct()
    {
        // echo "product khởi động";
        // thường sử dụng session để check login
        


        // vấn đề nếu thư mục admin có 20 controller thì cần tạo 20 hàm contruct để check phân quyền 
        // => nên sử dụng middware
    }
}
