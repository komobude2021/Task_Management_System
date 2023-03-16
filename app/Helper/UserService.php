<?php

namespace App\Helper;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class UserService {

    public function getUserDetails()
    {
        return DB::table('users')->where('id', Auth::user()->id)->first();
    }

    public function updateUserRecord($validated)
    {
        return DB::table('users')
                ->where('id', Auth::user()->id)
                ->update(['github_username'=> $validated['github_username']]);
    }

}