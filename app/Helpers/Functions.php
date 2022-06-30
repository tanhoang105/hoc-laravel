<?php

use App\Models\Groups;
// sự dụng name space để có thể sử dug được những method ở bên groups model 

function getAllGroup(){
     $groups = new Groups;
     $groups->getAll();

     return $groups->getAll();

}



