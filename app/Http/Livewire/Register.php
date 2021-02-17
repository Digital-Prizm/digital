<?php

namespace App\Http\Livewire;
use Livewire\WithFileUploads;
use Livewire\Component;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Models\Util;
use App\Models\Salutation;
use App\Models\Occupation;
use App\Models\Industry;
use App\Models\Sub_industry;
use App\Models\Gender;
use App\Models\Family_relations;

use Auth;
use Hash;
use DB;
class Register extends Component
{
	public $edit_id,$data,$message,$error;
    public $salutation_id, $firstname="test", $lastname="ll", $gender_id="1",$phone="34343",$mobile="232323";
    public $company_address,$primary_address="dfsdf",$secondary_address="Sdfsdf",$dob="1980-01-02",$assumed_date="2000-10-02",$occupation_id="1",$company_name="DIG",$industry_id="1",$sub_industry="1",$skill="fsd",$rate="3",$family_firstname="dfsdf",$family_lastname,$family_gender_id="1",$family_email="sdfsd@sdfasd.com",$family_phone="23423",$family_relation_id="father",$family_color_indicator,$expiry_date="1980-02-03",$expiry_before_date, $email="test@test.com", $password="password",$role_id,$updated_at,$created_at;
    public $file_single,$file_multiple=[],$master_sub_industry=[];
    public $mode = "";
  //  public Post $post;
    use WithFileUploads;

    protected $listeners = ['listener_calculateAssumedDate' => 'calculateAssumedDate'];

    /**
     * Load the Registration form
     *
     * @return void
     */
	public function registerForm()
    {
		
		if(!Auth::check()) {   	
			//return redirect()->to('/login');
		}
		
		//$this->data = User::all();
        Log::info('Loading.. ');
        return view('register');

    }
    /**
     * Rendering register module
     *
     * @return void
     */
	public function render()
    {
		//$this->data = "test";
	    //return view('livewire.register');
        $master_salutation = Salutation::all();
        $master_gender = Gender::all();
        $master_occupation = Occupation::all();
        $master_industry = Industry::all();
        
        $master_family_relations = Family_relations::all();

        return view('livewire.register',['master_salutation' => $master_salutation, 'master_gender' => $master_gender, 'master_occupation' => $master_occupation, 'master_industry' => $master_industry, 'master_family_relations' => $master_family_relations]);

    }
    /**
     * To get sub industries details
     *
     * @return array()
     */
    public function getSubIndustry() {
        Log::info('getSubIndustry...');
        //$this->master_sub_industry = Sub_industry::all();
        $this->master_sub_industry = DB::table('sub_industry')->where('industry_id', $this->industry_id)->get();
       
        Log::info('data = '.$this->master_sub_industry);
    }
    /**
     * To calculate  DOB + 11 Years 7 Months + 3 Days 
     * And set it to assumed date
     * @return array()
     */
    public function calculateAssumedDate() {
        //$this->master_sub_industry = Sub_industry::all();
        $this_date = strtotime("+11 year", strtotime($this->dob));
        //$this->company_name = date("Y-m-d",$this_date);
        $this_date = strtotime("+7 month", $this_date);
        //$this->company_address =date("Y-m-d",$this_date);
        $this_date = strtotime("+3 day", $this_date);
        $this->assumed_date = date("Y-m-d",$this_date);
    }
    
    /**
     * Register user details
     *
     * @return void
     */
	public function register()
    {
            
		 try {
			$this->validate([
				'firstname' => 'required|min:2',
				'lastname' => 'required|min:2',
                'gender_id' => 'required',
                'phone' => 'required|min:2',
                'mobile' => 'required|min:2',
                'primary_address' => 'required',
                'secondary_address' => 'required',
                'dob' => 'required|min:9',
                'assumed_date' => 'required|min:9',
                'occupation_id' => 'required',
                'company_name' => 'required|min:2',
                'industry_id' => 'required',
                'skill' => 'required',
                'family_firstname' => 'required',
                'family_gender_id' => 'required',
                'file_single' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'expiry_date' => 'required',

			]);
             
            $file_single_name = "single_file".time()."_".$this->file_single->getClientOriginalName();
            $this->file_single->storeAs('files', $file_single_name);
            
            $file_multiple_name = [];
            if(!empty($this->file_multiple)) {
                foreach ($this->file_multiple as $file) {
                    $file_name = "file_multiple".time()."_".$file->getClientOriginalName();
                    $file->storeAs('files',$file_name);
                    $file_multiple_name[] = $file_name;
                }
            }
            $this->message = $this->file_single->getClientOriginalName();

            $file_multiple_name = json_encode($file_multiple_name);
            
//$this->message = "#".$this->firstname."=".$this->salutation;

  //          return false;

			User::create([
                'salutation_id' => $this->salutation_id,
                'firstname' => $this->firstname,
                'lastname' => $this->lastname,
                'gender_id' => $this->gender_id,
                'phone' => $this->phone,
                'mobile' => $this->mobile,
                'primary_address' => $this->primary_address,
                'secondary_address' => $this->secondary_address,
                'dob' => $this->dob,
                'assumed_date' => $this->assumed_date,
                'occupation_id' => $this->occupation_id,
                'company_name' => $this->company_name,
                'company_address' => $this->company_address,
                'industry_id' => $this->industry_id,
                'sub_industry_id' => $this->sub_industry_id,
                'skill' => $this->skill,
                'rate' => $this->rate,
                'family_firstname' => $this->family_firstname,
                'family_lastname' => $this->family_lastname,
                'family_email' => $this->family_email,
                'family_phone' => $this->family_phone,
                'family_gender_id' => $this->family_gender_id,
                'family_relation_id' => $this->family_relation_id,
                'family_color_indicator' => $this->family_color_indicator,
                'file_single' => $file_single_name,
                'file_multiple' => $file_multiple_name,
                'expiry_date' => $this->expiry_date,
                'expiry_before_date' => $this->expiry_before_date,
                'email' => $this->email,
                'password' => Hash::make($this->password),
				'created_at' => date("Y-m-d H:i:s"),
                'created_by' => 'self',
                'status' => 'A',
			]);
		
            return redirect()->to('/login');

			//$this->resetForm();
			session()->flash('message', 'Registration successfully completed.');
                
			} catch (\Illuminate\Database\QueryException $e) {
				$this->error = $e->getMessage();
                //report($e);
                return false;
			}
    }

	public function resetForm()
    {
		$this->mode = '';
		$this->error="";
		$this->errors=null;
		$this->resetErrorBag();
		$this->resetValidation();
    }
}
