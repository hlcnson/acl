<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Role extends Model
{
    // Phương thức thiết lập mối quan hệ n-n với table roles
    public function users(){
        // Toán tử :: kèm từ khóa class trả về tên FQDN của model class tên Role
        return $this->belongsToMany(User::class);
    }
}


