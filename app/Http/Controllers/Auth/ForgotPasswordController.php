<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use App\Http\Requests\Auth\Password\ResetPasswordRequest;
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
    public function forgotPassword(ForgotPasswordRequest $request)
    {
        $user = User::where('email', $request->get('email'))->first();

        $this->dispatch(new PasswordResetNotification($user, $this->broker()->createToken($user)));

        flash(['reset-send' => 'Check your email for a link to reset your password. If it doesn’t appear within a few minutes, check your spam folder.']);

        return redirect(route('forgot_password_view'));
    }

    /**
     * Get the Reset password view.
     *
     * @param $token
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function resetView($token, Request $request)
    {
        $email = $request->input('email');
        $this->validatePasswordResetToken($email, $token);

        return view('auth.reset-password', [
            'email' => $email,
            'token' => $token,
        ]);
    }

    /**
     * Reset Password
     *
     * @param $token
     * @param ResetPasswordRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function reset($token, ResetPasswordRequest $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        $user = $this->validatePasswordResetToken($email, $token);

        $user->forceFill([
            'password' => bcrypt($password),
            'email_confirmed' => true,
            'active' => true,
        ])->save();

        // Delete the password reset token.
        $this->broker()->deleteToken($user);

        // Revoke all the existing access tokens attached to the user.
        $this->revokeActiveTokens($user);

        flash(['success' => 'Your password has been reset successfully. Please login.']);

        return redirect(route('login_view'));
    }

    /**
     * Validate the password rest token and return the user.
     *
     * @param string $email
     * @param string $token
     * @return User
     */
    protected function validatePasswordResetToken($email, $token)
    {
        $user = User::where('email', $email)->first();

        if (!$user || !$this->broker()->tokenExists($user, $token)) {
            $this->throwCustomException(
                'The password reset token is invalid or has expired.',
                'token'
            );
        }

        return $user;
    }
}
