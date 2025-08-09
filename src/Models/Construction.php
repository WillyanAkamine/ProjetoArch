<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Construction extends Model {
    protected $fillable = ['title', 'progress', 'description','address', 'zipcode','neighborhood', 'city', 'state', 'user_id'];
    protected $table = "constructions";

    public function user() {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function budgets() {
        return $this->hasMany(Budget::class, 'construction_id', 'id');
    }
}