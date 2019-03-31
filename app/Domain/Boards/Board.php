<?php

namespace App\Domain\Boards;

use App\Domain\Columns\Column;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Board extends Model
{
    use SoftDeletes;

    protected $table = 'boards';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'owner_type', 'owner_id', 'private'];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['hashId'];

    /**
     * Get Hashed Id
     *
     * @return string
     */
    public function getHashIdAttribute(): string
    {
        return app('hashids')->encode($this->id);
    }

    /**
     * Get the board owner (user or team)
     *
     * @return MorphTo
     */
    public function owner(): MorphTo
    {
        return $this->morphTo('owner');
    }

    /**
     * Get the board columns
     *
     * @return HasMany
     */
    public function columns(): HasMany
    {
        return $this->hasMany(Column::class);
    }
}
