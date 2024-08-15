<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cost extends Model {
    protected $fillable = ['labor', 'equip', 'third', 'adm', 'construction_id'];
    protected $table = "costs";
}