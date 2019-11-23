<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\SiteOption;
use Cookie;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

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
    protected $redirectTo = '/bs-admin';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['guest:admin'])->except('logout');
        $this->middleware('admin')->only('logout');
    }


    /**
     * @param Request $request
     * @return Factory|View
     */
    public function showLoginForm(Request $request)
    {
        $site_title = SiteOption::where('so_name', '=', 'site_title')->firstOrFail();
        if($request->hasCookie('session_last_activity')) {
            $session_last_active = (int) $request->cookie('session_last_activity'); // in seconds since January 1 1970 00:00:00 GMT
            $session_lifetime = (int) config('session.lifetime') * 60; // in seconds

            if(time() > ($session_last_active + $session_lifetime)) {
                return view('admin.auth.login')
                    ->with([
                        'site_title'=> $site_title->so_content,
                        'timeout_status' => true
                    ]);
            }
        }
        return view('admin.auth.login')
            ->with([
                'site_title'=> $site_title->so_content
            ]);
    }

    /**
     * Validate the user login request.
     *
     * @param Request $request
     * @return void
     * @throws ValidationException
     */
    protected function validateLogin(Request $request)
    {
        $this->validate($request, [
            $this->username() => 'required|string',
            'password' => 'required|string|min:6',
        ]);
    }

    /**
     * Attempt to log the user into the application.
     *
     * @param Request $request
     * @return bool
     */
    protected function attemptLogin(Request $request)
    {
        $admin = Admin::whereActive(true)
            ->where($this->username(), '=', $request->post($this->username()))
            ->first();

        if(!$admin) {
            return false;
        }

        return $this->guard()->attempt(
            $this->credentials($request), $request->filled('remember')
        );
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return 'email';
    }

    /**
     * Log the user out of the application.
     *
     * @param Request $request
     * @return Response
     */
    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        Cookie::queue(Cookie::forget('session_last_activity', '/bs-admin'));

        return redirect('/bs-admin/login');
    }




    /**
     * Get the guard to be used during authentication.
     *
     * @return StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('admin');
    }
}
