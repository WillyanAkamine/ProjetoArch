<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model {
    protected $fillable = ['name', 'email', 'password', 'cpf', 'rg', 'phone', 'city', 'state', 'address', 'neighborhood', 'role_id'];
    protected $table = "users";
}

