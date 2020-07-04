<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Contracts\User as SocialiteUser;

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

    public function showLoginForm() : View
    {
        return view('auth.login')->with('intended', $this->request->input('intended'));
    }

    public function redirectTo() : string
    {
        if ($this->request->user()->is_admin) {
            return redirect()->route('admin.dashboard')->getTargetUrl();
        }

        return $this->request->filled('intended') ?
            $this->request->input('intended') :
            redirect()->route('home')->getTargetUrl();
    }

    /** @return mixed */
    public function redirectToProvider()
    {
        return Socialite::driver('github')->redirect();
    }

    public function handleProviderCallback() : RedirectResponse
    {
        $user = Socialite::driver('github')->user();

        $authUser = $this->findOrCreateUser($user, 'github');
        Auth::login($authUser, true);

        if ($authUser->email === 'patrique.ouimet@gmail.com') {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('home');
    }

    public function findOrCreateUser(SocialiteUser $user, string $provider) : User
    {
        $authUser = User::where(static function ($query) use ($user) : void {
            $query->where('provider_id', $user->getId())
                ->orWhere('email', $user->getEmail());
        })->first();

        if ($authUser) {
            if (! $authUser->provider_id) {
                $authUser->update(['provider' => $provider, 'provider_id' => $user->getId()]);
            }

            return $authUser;
        }

        return User::create([
            'name'     => $user->getName(),
            'email'    => $user->getEmail(),
            'provider' => $provider,
            'provider_id' => $user->getId(),
        ]);
    }
}
