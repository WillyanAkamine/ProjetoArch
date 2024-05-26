<?php 

namespace App\Models;
use Illuminate\Database\Eloquent\Model;


class Cost extends Model {
    protected $fillable = ['labor', 'equip', 'third', 'adm', 'date'];
    protected $table = "costs";
}