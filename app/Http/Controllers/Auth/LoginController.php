<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LoginController
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
    }

    public function showLoginForm(): View
    {
        return view('auth.login', ['intended' => $this->request->input('intended')]);
    }

    public function redirectTo(): string
    {
        $user = $this->request->user();

        abort_if(! $user, 401);

        if ($user->is_admin) {
            return redirect()->route('admin.dashboard')->getTargetUrl();
        }

        return $this->request->filled('intended') ?
            $this->request->input('intended') :
            redirect()->route('home')->getTargetUrl();
    }
}
