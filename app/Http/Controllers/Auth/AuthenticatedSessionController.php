<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Providers\RouteServiceProvider;
use App\Http\Requests\Auth\LoginRequest;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(Request $request)
    {
        if ($request->temporary_token) {
            $user = User::where(
                'temporary_token',
                $request->temporary_token
            )->first();

            if ($user) {
                $user->temporary_token = null;
                $user->save();

                Auth::login($user);
                $project = $user->projects()->firstOrFail();
                return $this->redirectTo($project, $request->admin);
            }
        }

        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function redirectTo($project, $admin)
    {
        if ($admin == 'true') {
            return redirect()->route('admin.projects.show', $project);
        } else {
            return redirect()->route('projects.show', $project);
        }
    }
}
