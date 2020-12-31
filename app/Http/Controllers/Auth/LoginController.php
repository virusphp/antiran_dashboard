<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

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
    public function email()
    {
        return 'kd_pegawai';
    }

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
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:web')->except('logout');
    }

    public function login(Request $request)
    {
        $this->validate($request,$this->validate,$this->message);
        $count = User::where('kd_pegawai', '=', $request->username)->count();
        if ($count > 0) {   
            $data = User::where('kd_pegawai', '=', $request->username)->first();    
            if (Auth::attempt(['kd_pegawai'=>$request->username,'password'=>$request->password])) {
                $user = array(
                    'kd_pegawai' => $data['username'],
                    'nama_pegawai' => $data['name'],
                    'role' => $data['role'],                                    
                );
                Session::put('user',$user);    
                return redirect('admin/home')->with('type','success')->with('message','Berhasil login dengan selamat!');                   
            } else {
                return redirect()->route('login')->with("type","error")->with("message","Password Doesn't Match");                
            }
        } else {
            return redirect()->route('login')->with("type","error")->with("message","Username Not Fount");
           
        }
    }

    public function logout(){
        Session::flush();
        return redirect()->route('login');
    }
    
    private $validate=[        
        'username' => 'required|string|',
        'password' => 'required|string', 
    ];

    private $message=[        
        'username.required'  => 'Username harus di isi',
        // 'email.email'  => 'Valid format email',        
        'password.required' => 'Password harus di isi',        
    ];

}
