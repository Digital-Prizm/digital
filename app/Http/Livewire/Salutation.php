<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Auth;
use App\Models\Salutation as SalutationDb;
use Log;
use App\Models\Util;
use DB;

class Salutation extends Component
{
    public $edit_id,$data,$message,$error,$notify_modal=0,$notify_content,$confirm_function,$confirm_modal=0,$confirm_content;
    public $value;
    public $mode = "";

    public function render()
    {
        $this->data = SalutationDb::all();
        //Log::info($this->data);
        return view('livewire.salutation',['data'=>$this->data]);
    }
     /**
     * Load the Salutation form
     *
     * @return void
     */
	public function createForm()
    {
		
		if(!Auth::check()) {   	
			return redirect()->to('/login');
		}
		
		Log::info('form salutation...');
        $this->data = SalutationDb::all();
        return view('salutation');

    }
    /**
     *  Create salutation
     *
     * @return void
     */
	public function create()
    {
        Log::info('create function from salutation...');
        //return false;
        if($this->mode=="edit") {
			$this->update();
			return false;
		}

		 try {
            // Validating user details
            if($this->isSalutationAvailable($this->value)) {
                $this->error = "Sorry! This name already exists";
                return false;
            }

			$this->validate([
				'value' => 'required|min:1',
			]);

			SalutationDb::create([
                'value' => $this->value,
			]);
		

			$this->resetForm();
            $this->notify_modal=1;
            $this->notify_content = 'Salutation created successfully.';
            $this->dispatchBrowserEvent('closeModal');
			//session()->flash('message', 'Salutation created successfully.');
                
			} catch (\Illuminate\Database\QueryException $e) {
				$this->error = $e->getMessage();
                return false;
			}
    }
     /**
     *  Edit form salutation
     *
     * @return void
     */
    public function editForm($id)
    {
        $record = SalutationDb::findOrFail($id);
        $this->edit_id = $id;
        $this->value = $record->value;
        $this->mode = 'edit';

    }
    /**
     *  Update Salutation
     *
     * @return void
     */
	public function update()
    {
		 try {
            // Validating user details
            if($this->isSalutationAvailable($this->value,$this->edit_id)) {
                $this->error = "Sorry! This name already exists";
                return false;
            }
			$this->validate([
				'value' => 'required|min:1',
			]);
            if ($this->edit_id) {
				$record = SalutationDb::find($this->edit_id);
                $record->update([
                'value' => $this->value,
			]);
                $this->resetForm();
				$this->mode = "";
				$this->notify_modal = 1;
				$this->notify_content = 'Content updated successfully!';
				$this->data = SalutationDb::all();
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
    public function isSalutationAvailable($name,$id="")
    {
        if ($id!="") {
            $record = DB::table('salutation')
                ->where('value', '=', $name)
                ->where('id', '<>', $id)
                ->get();

        }else {
            $record = DB::table('salutation')
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
     *  Removing salutation
     *
     * @return void
     */
    public function destroy($id)
    {
        if ($id) {
            $record = SalutationDb::where('id', $id);
            $record->delete();
			$this->data = SalutationDb::all();
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
