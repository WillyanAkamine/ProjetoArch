<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model {
    protected $fillable = ['name', 'email', 'password', 'role_id'];
    protected $table = "users";
    public $timestamps = false;

    public function role(){
        return $this->hasMany(Role::class, 'id', 'role_id');
    }
}

