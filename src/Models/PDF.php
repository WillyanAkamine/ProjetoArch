<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PDF extends Model {
    protected $fillable = ['name', 'user_id', 'category'];
    protected $table = 'pdfs';
    public $timestamps = false;

    public function construction() {
        return $this->belongsTo(Construction::class, 'user_id', 'user_id');
    }
}    