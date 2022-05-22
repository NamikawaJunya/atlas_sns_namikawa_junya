<?php

use Illuminate\Database\Seeder;

class usersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // user情報に関する項目
        DB::table('users')->insert([
            //左がカラム右がレコード
            ['username' => 'atlas太郎', 'mail' => 'test', 'password' => bcrypt('test')]
        ]);
    }
}