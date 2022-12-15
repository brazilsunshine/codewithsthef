<?php

namespace App\Http\Controllers\Auth;

use App\Events\UserSignedUp;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Mail\NewUserRegMail;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    /**
     * REGISTER
     */
    public function __invoke (StoreUserRequest $request)
    {
        $request->validated($request->all());

        $user = User::create([
            'name' => $request->name, // name is coming from Register.vue
            'username' => $request->username, // username is coming from Register.vue
            'email' => $request->email, // emails is coming from Register.vue
            'password' => Hash::make($request->password), // password is coming from Register.vue
        ]);

//        Mail::to($request->email)->send(new NewUserRegMail($user));

        return [
            'success' => true,
            'user' => $user
        ];
    }
}
