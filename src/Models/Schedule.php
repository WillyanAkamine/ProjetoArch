<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Construction extends Model {
    protected $fillable = ['description', 'progress', 'start_date', 'end_date', 'status', 'construction_id'];
    protected $table = "schedules";
}