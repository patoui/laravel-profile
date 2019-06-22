<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\User;
use Socialite;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
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

    /** @var Request */
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->middleware('guest', ['except' => 'logout']);
    }

    public function showLoginForm():  View
    {
        return view('auth.login')->with('intended', request('intended'));
    }

    public function redirectTo(): string
    {
        if ($this->request->user()->is_admin) {
            return redirect()->route('admin.dashboard')->getTargetUrl();
        }

        return $this->request->filled('intended') ?
            $this->request->input('intended') :
            redirect()->route('home')->getTargetUrl();
    }

    public function redirectToProvider(): Response
    {
        return Socialite::driver('github')->redirect();
    }

    public function handleProviderCallback(): RedirectResponse
    {
        $user = Socialite::driver('github')->user();

        $authUser = $this->findOrCreateUser($user, 'github');
        Auth::login($authUser, true);

        if ($authUser->email == 'patrique.ouimet@gmail.com') {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('home');
    }

    public function findOrCreateUser(User $user, string $provider): User
    {
        $authUser = User::where(function ($query) use ($user) {
            $query->where('provider_id', $user->id)
                ->orWhere('email', $user->email);
        })->first();

        if ($authUser) {
            if (! $authUser->provider_id) {
                $authUser->update(['provider' => $provider, 'provider_id' => $user->id]);
            }

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
