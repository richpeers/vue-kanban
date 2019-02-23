<?php

namespace App\Domain\Boards;

use App\App\Traits\ModelHasHashIds;
use App\Domain\Columns\Column;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Board extends Model
{
    use SoftDeletes, ModelHasHashIds;

    protected $table = 'boards';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'owner_type', 'owner_id'];

    /**
     * Get the board owner (user or team)
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function owner()
    {
        return $this->morphTo('owner');
    }

    /**
     * Get the board columns
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function columns()
    {
        return $this->hasMany(Column::class);
    }
}
