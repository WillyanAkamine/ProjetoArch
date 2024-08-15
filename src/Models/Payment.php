<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notes extends Model {
    protected $fillable = ['description', 'progress', 'status', 'note_id'];
    protected $table = "payments";
}