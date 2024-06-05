<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PDF extends Model {
    protected $fillable = ['name', 'description'];
    protected $table = 'pdf';
}