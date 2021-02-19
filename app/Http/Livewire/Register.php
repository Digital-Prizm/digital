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
    public $company_address,$primary_address="dfsdf",$secondary_address="Sdfsdf",$dob="1980-01-02",$assumed_date="2000-10-02",$occupation_id="1",$company_name="DIG",$industry_id="1",$sub_industry_id="1",$skill="fsd",$rate="3",$family_firstname="dfsdf",$family_lastname,$family_gender_id="1",$family_email="sdfsd@sdfasd.com",$family_phone="23423",$family_relation_id="father",$family_color_indicator,$expiry_date="1980-02-03",$expiry_before_date, $email="test@test.com", $password="password",$role_id,$updated_at,$created_at;
    public $file_single,$file_multiple=[],$master_sub_industry=[],$file_single_name,$file_multiple_name;
    public $mode = "",$form=1,$form_all=1;
  //  public Post $post;
    use WithFileUploads;

    //protected $listeners = ['listener_calculateAssumedDate' => 'calculateAssumedDate'];

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
        //Log::info('getSubIndustry...');
        //$this->master_sub_industry = Sub_industry::all();
        $this->master_sub_industry = DB::table('sub_industry')->where('industry_id', $this->industry_id)->get();
       
        Log::info('data = '.$this->master_sub_industry);
    }

     /**
     * Show forms
     *
     * @return array()
     */
    public function formShow($no) {
        
        //$this->master_sub_industry = Sub_industry::all();
        $this->form = $no;
        
    }

     /**
     * Show forms
     *
     * @return array()
     */
    public function formAllShow() {
        
        $this->form_all = 1;
     
        $this->dispatchBrowserEvent('formSubmit');
        
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
             
            // Validating user details

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
             
            if($this->isUserExists($this->email)) {
                $this->error = "Sorry! This email already taken.";
                $this->dispatchBrowserEvent('page:scroll-to', [
                    'query' => '#section-alert',
                ]);
                return false;
            }
            $this_single_path = "single_file".time()."_".$this->file_single->getClientOriginalName();
            $this->file_single->storeAs('files', $this_single_path);
            
            $this_multiple_path = [];
            if(!empty($this->file_multiple)) {
                foreach ($this->file_multiple as $file) {
                    $file_name = "file_multiple".time()."_".$file->getClientOriginalName();
                    $file->storeAs('files',$file_name);
                    $this_multiple_path[] = $file_name;
                }
            }
            //$this->message = $this->file_single->getClientOriginalName();

            $this_multiple_path = json_encode($this_multiple_path);
            
//$this->message = "#".$this->firstname."=".$this->salutation;

  //          return false;

			$data = User::create([
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
                'file_single' => $this_single_path,
                'file_single_name' => $this->file_single_name,
                'file_multiple' => $this_multiple_path,
                'file_multiple_name' => $this->file_multiple_name,
                'expiry_date' => $this->expiry_date,
                'expiry_before_date' => $this->expiry_before_date,
                'email' => $this->email,
                'password' => Hash::make($this->password),
				'created_at' => date("Y-m-d H:i:s"),
                'created_by' => 'self',
                'status' => 'A',
			]);
		
            DB::table('teams')->insert(
                array(
                    'user_id' => $data->id,
                    'name' => $this->firstname,
                    'personal_team' => 1,
                )
            );

            return redirect()->to('/login');

			//$this->resetForm();
			session()->flash('message', 'Registration successfully completed.');
                
			} catch (\Illuminate\Database\QueryException $e) {
				$this->error = $e->getMessage();
                //report($e);
                $this->dispatchBrowserEvent('page:scroll-to', [
                    'query' => '#section-alert',
                ]);
                return false;
			}
    }
   /**
     *  Check user already exists or not
     *
     * @return void
     */
    public function isUserExists($email)
    {
        if ($email!="") {
            $record = DB::table('users')
                ->where('email', '=', $email)
                ->get();
        }

        if(isset($record[0])) {
            return true;
        }else {
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
