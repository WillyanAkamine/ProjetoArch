<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Budget extends Model {
    protected $fillable = ['title', 'description', 'pdf_id', 'user_id'];
    protected $table = "budget";
    public $timestamps = false;

    public function pdf(){
        return $this->hasOne(PDF::class, 'id', 'pdf_id');
    }

    public function client() {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}