<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Util;
class Login extends Component
{
	public $email,$password,$isAuth=false,$error="";
    public function render()
    {
        return view('livewire.login');
    }
	public function authenticate()
    {
        
		try{
			$this->validate([
				'email' => 'required|string|email',
				'password' => 'required|string',
			]);
			
            //$record = User::find($this->selected_id);
         	
			//$users = DB::select('select id,name,email,role_id FROM users WHERE email = ? AND password = ?', [$request->get('email'),$request->get('password')]);
		
			$users = User::whereRaw('email = ? AND password = ?', [$this->email,$this->password])->get();
			
			} catch (Throwable $e) {
				$this->error = $e->getMessage();
				return false;
			}	
		if(isset($users[0]) && $users[0]->id!="") {
			 session(['user_id' => $users[0]->id]);
			 session(['name' => $users[0]->name]);
			 session(['email' => $users[0]->email]);
			 session(['role_id' => $users[0]->role_id]);
			 //return redirect('/dashboard')->with('status','You are Logged in');
			  return redirect()->to('/dashboard');
		}
		
		$this->error = "Opps! You have entered invalid credentials";
        //return redirect('/login')->with('error', 'Opps! You have entered invalid credentials');
        
    }
	public function logout() {
      Util::logout();
      return redirect()->to('/login');
    }
}
