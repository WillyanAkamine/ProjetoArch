<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Budget extends Model {
    protected $fillable = ['title', 'description','value', 'status', 'pdf_id', 'construction_id'];
    protected $table = "budgets";
    public $timestamps = false;

    public function pdf(){
        return $this->hasOne(PDF::class, 'id', 'pdf_id');
    }

    public function construction() {
        return $this->belongsTo(Construction::class, 'construction_id', 'id');
    }
}