<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Phương thức tạo 2 record mẩu cho table roles

        // Record thứ nhất
        $role_employee = new Role();
        $role_employee->name = 'employee';
        $role_employee->description = 'A Employee User';
        $role_employee->save(); // Lưu vào DB

        // Record thứ hai
        $role_manager = new Role();
        $role_manager->name = 'manager';
        $role_manager->description = 'A Manager User';
        $role_manager->save();  // Lưu vào DB
    }
}

