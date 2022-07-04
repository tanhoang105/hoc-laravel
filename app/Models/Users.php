<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

use function PHPSTORM_META\type;

class Users extends Model
{
    use HasFactory;
    protected $table = 'users';



    public function getUsers()
    {
        $users = DB::select('select * from users ');
        return $users;
    }

    public function addUser($data)
    {
        // đây là cách thêm của raw query
        // DB::insert('INSERT INTO users ( fullname  , email , creat_at) values (?, ? ,?)', $data);

        // cách 2 : thêm theo cách query builder
        // cần có return insert() nó sẽ trả về true or false
       return  DB::table($this->table)->insert($data);
    }

    public function GetDetail($id)
    {
        // vì chúng ta đã ra biến table chính là tên bảng mà chúng ta đang làm việc 
        return  DB::select('SELECT * FROM  ' . $this->table . ' where id= ?', [$id]);
    }

    public function UpdateUser($data, $id)
    {
        // đây là phần làm việc với raw query
    //     $data[] = $id; 
    //     return DB::update('UPDATE ' . $this->table . ' SET fullname  = ? , email = ? , updated_at = ? where id = ? ', $data);
    

    // làm việc với query builder
        return DB::table($this->table)->where('id' , $id)->update($data);

    }


    public function deleteUser($id)
    {
      return  DB::delete('DELETE FROM ' . $this->table  . ' where id = ?' , [$id]);
    }


    public function statementUser($sql){
        // thực hiện với bất kỳ câu truy vấn nào
       return  DB::statement($sql);
    }


    public function learQuery(){
        // DB::enableQueryLog();


        // $id = 4;
        // $list = DB::table($this->table)
        // ->select('*')
        // ->where('id', 1)
        // ->where(function($query) use ($id){
        //     $query->where('id', '<' , $id )->orWhere('id' , '>' , 5);
        // })
        // ->get();




        // câu lệnh tìm kiếm 
        // $list = DB::table($this->table)->where('fullname' , 'like' , '%hoàng%')->get();
        // dd($list);

        // câu lệnh truy vấn theo khoảng whereBetween
        // câu lệnh truy vấn KHÔNG theo khoảng whereNotBetween
        // câu lệnh truy vấn những phần tử có theo mảng : whereIn('id' , [1,2,4]) : truy những phần tử có id là 1,2,4

        // câu lệnh truy vấn giá trị bằng nhau
        // trả về bản ghi có giá trị của creat_at = update_at
        // $list = DB::table($this->table)->whereColumn('creat_at' , 'update_at')->get();


        $list = DB::table($this->table)->whereBetween('id' , [2,5])->get();


        // câu lệnh kiểm tra câu truy vấn 
        // $sql =  DB::getQueryLog();
        // dd($sql);



        return $list;
    //    return $listUser  =DB::table($this->table)->get();
    //    return $listUser  =DB::table($this->table)->where('id', '>' , 0)->get();
    }


    public function JoinTable(){
        $list = DB::table($this->table)
        ->select('*' , 'groups.name')
        ->join('groups' , 'users.group_id' , '=' , 'groups.id')
        ->get();
        // dd($list);
        return $list;
    }

    public function SortTable(){
        DB::enableQueryLog();
        $list = DB::table($this->table)
        // ->orderBy('id' ,'desc')
        // ->select(DB::raw('count(id) as email_count'), 'email')
        // ->groupBy('email')
        // ->having('email_count', '>=' , 2)
        ->limit(3)
        ->offset(2)

        // tương tự như limit và offset
        // ->take(2)
        // ->skip(2)
        ->get();
        dd($list);
        return $list;
        // $sql =  DB::getQueryLog();
        // dd($sql);
    } 


    public function Count(){
        // đếm xem có bao nhiêu bản ghi có id lớn hơn 3
        $lists = DB::table($this->table)->where('id' , '>' , 3 )->count();
        return $lists;
    }


    public function getAllUsers($fillters , $keyword = null , $sortByAray = null , $perPage = null){
        $users = DB::table($this->table)
        ->select('users.*' , 'groups.*')
        ->join('groups' , 'users.group_id' , '=' , 'groups.id');
        // thực hiên công viêc cho sắp xếp
        $orderBy = 'users.creat_at';
        $orderType = 'desc'; 
        if(!empty($sortByAray) && is_array($sortByAray)){
            if(!empty($sortByAray['sortBy']) && !empty($sortByAray['sortType'])){
                $orderBy = trim($sortByAray['sortBy']);
                $orderType = trim($sortByAray['sortType']);
    
            }
        }
        $users= $users->orderBy($orderBy, $orderType);


        // thực hiện công việc lọc
        if(!empty($fillters)){
            $users->where($fillters);
        }
        // thực hiện công việc cho tìm kiếm 
        if(!empty($keyword)){
            $users = $users->where(function($query) use ($keyword) {
                $query->orWhere('fullname' , 'like' , '%'.$keyword.'%');
                $query->orWhere('email' , 'like' , '%'.$keyword.'%');
            });

        }       
        

        if(!empty($perPage)){
            // lấy ra những bản ghi của user nhưng mà có phân trang , tham số chuyền vào chính là số lượng bản ghi mà chúng ta muốn hiển thị trên 1 trang
            $users = $users->paginate($perPage);
            // $users = $users->paginate($perPage)->withQueryString;

        }else{
            // lấy ra những bản ghi của user 
            $users = $users->get();
        }

        return $users;
    }
}
