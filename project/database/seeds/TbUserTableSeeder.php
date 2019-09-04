<?php

use Illuminate\Database\Seeder;

class TbUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    DB::table('tb_user')
        ->insert([
            'user_id' =>1,
            'user_fullname' =>'Saulo de Siqueira',
            'user_email' =>'saulo@isolve.com.br',
            'user_birth_date' =>'1987-03-04',
            'user_profile' =>1,
            'user_password' =>'pow3lk'
        ]);
        DB::table('tb_user')
            ->insert([
                'user_id' =>2,
                'user_fullname' =>'Tiago França',
                'user_email' =>'tiago@tiagofranca.com',
                'user_birth_date' =>'1994-01-28',
                'user_profile' =>1,
                'user_password' =>'teste123'
            ]);
    }
}
