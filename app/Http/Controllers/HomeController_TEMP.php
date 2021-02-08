<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use DB;
use App\Models\Util;
use App\Models\Home;

use Session;
use Illuminate\Http\Request;

class HomeController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		//phpinfo();
        return view('home');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function loginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
       
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
           
        //$credentials = $request->only('email', 'password');
        //    echo "here";
		$users = DB::select('select id,name,email,role_id FROM users WHERE email = ? AND password = ?', [$request->get('email'),$request->get('password')]);
		//echo $users[0]->id;
		
		if(isset($users[0]) && $users[0]->id!="") {
			 session(['user_id' => $users[0]->id]);
			 session(['name' => $users[0]->name]);
			 session(['email' => $users[0]->email]);
			 session(['role_id' => $users[0]->role_id]);
			 return redirect('/dashboard')->with('status','You are Logged in');
		}
		//print_r($users);
		//die;
		/*	 
        if(Auth::guard('home')->attempt($request->only('email','password'))){
            //Authentication passed...
            return redirect('/')->with('status','You are Logged in');
        }
        */
		
        //if (Auth::attempt($credentials)) {
        //    return redirect()->intended('admin/');
       // }

        return redirect('/login')->with('error', 'Opps! You have entered invalid credentials');
    }

    public function logout() {
      Util::logout();

      return redirect('login');
    }
	/**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
		//phpinfo();
		if(!Util::checkUserSession()) {
			return redirect("/login");
		}
        return view('dashboard');
    }

}
