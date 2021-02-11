<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Http\Traits\ImageConvert;

class LoginController extends Controller
{
    use ImageConvert;
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
            $data = User::select('user_login_sep.kd_pegawai','user_login_sep.nama_pegawai','user_login_sep.role','pegawai.foto')
                    ->where('user_login_sep.kd_pegawai', '=', $request->username)
                    ->leftJoin('pegawai', 'user_login_sep.kd_pegawai','pegawai.kd_pegawai')
                    ->first();    
            $photoProfil = $data['foto'] == null ? "img/profile/profile.png" : $this->getPhoto($data['kd_pegawai'], $data['foto']);
            if (Auth::attempt(['kd_pegawai'=>$request->username,'password'=>$request->password])) {
                $user = array(
                    'kd_pegawai' => $data['kd_pegawai'],
                    'nama_pegawai' => $data['nama_pegawai'],
                    'role' => $data['role'],                                    
                    'foto' => $photoProfil
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
