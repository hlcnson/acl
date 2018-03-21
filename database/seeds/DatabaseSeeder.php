<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        // Kích hoạt seeder tạo record mẩu cho table roles trước
        $this->call(RoleTableSeeder::class);
        // Kích hoạt seeder cho table user sau vì có sử dụng role trong table roles
        $this->call(UserTableSeeder::class);
    }
}


