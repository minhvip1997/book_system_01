<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\User;
use Socialite;
use App\Services\SocialFacebookAccountService;

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

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->redirectTo = url()->previous();
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        $view = property_exists($this, 'loginView') ? $this->loginView : 'auth.authenticate';

        if (view()->exists($view)) {
            return view($view);
        }
        return back()->with('message', __('message.needLogin'));
    }

    public function redirectToProvider()
	{
		return Socialite::driver('google')->redirect();
	}

    public function handleProviderCallback(Request $request)
    {
        try {
			session()->put('state', $request->input('state'));
			$user = Socialite::driver('google')->user();
        } catch (\Exception $e) {
            return redirect('/');
        }
        // only allow people with @company.com to login
        if(explode("@", $user->email)[1] !== 'gmail.com'){
            return redirect()->to('/')->with('error', 'Please use email ending "gmail".');
        }
        // check if they're an existing user
        $existingUser = User::where('email', $user->email)->first();
        if($existingUser){
            // log them in
            auth()->login($existingUser, true);
        } else {
            // create a new user
            $newUser                  = new User;
            $newUser->name            = $user->name;
            $newUser->email           = $user->email;
            $newUser->google_id       = $user->id;
            $newUser->save();
			auth()->login($newUser, true);

        }

        return redirect()->to('/');
    }

}
