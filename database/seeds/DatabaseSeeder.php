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
    }
}
