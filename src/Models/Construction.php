<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Construction extends Model {
    protected $fillable = ['description', 'user_id'];
    protected $table = "constructions";
}