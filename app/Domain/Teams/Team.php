<?php

namespace App\Domain\Teams;

use App\Domain\Boards\Board;
use App\Domain\Users\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Team extends Model
{
    use SoftDeletes;

    protected $table = 'teams';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'description', 'private'];

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
     * Get the users the team belongs to
     *
     * @return BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * Get the boards owned by the team
     *
     * @return MorphMany
     */
    public function boards(): MorphMany
    {
        return $this->morphMany(Board::class, 'owner');
    }
}
