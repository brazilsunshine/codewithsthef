<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AddAdminController extends Controller
{
    public function __construct ()
    {
        $this->middleware('admin');
    }

    public function __invoke (Request $request)
    {
        $request->validate([
            'email' => 'required|min:4',
        ]);

        $user = User::where('email', $request->email)->first();

        $user->assignRole('admin');

        return [
            'success' => true,
            'user' => $user
        ];
    }
}
