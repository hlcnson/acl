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
        $employee->name = 'Employee Name';
        $employee->email = 'employee@example.com';
        $employee->password = bcrypt('secret');
        $employee->save();  // Lưu vào DB
        // Thêm mối quan hệ giữa user và role và pivot table
        $employee->roles()->attach($role_employee);
        
        // Record thứ hai
        $manager = new User();
        $manager->name = 'Manager Name';
        $manager->email = 'manager@example.com';
        $manager->password = bcrypt('secret');
        $manager->save();
        $manager->roles()->attach($role_manager);
    }
}
