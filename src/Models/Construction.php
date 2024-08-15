<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Construction extends Model {
    protected $fillable = ['title', 'progress', 'description', 'user_id'];
    protected $table = "constructions";
}