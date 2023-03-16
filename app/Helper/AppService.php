<?php

namespace App\Helper;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AppService
{
    public static function checkIfEmailAlreadyExist($email)
    {
        return DB::table('users')->where('email', $email)->exists();
    }

    public function checkIfPasswordMatches($password, $confirmPassword)
    {
        return $password === $confirmPassword;
    }

    public function addNewUser($validatedUser)
    {
        $githubUsername = trim($validatedUser['github_username']) ?: null;
        return DB::table('users')->insert([
            'firstname' => strtolower($validatedUser['firstname']),
            'lastname' => strtolower($validatedUser['lastname']),
            'email' => $validatedUser['email'],
            'password' => Hash::make($validatedUser['password']),
            'github_username' => $githubUsername,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
