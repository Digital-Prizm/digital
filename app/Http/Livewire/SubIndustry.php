<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Auth;
use App\Models\Sub_industry as SubIndustryDb;
use App\Models\Industry as IndustryDb;
use Log;
use App\Models\Util;
use DB;

class SubIndustry extends Component
{
    public $edit_id,$data,$message,$error,$notify_modal=0,$notify_content,$confirm_function,$confirm_modal=0,$confirm_content;
    public $value,$industries,$industry_id,$search_industry_id,$list;
    public $mode = "";
    public function mount()
    {
        
        $this->data = SubIndustryDb::all();
        $this->industries = IndustryDb::all();
    }
    public function render()
    {
       // $data = SubIndustryDb::all();
       // $this->industries = IndustryDb::all();
        
        //Log::info("render".$this->data);
       //return view('livewire.sub-industry',['data'=>$data,'industries'=>$this->industries]);
       return view('livewire.sub-industry');
    }
     /**
     * Load the SubIndustry form
     *
     * @return void
     */
	public function createForm()
    {
		
		if(!Auth::check()) {   	
			return redirect()->to('/login');
		}
		
		Log::info('form SubIndustry...');
       // $this->data = SubIndustryDb::all();

       //$data = SubIndustryDb::all();
        //Log::info("form".$this->data);
        return view('sub-industry');
       // return view('sub-industry',['data'=>$data,'industries'=>$this->industries]);

    }
    /**
     *  Create Industry
     *
     * @return void
     */
	public function create()
    {
        Log::info('create function from SubIndustry...');
        //return false;
        if($this->mode=="edit") {
			$this->update();
			return false;
		}

		 try {
            // Validating SubIndustry details
            if($this->isSubIndustryAvailable($this->value,$this->industry_id)) {
                $this->error = "Sorry! This name already exists";
                return false;
            }

			$this->validate([
				'value' => 'required|min:1',
			]);

			SubIndustryDb::create([
                'value' => $this->value,
                'industry_id' => $this->industry_id
			]);
		
            $this->search_industry_id = $this->industry_id;    
            $this->searchIndustry();
			$this->resetForm();
            $this->notify_modal=1;
            $this->notify_content = 'SubIndustry created successfully.';
            $this->dispatchBrowserEvent('closeModal');
			
                
			} catch (\Illuminate\Database\QueryException $e) {
				$this->error = $e->getMessage();
                return false;
			}
    }
     /**
     *  Edit form SubIndustry
     *
     * @return void
     */
    public function editForm($id)
    {
        $record = SubIndustryDb::findOrFail($id);
        $this->edit_id = $id;
        $this->value = $record->value;
        $this->industry_id = $record->industry_id;
        $this->mode = 'edit';

    }
    /**
     *  Update SubIndustry
     *
     * @return void
     */
	public function update()
    {
		 try {
            // Validating SubIndustry details
            if($this->isSubIndustryAvailable($this->value,$this->industry_id,$this->edit_id)) {
                $this->error = "Sorry! This name already exists";
                return false;
            }
			$this->validate([
				'value' => 'required|min:1',
			]);
            if ($this->edit_id) {
				$record = SubIndustryDb::find($this->edit_id);
                $record->update([
                'value' => $this->value,
                'industry_id' => $this->industry_id
			]);
                $this->search_industry_id = $this->industry_id;
                $this->searchIndustry();
                $this->resetForm();
				$this->mode = "";
				$this->notify_modal = 1;
				$this->notify_content = 'Content updated successfully!';
				//$this->data = SubIndustryDb::all();
                $this->dispatchBrowserEvent('closeModal');
            }
    
			} catch (\Illuminate\Database\QueryException $e) {
				$this->error = $e->getMessage();
                return false;
			}
    }
    /**
     *  Check SubIndustry exists or not
     *
     * @return void
     */
    public function isSubIndustryAvailable($name,$industry_id,$id="")
    {
        if ($id!="") {
            $record = DB::table('sub_industry')
                ->where('value', '=', $name)
                ->where('industry_id', '=', $industry_id)
                ->where('id', '<>', $id)
                ->get();

        }else {
            $record = DB::table('sub_industry')
            ->where('value', '=', $name)
            ->where('industry_id', '=', $industry_id)
            ->get();
        }

        if(isset($record[0])) {
            return true;
        }else {
            return false;
        }

    }
    /**
     *  Removing SubIndustry
     *
     * @return void
     */
    public function destroy($id)
    {
        if ($id) {
            $record = SubIndustryDb::where('id', $id);
            $record->delete();
			$this->data = SubIndustryDb::all();
            $this->resetForm();
        }
    }
     /**
     *  Search SubIndustry
     *
     * @return void
     */
    public function searchIndustry()
    {
       // $record = SubIndustryDb::findOrFail($id);
        $record = SubIndustryDb::where('industry_id', $this->search_industry_id)
               ->orderBy('value')
               ->get();
        Log::info($record);
        $this->data = $record;

    }
	public function resetForm()
    {
		$this->mode = '';
        $this->value="";
        $this->industry_id='';
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
