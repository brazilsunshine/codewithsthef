<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Validate the request then check if we have the user's information in our database.
     */
    public function __invoke (LoginUserRequest $request)
    {
        $request->validated($request->all());

        // only want to check validation on the username and password.
        if (!Auth::attempt($request->only('username', 'password')))
        {
            return $this->error('', 'Credentials do not match', 401);
        }

        $user = User::where('username', $request->username)
            ->first();

        return [
            'success' => true,
            'user' => $user,
        ];
    }
}
