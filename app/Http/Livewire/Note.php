<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\NoteModal;
use App\Models\Util;
class Note extends Component
{
    public $edit_id,$data, $title, $description, $createdDate,$error,$errors,$updatedDate;
    public $mode = "";
	public function index()
    {
		if(!Util::checkUserSession()) {
			//return redirect()->to('/login');
			$this->redirect('/login');
			//return view();
			
		}else {
			$this->render();
		}
        //$this->data = NoteModal::all();
        //return view('livewire.note');
    }
    public function render()
    {
		if(!Util::checkUserSession()) {
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
