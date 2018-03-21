<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Phương thức tạo record mẫu cho table users

        // Lấy record role đầu tiên có thuộc tính name là employee
        $role_employee = Role::where('name', 'employee')->first();
        // Lấy record role đầu tiên có thuộc tính name là manager
        $role_manager  = Role::where('name', 'manager')->first();

        // Record thứ nhất
        $employee = new User();
        $employee->name = 'John';
        $employee->email = 'john@example.com';
        $employee->password = bcrypt('123456');
        $employee->save();  // Lưu vào DB
        // Thêm mối quan hệ giữa user và role và pivot table
        $employee->roles()->attach($role_employee);
        
        // Record thứ hai
        $manager = new User();
        $manager->name = 'Admin';
        $manager->email = 'admin@example.com';
        $manager->password = bcrypt('123456');
        $manager->save();
        $manager->roles()->attach($role_manager);
    }
}
