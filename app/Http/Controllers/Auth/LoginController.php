<?php

namespace Atom26\Http\Controllers\Auth;

use Atom26\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;

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
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return 'username';
    }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function credentials(Request $request)
    {
        return array_merge($request->only($this->username(), 'password'), ['active' => true]);
    }

    /**
     * The user has been authenticated.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Atom26\Accounts\User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function authenticated(Request $request, $user)
    {
        return $this->redirectBasedOnUserRole($user);
    }

    /**
     * Send the user is not activated response.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function sendUserIsNotActivatedResponse(Request $request)
    {
        return redirect()->back()
            ->withInput($request->only($this->username(), 'remember'))
            ->withErrors([
                $this->username() => trans('auth.notactive'),
            ]);
    }

    /**
     * Redirect user based on their role.
     *
     * @param \Atom26\Accounts\User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function redirectBasedOnUserRole($user)
    {
        if ($user->isAdmin()) {
            return redirect('/dashboard/admin');
        }

        if ($user->hasRole('hostess') || $user->hasRole('unihostess')) {
            return redirect('/dashboard/hostess');
        }

        if ($user->hasRole('editor')) {
            return redirect('/dashboard/editor');
        }

        return redirect('/profile');
    }
}
