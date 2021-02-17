<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\NoteModal;
use App\Models\Util;
use Auth;
class Note extends Component
{
    public $edit_id,$data, $title, $description, $createdDate,$error,$errors,$updatedDate,$notify_modal=0,$notify_content,$test;
    public $mode = "",$tt;
	
	public function index()
    {
		//if(!Util::checkUserSession()) {
		if(!Auth::check()) {   	
			return redirect()->to('/login');
		}
		$this->data = NoteModal::all();
	
        return view('note');

    }
	
    public function render()
    {
		//if(!Util::checkUserSession()) {
		if(!Auth::check()) {   	
			//return redirect()->to('/login');
			$this->redirect('/login');
			//return view();
			
		}
        $this->data = NoteModal::all();
        return view('livewire.note');
    }
	
    public function createNote()
    {
		if($this->mode=="edit") {
			$this->update();
			return false;
		}
		 try {
			$this->validate([
				'title' => 'required|min:2',
				'description' => 'required'
			]);
			NoteModal::create([
				'title' => $this->title,
				'description' => $this->description,
				'createdDate' => date("Y-m-d H:i:s")
			]);
		
			$this->resetForm();
			$this->data = NoteModal::all();
			
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
		//$this->test = date("s");
		
		//session()->flash('notify_content', 'Post successfully updated.');
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
			//	session()->flash('message', 'Note successfully updated.');
				
				$this->notify_modal = 1;
				$this->notify_content = 'Content updated successfully!';
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
		$this->notify_modal = 0;
		$this->notify_content = '';
		$this->resetErrorBag();
		$this->resetValidation();
    }
	public function closeModal() {

	 	$this->notify_modal = 0;
		$this->notify_content = '';

	}
}
