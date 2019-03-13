<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\User;
use Socialite;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view('auth.login')->with('intended', request('intended'));
    }

    /**
     * @return string route to where redirect a user
     */
    public function redirectTo()
    {
        if (Auth::user()->is_admin) {
            return redirect()->route('admin.dashboard')->getTargetUrl();
        }

        return request()->filled('intended') ?
            request('intended') :
            redirect()->route('home')->getTargetUrl();
    }

    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('github')->redirect();
    }

    /**
     * Obtain the user information from provider.
     *
     * @return Response
     */
    public function handleProviderCallback()
    {
        $user = Socialite::driver('github')->user();

        $authUser = $this->findOrCreateUser($user, 'github');
        Auth::login($authUser, true);

        if ($authUser->email == 'patrique.ouimet@gmail.com') {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('home');
    }

    /**
     * If a user has registered before using social auth, return the user
     * else, create a new user object.
     * @param  $user Socialite user object
     * @param $provider Social auth provider
     * @return  User
     */
    public function findOrCreateUser($user, $provider)
    {
        $authUser = User::where('provider_id', $user->id)->first();

        if ($authUser) {
            return $authUser;
        }

        return User::create([
            'name'     => $user->name,
            'email'    => $user->email,
            'provider' => $provider,
            'provider_id' => $user->id
        ]);
    }
}
