<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Models\Util;
use Auth;
use Hash;
use DB;
class Userprofile extends Component
{
    public $data,$message,$error;
    public $salutation_id, $firstname="test", $lastname="ll", $gender_id="1",$phone="34343",$mobile="232323";
    public $company_address,$primary_address="dfsdf",$secondary_address="Sdfsdf",$dob="1980-01-02",$assumed_date="2000-10-02",$occupation_id="1",$company_name="DIG",$industry_id="1",$sub_industry_id="1",$skill="fsd",$rate="3",$family_firstname="dfsdf",$family_lastname,$family_gender_id="1",$family_email="sdfsd@sdfasd.com",$family_phone="23423",$family_relation_id="father",$family_color_indicator,$expiry_date="1980-02-03",$expiry_before_date, $email="test@test.com", $password="password",$role_id,$updated_at,$created_at;
    public $file_single,$file_multiple=[],$master_sub_industry=[],$file_single_name,$file_multiple_name;
    public $mode = "";

    public function render()
    {
        return view('livewire.userprofile');
    }
}
