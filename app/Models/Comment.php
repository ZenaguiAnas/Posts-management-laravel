<?php

namespace App\Models;

use App\Scopes\LatestScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;

class Comment extends Model
{

    use HasFactory;

    use SoftDeletes;

    protected $fillable = ['content', 'user_id'];

    public function post(){
        return $this->belongsTo('App\Models\Post');
    }

    public function user(){
        return $this->belongsTo('App\Models\User');
    }


    public function commentable(){
        return $this->morphTo();
    }

    public static function boot(){
        parent::boot();

        static::updating(function(Comment $comment){
            // Cache::forget("post-show-{$comment->post->id}");
            Cache::forget("post-show-{$comment->commentable->id}");
        });

        static::addGlobalScope(new LatestScope);
    }
}
