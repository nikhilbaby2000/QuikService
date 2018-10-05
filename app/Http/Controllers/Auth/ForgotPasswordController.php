<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use App\Http\Requests\Auth\Password\ForgotPasswordRequest;
use App\Jobs\Notifications\Auth\Password\PasswordResetNotification;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get the forgot password view
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function view()
    {
        return view('auth.forgot-password');
    }

    /**
     * Send Reset password link.
     *
     * @param ForgotPasswordRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function reset(ForgotPasswordRequest $request)
    {
        $user = User::where('email', $request->get('email'))->first();

        $this->dispatch(new PasswordResetNotification($user, $this->broker()->createToken($user)));

        flash(['reset-send' => 'Check your email for a link to reset your password. If it doesn’t appear within a few minutes, check your spam folder.']);

        return redirect(route('forgot_password_view'));
    }
}
