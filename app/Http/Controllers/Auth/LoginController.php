<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\Auth\SendLoginOTPRequest;
use App\Http\Requests\Auth\UserLoginRequest;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Jobs\Notifications\SendOTPNotification;
use App\QuikService\Constants\Auth\Role;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    protected $loginIdentifier;

    /**
     * Create a new controller instance.
     *
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function forgotPassword(Request $request)
    {

    }

    public function loginBy(UserLoginRequest $request)
    {
        if ($this->hasValues($request, ['mobile', 'otp'])) {
            return $this->loginUserWithOTP($request, Role::USER);
        }

        if ($this->hasValues($request, ['email', 'password'])) {
            return $this->setLoginIdentifier('email')
                ->loginUserWithPassword($request, Role::USER);
        }

        if ($this->hasValues($request, ['username', 'password'])) {
            return $this->setLoginIdentifier('username')
                ->loginUserWithPassword($request, Role::USER);
        }

        return $this->respondBadRequest('Missing login credentials');
    }



    /**
     * Login the user using their email and password.
     *
     * @param \Illuminate\Foundation\Http\FormRequest $request
     * @param string|array $role
     * @return \Illuminate\Http\JsonResponse
     */
    protected function loginUserWithPassword($request, $role)
    {
        /** @var User $user */
        $user = null;
        $password = $request->input('password');
        $identifier = $this->getLoginIdentifier();
        $emailOrUsername = $request->input($identifier);

        if (method_exists($this, $method = 'resolveUserFrom' . Str::studly($identifier))) {
            $user = $this->{$method}($emailOrUsername, $role);
        }

        \Session::flash('by_email', 'email');

        if (!$user || !hash_check($password, $user->password)) {
            \Session::flash('error', 'Invalid Credentials');
            return redirect(route('login_view'));
        }

        if (!$user->isActive()) {
            \Session::flash('error', 'Account is not activated. Please verify your email!');
            return redirect(route('login_view'));
        }

        return $this->authenticateAndRespond($user, $request, false);
    }

    /**
     * Login the user using their mobile and otp.
     *
     * @param \Illuminate\Foundation\Http\FormRequest $request
     * @param string|array $role
     * @return \Illuminate\Http\JsonResponse
     */
    protected function loginUserWithOTP($request, $role)
    {
        $mobile = $request->input('mobile');
        $otp = $request->input('otp');

        $user = $this->resolveUserFromMobile($mobile, $role);

        if (!$user) {
            $this->throwCustomValidationException("User with that mobile number doesn't exist.", 'otp');
        }

        if (!$user->isValidOTP($otp)) {
            $this->throwCustomValidationException('The otp provided is invalid.', 'otp');
        }

        $user->update([
            'mobile_confirmed' => true,
            'active' => true,
            'otp' => null,
        ]);

        return $this->authenticateAndRespond($user, $request, false);
    }

    /**
     * Resolve the user from their email for a particular role.
     *
     * @param string $email
     * @param string|array $role
     * @return \App\Models\User|null
     */
    protected function resolveUserFromEmail($email, $role)
    {
        $user = User::where('email', $email)->first();

        return $user && $user->hasRole($role) ? $user : null;
    }

    /**
     * Resolve the user from their username for a particular role.
     *
     * @param $username $email
     * @param string|array $role
     * @return \App\Models\User|null
     */
    protected function resolveUserFromUsername($username, $role)
    {
        $user = User::where('username', $username)->first();

        return $user && $user->hasRole($role) ? $user : null;
    }

    /**
     * Resolve the user from their mobile for a particular role.
     *
     * @param string $mobile
     * @param string|array $role
     * @return \App\Models\User|null
     */
    protected function resolveUserFromMobile($mobile, $role)
    {
        $user = User::where('mobile', $mobile)->first();

        return $user && $user->hasRole($role) ? $user : null;
    }


    /**
     * Authenticate the user and respond accordingly.
     * SPA login will authenticate the user using sessions which will create the cookie on refresh.
     * First party apps (Mobile App) will get the access token and refresh token.
     *
     * @param \App\Models\User $user
     * @param \Illuminate\Foundation\Http\FormRequest $request
     * @param bool $needsToken
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     */
    protected function authenticateAndRespond(User $user, $request, $needsToken = false)
    {
        if ($needsToken) {
            return $this->issueToken([
                'grant_type'    => 'password',
                'client_id'     => config('auth.password_grant.client_id'),
                'client_secret' => config('auth.password_grant.client_secret'),
                'username'      => $request->input($this->getLoginIdentifier()),
                'password'      => $request->input('password'),
            ]);
        }

        return $this->authenticateUser($user, true/*$request->has('remember')*/);
    }

    /**
     * Generate and issue the Password Grant Token for the user.
     *
     * @param array $data
     * @return \Illuminate\Http\Response
     */
    protected function issueToken(array $data)
    {
        return app(AccessTokenController::class)
            ->issueToken(app(ServerRequestInterface::class)->withParsedBody($data));
    }

    /**
     * Login user using standard auth method and respond success.
     *
     * @param \App\Models\User $user
     * @param bool $remember
     * @return \Illuminate\Http\JsonResponse
     */
    protected function authenticateUser(User $user, $remember = false)
    {
        auth('web')->login($user, $remember);

        return redirect($this->redirectTo);

//        return $this->respondSuccess();
    }

    /**
     * Get the default login identifier.
     *
     * @return string
     */
    protected function getLoginIdentifier()
    {
        return $this->loginIdentifier;
    }

    /**
     * Set the default login identifier.
     * Can be email or username.
     *
     * @param string $loginIdentifier
     * @return $this
     */
    protected function setLoginIdentifier($loginIdentifier)
    {
        $this->loginIdentifier = $loginIdentifier;

        return $this;
    }

    public function requestOTP(SendLoginOTPRequest $request)
    {
        $mobile = $request->get('mobile');

        if (empty($mobile)) {
            return $this->respondOk(['error' => 'Mobile number cannot be empty']);
        }

        $user = $this->findUserByMobile($mobile);
        $otp = generate_otp(6);

        dispatch_now(new SendOTPNotification($otp, $mobile));

        $user->update(['otp' => bcrypt($otp)]);

        $username = !empty($user->name) ? "Hi {$user->name}, " : '';

        return $this->respondOk([], "{$username}Please verify your OTP.");

    }

    protected function findUserByMobile($mobile)
    {
        $user = User::where('mobile', $mobile)->first();

        if (empty($user)) {
            $user = User::create([
                'mobile' => $mobile,
            ]);
            $user->attachRole(Role::USER);
        }

        return $user;
    }
}
