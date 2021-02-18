<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Auth;
use App\Models\Industry as IndustryDb;
use Log;
use App\Models\Util;
use DB;

class Industry extends Component
{
    public $edit_id,$data,$message,$error,$notify_modal=0,$notify_content,$confirm_function,$confirm_modal=0,$confirm_content;
    public $value;
    public $mode = "";

    public function render()
    {
        $this->data = IndustryDb::all();
        //Log::info($this->data);
        return view('livewire.industry',['data'=>$this->data]);
    }
     /**
     * Load the Industry form
     *
     * @return void
     */
	public function createForm()
    {
		
		if(!Auth::check()) {   	
			return redirect()->to('/login');
		}
		
		Log::info('form Industry...');
        $this->data = IndustryDb::all();
        return view('industry');

    }
    /**
     *  Create Industry
     *
     * @return void
     */
	public function create()
    {
        Log::info('create function from Industry...');
        //return false;
        if($this->mode=="edit") {
			$this->update();
			return false;
		}

		 try {
            // Validating Industry details
            if($this->isIndustryAvailable($this->value)) {
                $this->error = "Sorry! This name already exists";
                return false;
            }

			$this->validate([
				'value' => 'required|min:1',
			]);

			IndustryDb::create([
                'value' => $this->value,
			]);
		

			$this->resetForm();
            $this->notify_modal=1;
            $this->notify_content = 'Industry created successfully.';
            $this->dispatchBrowserEvent('closeModal');
			
                
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
        $record = IndustryDb::findOrFail($id);
        $this->edit_id = $id;
        $this->value = $record->value;
        $this->mode = 'edit';

    }
    /**
     *  Update Industry
     *
     * @return void
     */
	public function update()
    {
		 try {
            // Validating Industry details
            if($this->isIndustryAvailable($this->value,$this->edit_id)) {
                $this->error = "Sorry! This name already exists";
                return false;
            }
			$this->validate([
				'value' => 'required|min:1',
			]);
            if ($this->edit_id) {
				$record = IndustryDb::find($this->edit_id);
                $record->update([
                'value' => $this->value,
			]);
                $this->resetForm();
				$this->mode = "";
				$this->notify_modal = 1;
				$this->notify_content = 'Content updated successfully!';
				$this->data = IndustryDb::all();
                $this->dispatchBrowserEvent('closeModal');
            }
    
			} catch (\Illuminate\Database\QueryException $e) {
				$this->error = $e->getMessage();
                return false;
			}
    }
    /**
     *  Check Industry exists or not
     *
     * @return void
     */
    public function isIndustryAvailable($name,$id="")
    {
        if ($id!="") {
            $record = DB::table('industry')
                ->where('value', '=', $name)
                ->where('id', '<>', $id)
                ->get();

        }else {
            $record = DB::table('industry')
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
     *  Removing Industry
     *
     * @return void
     */
    public function destroy($id)
    {
        if ($id) {
            $record = IndustryDb::where('id', $id);
            $record->delete();
			$this->data = IndustryDb::all();
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
