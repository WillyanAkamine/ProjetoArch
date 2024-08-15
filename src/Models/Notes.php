<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notes extends Model {
    protected $fillable = ['description', 'value', 'construction_id', 'pdf_id'];
    protected $table = "notes";
}