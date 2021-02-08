<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Util;

class Register extends Component
{
	public $edit_id,$data, $name, $email, $password,$role_id,$errors,$updatedDate,$createdDate;
    public $mode = "";
	
    public function render()
    {
		if(!Util::checkUserSession()) {
			$this->redirect('/login');
		}
        $this->data = User::all();
        return view('livewire.register');
    }
	 public function register()
    {
		if($this->mode=="edit") {
			$this->update();
			return false;
		}
		 try {
			$this->validate([
				'name' => 'required|min:2',
				'email' => 'required',
				'password' => 'required',
				'confirm_password' => 'required',
				'role_id' => 'required'
			]);
			
			User::create([
				'name' => $this->name,
				'email' => $this->email,
				'password' => $this->password,
				'createdDate' => date("Y-m-d H:i:s"),
				'createdBy' => session('name'),
			]);
		
			$this->resetForm();
			$this->data = User::all();
			
			} catch (Throwable $e) {
				$this->error = $e->getMessage();
			}
    }
    public function edit($id)
    {
        $record = NoteModal::findOrFail($id);
        $this->edit_id = $id;
        $this->title = $record->title;
        $this->description = $record->description;
        $this->mode = 'edit';
    }
    public function update()
    {
		try{
			$this->validate([
				'edit_id' => 'required|numeric',
				'title' => 'required|min:5',
				'description' => 'required'
			]);
			if ($this->edit_id) {
				$record = NoteModal::find($this->edit_id);
				$record->update([
					'title' => $this->title,
					'description' => $this->description,
					'updatedDate' => date("Y-m-d H:i:s")
				]);
				$this->resetForm();
				$this->mode = "";
				session()->flash('message', 'Note successfully updated.');
				$this->data = NoteModal::all();
			
				
			}
		
		} catch (Throwable $e) {
			$this->error = $e->getMessage();
		}	
		
    }
    public function destroy($id)
    {
        if ($id) {
            $record = NoteModal::where('id', $id);
            $record->delete();
			$this->data = NoteModal::all();
        }
    }
	public function resetForm()
    {
        $this->title = null;
        $this->description = null;
		$this->mode = '';
		$this->error="";
		$this->errors=null;
		$this->resetErrorBag();
		$this->resetValidation();
    }
}
