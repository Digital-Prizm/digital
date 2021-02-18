<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Auth;
use App\Models\Gender as GenderDb;
use Log;
use App\Models\Util;
use DB;

class Gender extends Component
{
    public $edit_id,$data,$message,$error,$notify_modal=0,$notify_content,$confirm_function,$confirm_modal=0,$confirm_content;
    public $value;
    public $mode = "";

    public function render()
    {
        $this->data = GenderDb::all();
        //Log::info($this->data);
        return view('livewire.gender',['data'=>$this->data]);
    }
     /**
     * Load the Gender form
     *
     * @return void
     */
	public function createForm()
    {
		
		if(!Auth::check()) {   	
			return redirect()->to('/login');
		}
		
		Log::info('form gender...');
        $this->data = GenderDb::all();
        return view('gender');

    }
    /**
     *  Create gender
     *
     * @return void
     */
	public function create()
    {
        Log::info('create function from gender...');
        //return false;
        if($this->mode=="edit") {
			$this->update();
			return false;
		}

		 try {
            // Validating gender details
            if($this->isGenderAvailable($this->value)) {
                $this->error = "Sorry! This name already exists";
                return false;
            }

			$this->validate([
				'value' => 'required|min:1',
			]);

			GenderDb::create([
                'value' => $this->value,
			]);
		

			$this->resetForm();
            $this->notify_modal=1;
            $this->notify_content = 'Gender created successfully.';
            $this->dispatchBrowserEvent('closeModal');
			//session()->flash('message', 'gender created successfully.');
                
			} catch (\Illuminate\Database\QueryException $e) {
				$this->error = $e->getMessage();
                return false;
			}
    }
     /**
     *  Edit form gender
     *
     * @return void
     */
    public function editForm($id)
    {
        $record = GenderDb::findOrFail($id);
        $this->edit_id = $id;
        $this->value = $record->value;
        $this->mode = 'edit';

    }
    /**
     *  Update gender
     *
     * @return void
     */
	public function update()
    {
		 try {
            // Validating gender details
            if($this->isGenderAvailable($this->value,$this->edit_id)) {
                $this->error = "Sorry! This name already exists";
                return false;
            }
			$this->validate([
				'value' => 'required|min:1',
			]);
            if ($this->edit_id) {
				$record = GenderDb::find($this->edit_id);
                $record->update([
                'value' => $this->value,
			]);
                $this->resetForm();
				$this->mode = "";
				$this->notify_modal = 1;
				$this->notify_content = 'Content updated successfully!';
				$this->data = GenderDb::all();
                $this->dispatchBrowserEvent('closeModal');
            }
    
			} catch (\Illuminate\Database\QueryException $e) {
				$this->error = $e->getMessage();
                return false;
			}
    }
    /**
     *  Check gender exists or not
     *
     * @return void
     */
    public function isGenderAvailable($name,$id="")
    {
        if ($id!="") {
            $record = DB::table('gender')
                ->where('value', '=', $name)
                ->where('id', '<>', $id)
                ->get();

        }else {
            $record = DB::table('gender')
            ->where('value', '=', $name)
            ->get();
        }

        if(isset($record[0])) {
            return true;
        }else {
            return false;
        }

    }
    /**
     *  Removing gender
     *
     * @return void
     */
    public function destroy($id)
    {
        if ($id) {
            $record = GenderDb::where('id', $id);
            $record->delete();
			$this->data = GenderDb::all();
            $this->resetForm();
        }
    }
	public function resetForm()
    {
		$this->mode = '';
        $this->value="";
		$this->error="";
		$this->errors=null;
        $this->notify_modal = 0;
        $this->notify_content = "";
        $this->confirm_modal=0;
        $this->confirm_content='';
        $this->confirm_function='';
		$this->resetErrorBag();
		$this->resetValidation();
    }
    public function test() {
        Log::info("test");
        $this->error = "hello";
    }
    public function closeNotification() {
        $this->notify_modal = 0;
        $this->notify_content = "";
    }
}
