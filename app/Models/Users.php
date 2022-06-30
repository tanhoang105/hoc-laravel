<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

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
        DB::insert('INSERT INTO users ( fullname  , email , creat_at) values (?, ? ,?)', $data);
    }

    public function GetDetail($id)
    {
        // vì chúng ta đã ra biến table chính là tên bảng mà chúng ta đang làm việc 
        return  DB::select('SELECT * FROM  ' . $this->table . ' where id= ?', [$id]);
    }

    public function UpdateUser($data, $id)
    {
        $data[] = $id;
        
        return DB::update('UPDATE ' . $this->table . ' SET fullname  = ? , email = ? , updated_at = ? where id = ? ', $data);
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


    public function getAllUsers($fillters , $keyword = null){
        $users = DB::table($this->table)
        ->select('users.*' , 'groups.*')
        ->join('groups' , 'users.group_id' , '=' , 'groups.id')
        ->orderBy('creat_at', 'DESC');
        if(!empty($fillters)){
            $users->where($fillters);
        }
        if(!empty($keyword)){
            $users = $users->where(function($query) use ($keyword) {
                $query->orWhere('fullname' , 'like' , '%'.$keyword.'%');
                $query->orWhere('email' , 'like' , '%'.$keyword.'%');
            });

        }
        $users = $users->get();


        return $users;
    }
}
