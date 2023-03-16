<?php

namespace App\Helper;

use App\Models\User;

class UserService {

    public function getUserDetails()
    {
        return User::find(auth()->id());
    }

    public function updateUserRecord($validated)
    {
        return User::where('id', auth()->id())->update(['github_username' => $validated['github_username']]);
    }
}