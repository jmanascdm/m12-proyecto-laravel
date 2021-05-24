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
            'admin' => 1,
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
            'category' => "1 ESO",
            'created_by' => 1,
            'updated_by' => 1,
        ]);
        DB::table('categories')->insert([
            'category' => "2 ESO",
            'created_by' => 1,
            'updated_by' => 1,
        ]);
        DB::table('categories')->insert([
            'category' => "3 ESO",
            'created_by' => 1,
            'updated_by' => 1,
        ]);
        DB::table('categories')->insert([
            'category' => "4 ESO",
            'created_by' => 1,
            'updated_by' => 1,
        ]);
        DB::table('categories')->insert([
            'category' => "1 BAT",
            'created_by' => 1,
            'updated_by' => 1,
        ]);
        DB::table('categories')->insert([
            'category' => "2 BAT",
            'created_by' => 1,
            'updated_by' => 1,
        ]);
        DB::table('categories')->insert([
            'category' => "1 SMX",
            'created_by' => 1,
            'updated_by' => 1,
        ]);
        DB::table('categories')->insert([
            'category' => "2 SMX",
            'created_by' => 1,
            'updated_by' => 1,
        ]);
        DB::table('categories')->insert([
            'category' => "1 GA",
            'created_by' => 1,
            'updated_by' => 1,
        ]);
        DB::table('categories')->insert([
            'category' => "2 GA",
            'created_by' => 1,
            'updated_by' => 1,
        ]);
        DB::table('categories')->insert([
            'category' => "1 DAW",
            'created_by' => 1,
            'updated_by' => 1,
        ]);
        DB::table('categories')->insert([
            'category' => "2 DAW",
            'created_by' => 1,
            'updated_by' => 1,
        ]);
        DB::table('categories')->insert([
            'category' => "2 ASIX",
            'created_by' => 1,
            'updated_by' => 1,
        ]);
        DB::table('payments')->insert([
            'id_category' => 1,
            'id_account' => 1,
            'order' => Str::random(10),
            'title' => "Matricula Curs",
            'description' => "Pagament de matriculació al curs.",
            'price' => 50,
            'start_date' => '2021-07-14',
            'end_date' => '2021-07-25',
            'created_by' => 1,
            'updated_by' => 1,
        ]);
        DB::table('payments')->insert([
            'id_category' => 1,
            'id_account' => 1,
            'order' => Str::random(10),
            'title' => "Pagament despeses escolars",
            'description' => "Pagament de despeses escolars del alumne.",
            'price' => 50,
            'start_date' => '2021-07-14',
            'end_date' => '2021-07-25',
            'created_by' => 1,
            'updated_by' => 1,
        ]);
        DB::table('payments')->insert([
            'id_category' => 1,
            'id_account' => 1,
            'order' => Str::random(10),
            'title' => "Lloguer Taquilles",
            'description' => "Fent aquest pagament l'alumne disposarà d'una taquilla durant el curs. ",
            'price' => 30,
            'start_date' => '2014-07-15',
            'end_date' => '2014-07-26',
            'created_by' => 1,
            'updated_by' => 1,
        ]);
        DB::table('payments')->insert([
            'id_category' => 2,
            'id_account' => 2,
            'order' => Str::random(10),
            'title' => "Matricula Curs",
            'description' => "Pagament de matriculació al curs.",
            'price' => 50,
            'start_date' => '2021-07-14',
            'end_date' => '2021-07-25',
            'created_by' => 1,
            'updated_by' => 1,
        ]);
        DB::table('payments')->insert([
            'id_category' => 2,
            'id_account' => 2,
            'order' => Str::random(10),
            'title' => "Pagament despeses escolars",
            'description' => "Pagament de despeses escolars del alumne.",
            'price' => 50,
            'start_date' => '2021-07-14',
            'end_date' => '2021-07-25',
            'created_by' => 1,
            'updated_by' => 1,
        ]);
        DB::table('payments')->insert([
            'id_category' => 2,
            'id_account' => 2,
            'order' => Str::random(10),
            'title' => "Lloguer Taquilles",
            'description' => "Fent aquest pagament l'alumne disposarà d'una taquilla durant el curs. ",
            'price' => 30,
            'start_date' => '2014-07-15',
            'end_date' => '2014-07-26',
            'created_by' => 1,
            'updated_by' => 1,
        ]);
        DB::table('payments')->insert([
            'id_category' => 3,
            'id_account' => 3,
            'order' => Str::random(10),
            'title' => "Matricula Curs",
            'description' => "Pagament de matriculació al curs.",
            'price' => 50,
            'start_date' => '2021-07-14',
            'end_date' => '2021-07-25',
            'created_by' => 1,
            'updated_by' => 1,
        ]);
        DB::table('payments')->insert([
            'id_category' => 3,
            'id_account' => 3,
            'order' => Str::random(10),
            'title' => "Pagament despeses escolars",
            'description' => "Pagament de despeses escolars del alumne.",
            'price' => 50,
            'start_date' => '2021-07-14',
            'end_date' => '2021-07-25',
            'created_by' => 1,
            'updated_by' => 1,
        ]);
        DB::table('payments')->insert([
            'id_category' => 3,
            'id_account' => 3,
            'order' => Str::random(10),
            'title' => "Lloguer Taquilles",
            'description' => "Fent aquest pagament l'alumne disposarà d'una taquilla durant el curs. ",
            'price' => 30,
            'start_date' => '2014-07-15',
            'end_date' => '2014-07-26',
            'created_by' => 1,
            'updated_by' => 1,
        ]);
        DB::table('payments')->insert([
            'id_category' => 4,
            'id_account' => 4,
            'order' => Str::random(10),
            'title' => "Matricula Curs",
            'description' => "Pagament de matriculació al curs.",
            'price' => 50,
            'start_date' => '2021-07-14',
            'end_date' => '2021-07-25',
            'created_by' => 1,
            'updated_by' => 1,
        ]);
        DB::table('payments')->insert([
            'id_category' => 4,
            'id_account' => 1,
            'order' => Str::random(10),
            'title' => "Pagament despeses escolars",
            'description' => "Pagament de despeses escolars del alumne.",
            'price' => 50,
            'start_date' => '2021-07-14',
            'end_date' => '2021-07-25',
            'created_by' => 1,
            'updated_by' => 1,
        ]);
        DB::table('payments')->insert([
            'id_category' => 4,
            'id_account' => 1,
            'order' => Str::random(10),
            'title' => "Lloguer Taquilles",
            'description' => "Fent aquest pagament l'alumne disposarà d'una taquilla durant el curs. ",
            'price' => 30,
            'start_date' => '2014-07-15',
            'end_date' => '2014-07-26',
            'created_by' => 1,
            'updated_by' => 1,
        ]);
        DB::table('payments')->insert([
            'id_category' => 5,
            'id_account' => 1,
            'order' => Str::random(10),
            'title' => "Matricula Curs",
            'description' => "Pagament de matriculació al curs.",
            'price' => 50,
            'start_date' => '2021-07-14',
            'end_date' => '2021-07-25',
            'created_by' => 1,
            'updated_by' => 1,
        ]);
        DB::table('payments')->insert([
            'id_category' => 5,
            'id_account' => 1,
            'order' => Str::random(10),
            'title' => "Pagament despeses escolars",
            'description' => "Pagament de despeses escolars del alumne.",
            'price' => 50,
            'start_date' => '2021-07-14',
            'end_date' => '2021-07-25',
            'created_by' => 1,
            'updated_by' => 1,
        ]);
        DB::table('payments')->insert([
            'id_category' => 6,
            'id_account' => 1,
            'order' => Str::random(10),
            'title' => "Matricula Curs",
            'description' => "Pagament de matriculació al curs.",
            'price' => 50,
            'start_date' => '2021-07-14',
            'end_date' => '2021-07-25',
            'created_by' => 1,
            'updated_by' => 1,
        ]);
        DB::table('payments')->insert([
            'id_category' => 6,
            'id_account' => 1,
            'order' => Str::random(10),
            'title' => "Pagament despeses escolars",
            'description' => "Pagament de despeses escolars del alumne.",
            'price' => 50,
            'start_date' => '2021-07-14',
            'end_date' => '2021-07-25',
            'created_by' => 1,
            'updated_by' => 1,
        ]);
        DB::table('payments')->insert([
            'id_category' => 7,
            'id_account' => 1,
            'order' => Str::random(10),
            'title' => "Matricula Curs",
            'description' => "Pagament de matriculació al curs.",
            'price' => 50,
            'start_date' => '2021-07-14',
            'end_date' => '2021-07-25',
            'created_by' => 1,
            'updated_by' => 1,
        ]);
        DB::table('payments')->insert([
            'id_category' => 7,
            'id_account' => 1,
            'order' => Str::random(10),
            'title' => "Pagament despeses escolars",
            'description' => "Pagament de despeses escolars del alumne.",
            'price' => 50,
            'start_date' => '2021-07-14',
            'end_date' => '2021-07-25',
            'created_by' => 1,
            'updated_by' => 1,
        ]);
        DB::table('payments')->insert([
            'id_category' => 8,
            'id_account' => 1,
            'order' => Str::random(10),
            'title' => "Matricula Curs",
            'description' => "Pagament de matriculació al curs.",
            'price' => 50,
            'start_date' => '2021-07-14',
            'end_date' => '2021-07-25',
            'created_by' => 1,
            'updated_by' => 1,
        ]);
        DB::table('payments')->insert([
            'id_category' => 8,
            'id_account' => 1,
            'order' => Str::random(10),
            'title' => "Pagament despeses escolars",
            'description' => "Pagament de despeses escolars del alumne.",
            'price' => 50,
            'start_date' => '2021-07-14',
            'end_date' => '2021-07-25',
            'created_by' => 1,
            'updated_by' => 1,
        ]);
        DB::table('payments')->insert([
            'id_category' => 9,
            'id_account' => 1,
            'order' => Str::random(10),
            'title' => "Matricula Curs",
            'description' => "Pagament de matriculació al curs.",
            'price' => 50,
            'start_date' => '2021-07-14',
            'end_date' => '2021-07-25',
            'created_by' => 1,
            'updated_by' => 1,
        ]);
        DB::table('payments')->insert([
            'id_category' => 9,
            'id_account' => 1,
            'order' => Str::random(10),
            'title' => "Pagament despeses escolars",
            'description' => "Pagament de despeses escolars del alumne.",
            'price' => 50,
            'start_date' => '2021-07-14',
            'end_date' => '2021-07-25',
            'created_by' => 1,
            'updated_by' => 1,
        ]);
        DB::table('payments')->insert([
            'id_category' => 10,
            'id_account' => 1,
            'order' => Str::random(10),
            'title' => "Matricula Curs",
            'description' => "Pagament de matriculació al curs.",
            'price' => 50,
            'start_date' => '2021-07-14',
            'end_date' => '2021-07-25',
            'created_by' => 1,
            'updated_by' => 1,
        ]);
        DB::table('payments')->insert([
            'id_category' => 10,
            'id_account' => 1,
            'order' => Str::random(10),
            'title' => "Pagament despeses escolars",
            'description' => "Pagament de despeses escolars del alumne.",
            'price' => 50,
            'start_date' => '2021-07-14',
            'end_date' => '2021-07-25',
            'created_by' => 1,
            'updated_by' => 1,
        ]);
        DB::table('payments')->insert([
            'id_category' => 11,
            'id_account' => 1,
            'order' => Str::random(10),
            'title' => "Matricula Curs",
            'description' => "Pagament de matriculació al curs.",
            'price' => 380,
            'start_date' => '2021-07-14',
            'end_date' => '2021-07-25',
            'created_by' => 1,
            'updated_by' => 1,
        ]);
        DB::table('payments')->insert([
            'id_category' => 11,
            'id_account' => 1,
            'order' => Str::random(10),
            'title' => "Pagament despeses escolars",
            'description' => "Pagament de despeses escolars del alumne.",
            'price' => 50,
            'start_date' => '2021-07-14',
            'end_date' => '2021-07-25',
            'created_by' => 1,
            'updated_by' => 1,
        ]);DB::table('payments')->insert([
            'id_category' => 12,
            'id_account' => 1,
            'order' => Str::random(10),
            'title' => "Matricula Curs",
            'description' => "Pagament de matriculació al curs.",
            'price' => 380,
            'start_date' => '2021-07-14',
            'end_date' => '2021-07-25',
            'created_by' => 1,
            'updated_by' => 1,
        ]);
        DB::table('payments')->insert([
            'id_category' => 12,
            'id_account' => 1,
            'order' => Str::random(10),
            'title' => "Pagament despeses escolars",
            'description' => "Pagament de despeses escolars del alumne.",
            'price' => 50,
            'start_date' => '2021-07-14',
            'end_date' => '2021-07-25',
            'created_by' => 1,
            'updated_by' => 1,
        ]);
        DB::table('payments')->insert([
            'id_category' => 13,
            'id_account' => 1,
            'order' => Str::random(10),
            'title' => "Matricula Curs",
            'description' => "Pagament de matriculació al curs.",
            'price' => 380,
            'start_date' => '2021-07-14',
            'end_date' => '2021-07-25',
            'created_by' => 1,
            'updated_by' => 1,
        ]);
        DB::table('payments')->insert([
            'id_category' => 13,
            'id_account' => 1,
            'order' => Str::random(10),
            'title' => "Pagament despeses escolars",
            'description' => "Pagament de despeses escolars del alumne.",
            'price' => 50,
            'start_date' => '2021-07-14',
            'end_date' => '2021-07-25',
            'created_by' => 1,
            'updated_by' => 1,
        ]);
    }
}
