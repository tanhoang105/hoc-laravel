<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Users;

class UserController extends Controller
{
    //
    private $users;
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
        // dd($fillters);

        $listUsers = $this->users->getAllUsers($fillters ,$keyword);
        // dd($listUsers);

        return view('clients.users.list', compact('title', 'listUsers'));
    }

    public function add(){
        $title = 'Thêm người dùng';

        return view('clients.users.add' , compact('title'));

    }

    public function Postadd(Request $request){
        $request->validate(
            [
                'fullname' => ['required' , 'min:5'],
                'email' => ['required' , 'email' , 'unique:users']
            ], 
            [
                'fullname.required' => 'fullname bắt buộc phải nhập',
                'fullname.min' => 'fullname ít nhất phải 5 ký tự',
                'email.required' => 'email bắt buộc phải nhập',
                'email.email'=> 'email bắt buộc là email',
                'email.unique' => 'email đã tồn tại '
            ],
           
          
        );
        $dataIsert = [
             $request->fullname,
             $request->email,
             date('Y-m-d H:i:s' )
        ];
        $this->users->addUser($dataIsert);
        return redirect(route('user.index'))->with('msg' , 'thêm người dùng thành công'); 
        
        
        

    }

    public function edit(Request $request,$id=0){
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
        return view('clients.users.edit' , compact('title','userDetail'));

    }

    public function Postedit(Request $request){
       
        $id = session('id');
        // dd($id);
        if(empty($id)){
            return back()->with('msg' , 'liên kết không tồn tại');
        }
        $request->validate(
            [
                'fullname' => ['required' , 'min:5'],
                'email' => ['required' , 'email' , 'unique:users,email,' .$id ]
            ], 
            [
                'fullname.required' => 'fullname bắt buộc phải nhập',
                'fullname.min' => 'fullname ít nhất phải 5 ký tự',
                'email.required' => 'email bắt buộc phải nhập',
                'email.email'=> 'email bắt buộc là email',
                'email.unique' => 'email đã tồn tại '
            ],
           
          
        );
        $dataUpdate = [
            $request->fullname,
             $request->email,
             date('Y-m-d H:i:s' )
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
