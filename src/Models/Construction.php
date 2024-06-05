<?php 


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Construction extends Model {
    protected $fillable = ['description'];
    protected $table = "constructions";
}