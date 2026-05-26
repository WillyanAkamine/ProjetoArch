<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Construction extends Model {
    protected $fillable = ['title', 'progress', 'description','address', 'zipcode','neighborhood', 'city', 'state', 'user_id'];
    protected $table = "constructions";

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function budgets() {
        return $this->hasMany(Budget::class, 'construction_id', 'id');
    }

    public function schedules() {
        return $this->hasMany(Schedule::class, 'construction_id', 'id');
    }

    public function notes() {
        return $this->hasMany(Notes::class, 'construction_id', 'id');
    }

    public function costs() {
        return $this->hasMany(Cost::class, 'construction_id', 'id');
    }
}    