<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notes extends Model {
    protected $fillable = ['description', 'value', 'construction_id', 'pdf_id'];
    protected $table = "notes";

    public function pdf() {
        return $this->belongsTo(PDF::class, 'pdf_id', 'id');
    }

    public function construction() {
        return $this->belongsTo(Construction::class, 'construction_id', 'id');
    }
}    