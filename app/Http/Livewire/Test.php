<?php

namespace App\Http\Livewire;
use Log;
use Livewire\Component;
use App\Models\User;
use App\Models\Util;

class Test extends Component
{
  
    public function index()
    {
        Log::info('This is s test info');
		if(!Util::checkUserSession()) {
			//return redirect()->to('/login');
            return redirect()->to('/login');
			//return view();
			
		}else {
			//$this->render();
            return view('test');
		}
        //$this->data = NoteModal::all();
        //return view('livewire.note');
    }
}
