<?php

namespace App\Http\Controllers;

use App\Helper\GitHubService;
use App\Helper\UserService;

class GithubController extends Controller
{
    public function index(GitHubService $githubService, UserService $userService)
    {
        $user = $userService->getUserDetails();

        if ($user->github_username === null) {
            return view('user.github', ['repositories' => false]);
        }

        $repositories = $githubService->getUserRepositories($user->github_username);
        return view('user.github', compact('repositories'));
    }
}
