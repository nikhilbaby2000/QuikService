<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ConfirmationController extends Controller
{

    public function verifyEmail($token, Request $request)
    {
        $user = User::where('email', $request->get('email'))->first();

        if (empty($user) || $user->email_confirmed || !hash_check($token, $user->email_confirmation_token)) {
            throw new NotFoundHttpException("Ooppsie! I don't know you!");
        }

        $user->forceFill([
            'email_confirmed' => true,
            'email_confirmation_token' => null,
            'active' => true,
        ])->save();

        flash(['by_email' => 'email']);

        return redirect(route('login'));
    }

    public function verify(Request $request)
    {
        $email = $request->get('email');

        if (empty($email)) {
            throw new NotFoundHttpException();
        }

        return view('auth.verify', ['by' => $request->get('by', 'email'), 'email' => $email]);
    }
}
