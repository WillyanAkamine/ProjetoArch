<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Construction extends Model {
    protected $fillable = ['description', 'titulo', 'user_id', 'pdf_id', 'created_at'];
    protected $table = "constructions";
    public $timestamps = false;

    public function pdfs()
    {
        return $this->belongsToMany(PDF::class, 'constructions_has_pdf', 'construction_id', 'pdf_id');
    }
}