<?php

use Illuminate\Database\Seeder;

class CmfUserTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('cmf_user')->delete();
        
        \DB::table('cmf_user')->insert(array (
            0 => 
            array (
                'id' => 1,
                'user_type' => 1,
                'sex' => 0,
                'birthday' => 0,
                'last_login_time' => 1531553024,
                'score' => 0,
                'coin' => 0,
                'balance' => '0.00',
                'create_time' => 1531540975,
                'user_status' => 1,
                'user_login' => 'admin',
                'user_pass' => '###1d15478ff12e51291474198554b090c0',
                'user_nickname' => 'admin',
                'user_email' => '13469984690@163.com',
                'user_url' => '',
                'avatar' => '',
                'signature' => '',
                'last_login_ip' => '127.0.0.1',
                'user_activation_key' => '',
                'mobile' => '',
                'more' => NULL,
            ),
        ));
        
        
    }
}