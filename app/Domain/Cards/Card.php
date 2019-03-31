<?php

namespace App\Domain\Cards;

use App\Domain\Boards\Board;
use App\Domain\Comments\Comment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
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
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['hashId'];

    /**
     * Get Hashed Id
     * @return mixed
     */
    public function getHashIdAttribute()
    {
        return app('hashids')->encode($this->id);
    }

    /**
     * Get the board the card belongs to
     *
     * @return BelongsTo
     */
    public function board(): BelongsTo
    {
        return $this->belongsTo(Board::class);
    }

    /**
     * Get the card comments
     *
     * @return HasMany
     */
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
}
