<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Author;

class Profile extends Model
{
    public function author(){
        return $this->belongsTo('Author');
    }
}
