<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $phonenumber;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->phonenumber = $this->findUser();
    }

    public function index()
    {
        return view('auth.login');
    }

    public function findUser()
    {
        $login = request()->input('login');
 
        $fieldType = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'phonenumber';
 
        request()->merge([$fieldType => $login]);
 
        return $fieldType;
    }
 
    public function phonenumber()
    {
        return $this->phonenumber;
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'login'    => 'required',
            'password' => 'required',
        ]);

        $login_type = filter_var($request->input('login'), FILTER_VALIDATE_EMAIL ) 
            ? 'email' 
            : 'phonenumber';

        $request->merge([
            $login_type => $request->input('login')
        ]);

        $remember = $request->has('remember') ? true : false; 

        if (Auth::attempt([$login_type => $request->input('login'), 'password' => $request->input('password')], $remember)) {
            return redirect()->intended($this->redirectPath());
        }

        return redirect()->back()
            ->withInput()
            ->withErrors([
                'login' => 'Incorrect email/phonenumber or Password'
            ]);

    }

    public function logout(Request $request)
    {
        Auth::logout();

        Session::invalidate();

        Session::regenerateToken();

        return redirect('/');
    }
}
