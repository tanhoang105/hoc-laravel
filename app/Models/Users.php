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
    //    return $listUser  =DB::table($this->table)->get();
       return $listUser  =DB::table($this->table)->where('id', '>' , 0)->get();
    }
}
