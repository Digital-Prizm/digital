<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Auth;
use App\Models\Occupation as OccupationDb;
use Log;
use App\Models\Util;
use DB;

class Occupation extends Component
{
    public $edit_id,$data,$message,$error,$notify_modal=0,$notify_content,$confirm_function,$confirm_modal=0,$confirm_content;
    public $value;
    public $mode = "";

    public function render()
    {
        $this->data = OccupationDb::all();
        //Log::info($this->data);
        return view('livewire.occupation',['data'=>$this->data]);
    }
     /**
     * Load the Occupation form
     *
     * @return void
     */
	public function createForm()
    {
		
		if(!Auth::check()) {   	
			return redirect()->to('/login');
		}
		
		Log::info('form Occupation...');
        $this->data = OccupationDb::all();
        return view('occupation');

    }
    /**
     *  Create gender
     *
     * @return void
     */
	public function create()
    {
        Log::info('create function from occupation...');
        //return false;
        if($this->mode=="edit") {
			$this->update();
			return false;
		}

		 try {
            // Validating occupation details
            if($this->isOccupationAvailable($this->value)) {
                $this->error = "Sorry! This name already exists";
                return false;
            }

			$this->validate([
				'value' => 'required|min:1',
			]);

			OccupationDb::create([
                'value' => $this->value,
			]);
		

			$this->resetForm();
            $this->notify_modal=1;
            $this->notify_content = 'Occupation created successfully.';
            $this->dispatchBrowserEvent('closeModal');
			//session()->flash('message', 'Occupation created successfully.');
                
			} catch (\Illuminate\Database\QueryException $e) {
				$this->error = $e->getMessage();
                return false;
			}
    }
     /**
     *  Edit form Occupation
     *
     * @return void
     */
    public function editForm($id)
    {
        $record = OccupationDb::findOrFail($id);
        $this->edit_id = $id;
        $this->value = $record->value;
        $this->mode = 'edit';

    }
    /**
     *  Update Occupation
     *
     * @return void
     */
	public function update()
    {
		 try {
            // Validating Occupation details
            if($this->isOccupationAvailable($this->value,$this->edit_id)) {
                $this->error = "Sorry! This name already exists";
                return false;
            }
			$this->validate([
				'value' => 'required|min:1',
			]);
            if ($this->edit_id) {
				$record = OccupationDb::find($this->edit_id);
                $record->update([
                'value' => $this->value,
			]);
                $this->resetForm();
				$this->mode = "";
				$this->notify_modal = 1;
				$this->notify_content = 'Content updated successfully!';
				$this->data = OccupationDb::all();
                $this->dispatchBrowserEvent('closeModal');
            }
    
			} catch (\Illuminate\Database\QueryException $e) {
				$this->error = $e->getMessage();
                return false;
			}
    }
    /**
     *  Check Occupation exists or not
     *
     * @return void
     */
    public function isOccupationAvailable($name,$id="")
    {
        if ($id!="") {
            $record = DB::table('occupation')
                ->where('value', '=', $name)
                ->where('id', '<>', $id)
                ->get();

        }else {
            $record = DB::table('occupation')
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
     *  Removing Occupation
     *
     * @return void
     */
    public function destroy($id)
    {
        if ($id) {
            $record = OccupationDb::where('id', $id);
            $record->delete();
			$this->data = OccupationDb::all();
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
