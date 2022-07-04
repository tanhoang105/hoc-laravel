<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

use App\Models\Users;

use App\Http\Requests\UserRequest;
// use file request 

class UserController extends Controller
{
    //
    private $users;
    const _PER_PAGE = 3;
    // tạo ra hàm __Contruct để tự động tạo ra đối tượng Users() giúp chúng ta đã mất công tạo ra đối tượng user mỗi khi muốn làm việc 
    // với những method bên user model
    public function __construct()
    {
        $this->users = new Users();
    }

    public function index(Request $request , $fillters = [])
    {

        $title = 'Danh Sách Người Dùng';
        // $statement = $this->users->statementUser('select * from users');
        // $listUsers = $this->users->getUsers();

        // $listUsers = $this->users->learQuery();
        // $listUsers = $this->users->SortTable();

        // xử lý công việc lọc
        $fillters = [];
        $keyword = null;
        if(($request->status)){

            $status =  $request->status;
            if($status== 'active'){
                $status = 1;
            }else{
                $status  = 0 ;
            }
            $fillters[] = ['users.status'  , '=' , $status];
        }


        if(($request->group_id)){

            $group_id =  $request->group_id;
            
            $fillters[] = ['users.group_id'  , '=' , $group_id];
        }

        if(($request->keyword)){

            $keyword =  $request->keyword;
            
            
        }
       

        // xử lý công việc sắp xếp
        $sortBy = $request->input('sort-by'); 

        $sortType = $request->input('sort-type');
    
        $allow = ['asc', 'desc'];
        if(!empty($sortType) && in_array( $sortType , $allow)){
            if($sortType == 'desc'){
                $sortType = 'asc';
            }else{
                $sortType = 'desc';
            }
        }else{
            $sortType = 'desc';
        }
        $sortArray = [
            'sortBy' => $sortBy,
            'sortType' => $sortType
        ];


        // khi $sortType == desc rồi thì cần gán lại cho nó là asc để khi click vào thì có thể chuyển đổi được thành asc
        

        $listUsers = $this->users->getAllUsers($fillters ,$keyword , $sortArray);
        // dd($listUsers);

        return view('clients.users.list', compact('title', 'listUsers' , 'sortType' , self::_PER_PAGE) );
    }

    public function add(){
        $title = 'Thêm người dùng';
        $groups = getAllGroup();

        return view('clients.users.add' , compact('title' , 'groups'));

    }

    public function Postadd(
        // Request $request
        // thực hiện validate theo cách 1

        UserRequest $request
        // thực hiện validate theo cách 2 có file request
        
        ){
        
        // đây là cách thêm của raw query
        // $dataIsert = [
        //      $request->fullname,
        //      $request->email,
        //      date('Y-m-d H:i:s' )
        // ];


        // đây là cách thêm của query builder
        $dataIsert = [
            'fullname'=> $request->fullname,
            'email' => $request->email,
            'group_id' => $request->group_id,
            'status' => $request->status,
            'creat_at' => date('Y-m-d H:i:s'),
          

        ];
        $this->users->addUser($dataIsert);
        return redirect(route('user.index'))->with('msg' , 'thêm người dùng thành công'); 
        
        
        

    }

    public function edit(Request $request,$id=0){
        $groups = getAllGroup();
        $title = 'Cập nhập  người dùng';
        // trước khi sinh ra view thì chúng ta cần lấy đc dữ liệu user cần chỉnh sửa
        if(!empty($id)){
            $userDetail = $this->users->GetDetail($id);
            if(!empty($userDetail[0])){ 
                $request->session()->put('id', $id);
                $userDetail = $userDetail[0];
            }else{
                return redirect()->route('user.index')->with('msg', 'Người dùng không tồn tại');   
            }
        }else{
            return redirect()->route('user.index')->with('msg' , 'Người dùng không tồn tại');   
        }
        // dd($userDetail);
        return view('clients.users.edit' , compact('title','userDetail' , 'groups'));

    }

    public function Postedit(UserRequest $request){
       
        $id = session('id');
        // dd($id);
        if(empty($id)){
            return back()->with('msg' , 'liên kết không tồn tại');
        }
        
        $dataUpdate = [
            'fullname'=> $request->fullname,
            'email' => $request->email,
            'group_id' => $request->group_id,
            'status' => $request->status,
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        $this->users->UpdateUser( $dataUpdate , $id);
        // return redirect()->route('user.get-edit')->with('msg' , 'cập nhập thành công');
         return back()->with('msg' , 'cập nhập thành công'); // khi dùng back thì nó tự động chuyển hướng đến trang hiện tại 

    }



    public function delete( $id=0){
        if(!empty($id)){
            $userDetail = $this->users->GetDetail($id);
            if(!empty($userDetail[0])){              
                $deleteStatus = $this->users->deleteUser($id);
                if($deleteStatus){
                    $msg = 'xóa người dùng thành công';
                }else{
                    $msg = 'xóa người dùng không thành công';
                }
            }else{
                $msg = 'người dùng không tồn tại';
            }
        }else{
            $msg = 'liên kết không tồn tại';
        }

        return redirect()->route('user.index')->with('msg' , $msg);   

    }
}
