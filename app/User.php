<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Role;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    // Phương thức thiết lập mối quan hệ n-n với bảng users
    public function roles()
    {
      return $this->belongsToMany(Role::class);
    }

    /**
    * Kiểm tra role của user, $roles là mảng các role 
    * cần kiểm tra xem user có hay không
    * @param string array $roles
    */
    public function authorizeRoles($roles) {
        // Trường hợp có nhiều role cần kiểm tra
        if (is_array($roles)) {     // $roles có phải array hay không
            // Kiểm tra nhiều role cùng lúc.
            // Hoạt động của toán tử || như sau: Nếu phương thức hasAnyRole cho kết quả false,
            // Hàm abort sẽ được thực hiện và kết quả (là một view) của nó sẽ được trả về.
            // return $this->hasAnyRole($roles) || abort(401, 'Bạn không được cấp phép chức năng này!');

            if ($this->hasAnyRole($roles)) {
                return true;
            }else{
                abort(401, 'Bạn không được cấp phép chức năng này!');
            }
        }

        // Trường hợp chỉ có một role
        if ($this->hasRole($roles)) {
            return true;
        }else {
            abort(401, 'Bạn không được cấp phép chức năng này!');
        }
        // return $this->hasRole($roles) || abort(401, 'Bạn không được cấp phép chức năng này!');
    }

    /**
    * Phương thức để kiểm tra nhiều role cùng lúc.
    * $roles là mảng các role cần kiểm tra user có hay không.
    * @param array $roles
    */
    public function hasAnyRole($roles) {
        // Trả về true nếu user có role, false nếu user không có role.
        // Phương thức whereIn là query builder xác định những record 
        // trong table roles có giá trị thuộc tính name nằm trong mảng $roles
        return null !== $this->roles()->whereIn('name', $roles)->first();
    }

    /**
    * Kiểm tra role của user.
    * $role là role cần kiểm tra xem user có hay không
    * @param string $role
    */
    public function hasRole($role) {
        // Trả về true nếu user có role, false nếu user không có role.
        // Phương thức where là query builder xác định những record 
        // trong table roles có giá trị thuộc tính name trùng với $role
        return null !== $this->roles()->where('name', $role)->first();
    }
}
