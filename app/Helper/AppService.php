<?php

namespace App\Helper;

use Illuminate\Support\Facades\DB;

class AppService
{
    public static function checkIfEmailAlreadyExist($email)
    {
        return DB::table('users')->where('email', $email)->exists();
    }
}
