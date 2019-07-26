<?php

namespace App\Http\Controllers\Auth;

 
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

 
class PembeliLoginController extends Controller

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
        $this->middleware('guest')->except('logout');
    }

    public function guard()
    {
      return auth()->guard('pembeli');
    }
 

    public function showLoginForm()
    {
        return view('pembeli.login');
    }

    public function logout(Request $request)
    {
        auth()->guard('pembeli')->logout();
        $request->session()->flush();
        $request->session()->regenerate();
        return redirect()->guest(route('home'));
    }
    
}