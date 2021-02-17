<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\NoteModal;
use App\Models\Util;
use Auth;
class Dashboard extends Component
{
    public function dashboard()
    {
        //echo "#".Auth::user()->name;

        //if(!Util::checkUserSession()) {
        if(!Auth::check()) {   
			return redirect()->to('/login');
		}

        return view('dashboard');
    }
}
