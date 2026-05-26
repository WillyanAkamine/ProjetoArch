<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model {
    protected $fillable = ['description', 'progress', 'start_date', 'end_date', 'status', 'construction_id'];
    protected $table = "schedules";

    public function construction() {
        return $this->belongsTo(Construction::class, 'construction_id', 'id');
    }
}    