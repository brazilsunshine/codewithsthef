<?php

namespace App\Http\Controllers\Contact;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function __invoke (Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
        ]);

        try
        {
            $message = Contact::create([
                'name' => $request->name,
                'email' => $request->email,
                'message' => $request->message,
            ]);
        }
        catch (\Exception $exception)
        {
            \Log::info(['ContactController', $exception->getMessage()]);

            return [
                'success' => false,
                'msg' => 'problem'
            ];
        }

        return [
            'success' => true,
        ];
    }
}
