<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Hash;
use App\Models\User;
use App\Models\Util;
use Illuminate\Support\Facades\Auth;
#use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Login extends Component
{
	public $email,$password,$isAuth=false,$error="";
    public function render()
    {
        return view('livewire.login');
    }
	public function loginForm()
    {
        return view('login');
    }
	public function authenticate()
    {
        
		try{
				
			$this->validate([
				'email' => 'required|string|email',
				'password' => 'required|string',
			]);
			

			
            //$record = User::find($this->selected_id);
         	
			//$user = DB::select('select id,name,email,role_id FROM users WHERE email = ? AND password = ?', [$request->get('email'),$request->get('password')]);
			/*	
			$user = User::whereRaw('email = ?', [$this->email])->first();
			if (!$user) {
				$this->error = "Opps! You have entered invalid email address";
				return false;
			 }
			 //$this->error =$user->name;
			 //return false;
			 
			 if (!Hash::check($this->password, $user->password)) {
				$this->error = "Opps! You have entered invalid credentials";
				return true;
			 }
			 */

			 if(Auth::attempt(array('email' => $this->email, 'password' => $this->password),1)){
				 $this->error="true".Auth::user()->name;
				 session(['user_id' => Auth::user()->id]);
				 session(['name' => Auth::user()->name]);
				 session(['email' => Auth::user()->email]);
				 session(['role_id' => Auth::user()->role_id]);
				  return redirect()->to('/dashboard');
			 }else {
				$this->error = "Opps! You have entered invalid credentials";
			 }
			/*
			 if(isset($user->id) && $user->id!="") {
				//Auth::login($user,true);
				 Auth::login($user);
				 //return false;
				 session(['user_id' => $user->id]);
				 session(['name' => $user->name]);
				 session(['email' => $user->email]);
				 session(['role_id' => $user->role_id]);
				  return redirect()->to('/dashboard');
				}else {
					$this->error = "Opps! You have entered invalid credentials";
				}
			*/

		//	$credentials = $request->only('email', 'password');

		/*
			if(\Auth::attempt(array('email' => $this->email, 'password' => $this->password),1)){
                session()->flash('message', "You have been successfully login.");
				
				return redirect()->to('/dashboard');
			}else{
				session()->flash('error', 'email and password are wrong.');
				$this->error = "Opps! You have entered invalid credentials";

			}
		*/	
			
			} catch (Throwable $e) {
				$this->error = "here".$e->getMessage();
				return false;
			}	
			
		
		
        //return redirect('/login')->with('error', 'Opps! You have entered invalid credentials');
        
    }
	public function logout() {
      //Util::logout();
	  Auth::logout();
      return redirect()->to('/login');
    }
}
