<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NoteModal extends Model
{
    use HasFactory;
	public $timestamps = false;
	protected $table = 'note';
    protected $fillable = ['title', 'description','createdDate','updatedDate'];
	

}
