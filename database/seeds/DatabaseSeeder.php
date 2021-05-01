<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => "admin",
            'password' => "$2y$10$8vHIUdlUxkfvS/g./L5.wOYPKBjp8IqNZIa5uAv66ZzkzEL2YMVHG",
            'email' => "admin",
            'created_by' => 1,
            'updated_by' => 1,
        ]);
        
        DB::table('accounts')->insert([
            'establishment' => 12345,
            'account' => Str::random(10),
            'fuc' => Str::random(10),
            'key' => Str::random(10),
            'created_by' => 1,
            'updated_by' => 1,
        ]);
        DB::table('accounts')->insert([
            'establishment' => 23456,
            'account' => Str::random(10),
            'fuc' => Str::random(10),
            'key' => Str::random(10),
            'created_by' => 1,
            'updated_by' => 1,
        ]);
        DB::table('accounts')->insert([
            'establishment' => 34567,
            'account' => Str::random(10),
            'fuc' => Str::random(10),
            'key' => Str::random(10),
            'created_by' => 1,
            'updated_by' => 1,
        ]);
        DB::table('accounts')->insert([
            'establishment' => 45678,
            'account' => Str::random(10),
            'fuc' => Str::random(10),
            'key' => Str::random(10),
            'created_by' => 1,
            'updated_by' => 1,
        ]);

        DB::table('categories')->insert([
            'category' => Str::random(10),
            'created_by' => 1,
            'updated_by' => 1,
        ]);
        DB::table('categories')->insert([
            'category' => Str::random(10),
            'created_by' => 1,
            'updated_by' => 1,
        ]);
        DB::table('categories')->insert([
            'category' => Str::random(10),
            'created_by' => 1,
            'updated_by' => 1,
        ]);
        DB::table('categories')->insert([
            'category' => Str::random(10),
            'created_by' => 1,
            'updated_by' => 1,
        ]);

        DB::table('payments')->insert([
            'id_category' => 1,
            'id_account' => 1,
            'level' => Str::random(10),
            'order' => Str::random(10),
            'title' => Str::random(10),
            'description' => Str::random(100),
            'price' => 10,
            'start_date' => '2013-04-14',
            'end_date' => '2013-04-25',
            'created_by' => 1,
            'updated_by' => 1,
        ]);
        DB::table('payments')->insert([
            'id_category' => 2,
            'id_account' => 2,
            'level' => Str::random(10),
            'order' => Str::random(10),
            'title' => Str::random(10),
            'description' => Str::random(100),
            'price' => 30,
            'start_date' => '2013-04-14',
            'end_date' => '2013-04-25',
            'created_by' => 1,
            'updated_by' => 1,
        ]);
        DB::table('payments')->insert([
            'id_category' => 3,
            'id_account' => 3,
            'level' => Str::random(10),
            'order' => Str::random(10),
            'title' => Str::random(10),
            'description' => Str::random(100),
            'price' => 50,
            'start_date' => '2014-04-15',
            'end_date' => '2014-04-26',
            'created_by' => 1,
            'updated_by' => 1,
        ]);
        DB::table('payments')->insert([
            'id_category' => 4,
            'id_account' => 4,
            'level' => Str::random(10),
            'order' => Str::random(10),
            'title' => Str::random(10),
            'description' => Str::random(100),
            'price' => 80,
            'start_date' => '2016-04-16',
            'end_date' => '2016-04-26',
            'created_by' => 1,
            'updated_by' => 1,
        ]);

    }
}
