<?php

namespace App\Models;

use App\Scopes\LatestScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{

    use HasFactory;

    use SoftDeletes;

    protected $fillable = ['content', 'post_id', 'user_id'];

    public function post(){
        return $this->belongsTo('App\Models\Post');
    }

    public function user(){
        return $this->belongsTo('App\Models\User');
    }


    public static function boot(){
        parent::boot();

        static::addGlobalScope(new LatestScope);
    }
}
