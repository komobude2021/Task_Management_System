<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helper\GitHubService;
use App\Helper\UserService;

class GithubController extends Controller
{
    public function index(GitHubService $githubService, UserService $userService)
    {
        $user = $userService->getUserDetails();
        $repositories = false;

        if ($user->github_username != null) {
            $repositories = $githubService->getUserRepositories($user->github_username);
        }
        return view('user.github', compact('repositories'));
    }
}
