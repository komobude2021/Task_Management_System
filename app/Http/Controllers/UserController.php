<?php

namespace App\Http\Controllers;

use App\Helper\UserService;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserUpdateRequest;

class UserController extends Controller
{
    private $userService;
    const ERROR_MESSAGE = 'Unable To Update Information | Please Try Again';
    const ERROR_MESSAGE_ = 'Unable To Proceed | Github Username Value is Same';
    const SUCCESS_MESSAGE = 'User Information Successfully Updated';

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        $user = $this->userService->getUserDetails();
        return view('user.index', compact('user'));
    }

    public function update(UserUpdateRequest $request)
    {
        $validated = $request->validated();
        if ($validated['github_username'] === Auth::user()->github_username) {
            return back()->with(['error' => self::ERROR_MESSAGE_]);
        }

        $userUpdate = $this->userService->updateUserRecord($validated);
        if (!$userUpdate) {
            return back()->with(['error' => self::ERROR_MESSAGE]);
        }
        return back()->with(['success' => self::SUCCESS_MESSAGE]);
    }
}
