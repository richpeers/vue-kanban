<?php

namespace App\Domain\Columns;

use App\Domain\Boards\Board;
use App\Domain\Cards\Card;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Column extends Model
{
    use SoftDeletes;

    protected $table = 'columns';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['order', 'title', 'board_id'];

    /**
     * Get the board the column belongs to
     *
     * @return BelongsTo
     */
    public function board(): BelongsTo
    {
        return $this->belongsTo(Board::class);
    }

    /**
     * Get the column's cards
     *
     * @return HasMany
     */
    public function cards(): HasMany
    {
        return $this->hasMany(Card::class);
    }
}
