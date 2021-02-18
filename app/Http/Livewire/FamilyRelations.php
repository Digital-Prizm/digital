<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Auth;
use App\Models\Family_relations as FamilyRelationsDb;
use Log;
use App\Models\Util;
use DB;

class FamilyRelations extends Component
{
    public $edit_id,$data,$message,$error,$notify_modal=0,$notify_content,$confirm_function,$confirm_modal=0,$confirm_content;
    public $value;
    public $mode = "";

    public function render()
    {
        $this->data = FamilyRelationsDb::all();
        //Log::info($this->data);
        return view('livewire.family-relations',['data'=>$this->data]);
    }
     /**
     * Load the FamilyRelations form
     *
     * @return void
     */
	public function createForm()
    {
		
		if(!Auth::check()) {   	
			return redirect()->to('/login');
		}
		
		Log::info('form FamilyRelations...');
        $this->data = FamilyRelationsDb::all();
        return view('family-relations');

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
            // Validating FamilyRelations details
            if($this->isFamilyRelationsAvailable($this->value)) {
                $this->error = "Sorry! This name already exists";
                return false;
            }

			$this->validate([
				'value' => 'required|min:1',
			]);

			FamilyRelationsDb::create([
                'value' => $this->value,
			]);
		

			$this->resetForm();
            $this->notify_modal=1;
            $this->notify_content = 'FamilyRelation created successfully.';
            $this->dispatchBrowserEvent('closeModal');
			
                
			} catch (\Illuminate\Database\QueryException $e) {
				$this->error = $e->getMessage();
                return false;
			}
    }
     /**
     *  Edit form FamilyRelations
     *
     * @return void
     */
    public function editForm($id)
    {
        $record = FamilyRelationsDb::findOrFail($id);
        $this->edit_id = $id;
        $this->value = $record->value;
        $this->mode = 'edit';

    }
    /**
     *  Update FamilyRelations
     *
     * @return void
     */
	public function update()
    {
		 try {
            // Validating FamilyRelations details
            if($this->isFamilyRelationsAvailable($this->value,$this->edit_id)) {
                $this->error = "Sorry! This name already exists";
                return false;
            }
			$this->validate([
				'value' => 'required|min:1',
			]);
            if ($this->edit_id) {
				$record = FamilyRelationsDb::find($this->edit_id);
                $record->update([
                'value' => $this->value,
			]);
                $this->resetForm();
				$this->mode = "";
				$this->notify_modal = 1;
				$this->notify_content = 'Content updated successfully!';
				$this->data = FamilyRelationsDb::all();
                $this->dispatchBrowserEvent('closeModal');
            }
    
			} catch (\Illuminate\Database\QueryException $e) {
				$this->error = $e->getMessage();
                return false;
			}
    }
    /**
     *  Check FamilyRelations exists or not
     *
     * @return void
     */
    public function isFamilyRelationsAvailable($name,$id="")
    {
        if ($id!="") {
            $record = DB::table('family_relations')
                ->where('value', '=', $name)
                ->where('id', '<>', $id)
                ->get();

        }else {
            $record = DB::table('family_relations')
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
            $record = FamilyRelationsDb::where('id', $id);
            $record->delete();
			$this->data = FamilyRelationsDb::all();
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
