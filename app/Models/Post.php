<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Scopes\LatestScope;
use Illuminate\Support\Facades\Cache;

class Post extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $fillable = ['title', 'content', 'user_id'];

    public function comments(){
        return $this->hasMany('App\Models\Comment');
    }

    public function user(){
        return $this->belongsTo(User::class);
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
}
