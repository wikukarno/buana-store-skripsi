<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\EmailAfterRegistration;
use App\Notifications\WelcomeEmailNotification;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Laravel\Socialite\Facades\Socialite;
use RealRashid\SweetAlert\Facades\Alert;

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
    protected $redirectTo = '/';

    // Limit Login 
    protected $maxAttempts = 3;
    protected $decayMinutes = 1;

    // Login & Register with Google
    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }
    public function handlerProviderCallback(Request $request)
    {

        $callback = Socialite::driver('google')->stateless()->user();

        $data = [
            'name' => $callback->getName(),
            'email' => $callback->getEmail(),
            'password' => false,
            'email_verified_at' => date('Y-m-d H:i:s', time()),
            'reg_status' => 'GOOGLE'
        ];

        // $user = User::firstOrCreate(
        //     ['email' => $data['email']], $data);

        $user = User::where('email', $data['email'])->first();
        if (!$user) {
            $user = User::create($data);
            $user->notify(new EmailAfterRegistration());
        }
        Auth::login($user, true);
        return redirect('/');

    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
