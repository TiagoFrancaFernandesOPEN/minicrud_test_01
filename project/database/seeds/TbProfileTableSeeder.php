<?php

use Illuminate\Database\Seeder;

class TbProfileTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
    // profile_id integer
    // profile_name character
    // profile_type character

        DB::table('tb_profile')
        ->insert([
            'profile_id' => 1,
            'profile_name' => 'Administrador',
            'profile_type' => 'ADMIN'
        ]);
        DB::table('tb_profile')
        ->insert([
            'profile_id' => 2,
            'profile_name' => 'Gerente',
            'profile_type' => 'MANAGER'
        ]);
        DB::table('tb_profile')
        ->insert([
            'profile_id' => 3,
            'profile_name' => 'Usuário',
            'profile_type' => 'USER'
        ]);
    }
}
