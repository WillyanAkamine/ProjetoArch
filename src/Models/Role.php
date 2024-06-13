<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model {
    protected $fillable = ['title', 'description', 'user_id'];
    protected $talbe = 'roles';
    public $timestamps = false;
}