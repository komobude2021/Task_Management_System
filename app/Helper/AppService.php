<?php

namespace App\Helper;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AppService
{
    public static function checkIfEmailAlreadyExist($email)
    {
        return User::where('email', $email)->exists();
    }

    public function checkIfPasswordMatches($password, $confirmPassword)
    {
        return $password === $confirmPassword;
    }

    public function addNewUser($validatedUser)
    {
        $githubUsername = trim($validatedUser['github_username']) ?: null;
        $user = new User([
                    'firstname' => strtolower($validatedUser['firstname']),
                    'lastname' => strtolower($validatedUser['lastname']),
                    'email' => $validatedUser['email'],
                    'password' => Hash::make($validatedUser['password']),
                    'github_username' => $githubUsername,
                ]);
        return $user->save();
    }
}
