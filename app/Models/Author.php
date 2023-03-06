<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Profile;


class Author extends Model
{
    public function profile(){
        return $this->hasOne('Profile');
    }
}
