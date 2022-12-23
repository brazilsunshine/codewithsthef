<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    /**
     * LOGOUT
     */
    public function __invoke ()
    {
        auth()->guard('web')->logout();

        return [
            'success' => true,
            'message' => 'You have successfully logged out!'
        ];
    }
}
