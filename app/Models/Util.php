<?php
namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Util
{
    use Notifiable;

    
    /**
     * The attributes that check user session
     *
     * @var array
     */
    public static function checkUserSession(){
		//echo "##".session("user_id");
		if(session("user_id")!="") {
			return true;
		}else {
			
			return false;
		}
	}
	
	/**
     * The attributes that check user session
     *
     * @var array
     */
    public static function logout(){
		
		
		session()->forget('user_id');
		session()->forget('name');
		session()->forget('email');
		session()->forget('role_id');
		session()->flush();
	}
	
	
	
}