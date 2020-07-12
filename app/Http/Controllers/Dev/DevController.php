<?php

namespace App\Http\Controllers\Dev;

use App\Http\Controllers\Controller;

class DevController extends Controller
{
    public function create_user()
    {
        $insert = [
          'email' => 'test@test.com1',
          'password' => '123456',
        ];
        \DB::Table('users')->insert($insert);
        echo '<pre>';
        print_r($insert);
        echo '</pre>';
    }
}
