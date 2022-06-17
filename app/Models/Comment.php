<?php

namespace App\Models;

use \Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

class Comment extends Model
{
    use HasFactory;

    protected static $unguarded = true;

    protected $dates = ['created_at'];

    protected $appends = ['formatted_created_at'];

    /**
     * Relationship
     * 
     * @return \Illuminate\Database\Eloquent\Relations\Relation
     */
    public function comment(): Relation
    {
        return $this->belongsTo(Comment::class);
    }

    /**
     * Relationship
     * 
     * @return \Illuminate\Database\Eloquent\Relations\Relation
     */
    public function comments(): Relation
    {
        return $this->hasMany(Comment::class)
            // Autoloading all nested comments. This would be disabled in a more complex application 
            // where you would only want to load a certain number of nested comments, 
            // and maybe have a 'show more' button.
            ->with('comments')
            ->orderBy('created_at');
    }

    /**
     * Scope
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeRootOnly($query)
    {
        return $query->doesntHave('comment');
    }


    /**
     * Accesor
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function formattedCreatedAt(): Attribute
    {

        return Attribute::make(
            get: fn () => $this->created_at->diffForHumans(),
        );
    }
}
