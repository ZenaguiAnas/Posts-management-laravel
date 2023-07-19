<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Scopes\LatestScope;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Cache;

class Post extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $fillable = ['title', 'content', 'slug', 'active', 'user_id'];

    public function comments(){
        return $this->morphMany('App\Models\Comment', 'commentable');
    }

    // public function image(){
    //     return $this->hasOne(Image::class);
    // }
    
    public function image(){
        return $this->morphOne('App\Models\Image', 'imageable');
    }

    public function user(){
        return $this->belongsTo(User::class);
    } 

    // public function scopeMostCommented(Builder $query){
    //     return $query->withCount('comments')->orderBy('comments_count'); 
    // }

    public function scopePostWithUserCommentsTags(Builder $query) {
        return $query->withCount('comments')->with(['user', 'tags']);
    }

    public static function boot(){
        parent::boot();

        static::addGlobalScope(new LatestScope);

        static::deleting(function(Post $post){
            $post->comments()->delete();
        });

        static::restoring(function(Post $post){
            $post->comments()->restore();
    });

        static::updating(function(Post $post){
            Cache::forget("post-show-{$post->id}");
        });
    }

    public function tags(){
        return $this->belongsToMany('App\Models\Tag')->withTimestamps();
    }
}
