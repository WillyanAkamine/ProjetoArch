<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PDF extends Model {
    protected $fillable = ['name', 'user_id'];
    protected $table = 'pdf';
    public $timestamps = false;

    public function constructions()
    {
        return $this->belongsToMany(Construction::class, 'constructions_has_pdf', 'pdf_id', 'construction_id');
    }
}