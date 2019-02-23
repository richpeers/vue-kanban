<?php

namespace App\Domain\Cards;

use App\Domain\Boards\Board;
use App\Domain\Comments\Comment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Card extends Model
{
    use SoftDeletes;

    protected $table = 'cards';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['column_id', 'order', 'title', 'description', 'due'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    public $dates = ['created_at', 'updated_at', 'due'];

    /**
     * Get the board the card belongs to
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function board()
    {
        return $this->belongsTo(Board::class);
    }

    /**
     * Get the card comments
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
