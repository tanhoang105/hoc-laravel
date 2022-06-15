<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // hàm tự động chạy khi đối tượng được tạo
    // public function __construct()
    // {
    //     echo "tự động chạy khi đối tượng đượng khởi tạo <br>";
    // }

    public function index(){
        return "Trang dashboard";
    }
}

