<?php

namespace App\Domain\Teams;

use App\App\Traits\ModelHasHashIds;
use App\Domain\Boards\Board;
use App\Domain\Users\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Team extends Model
{
    use SoftDeletes, ModelHasHashIds;

    protected $table = 'teams';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'description', 'private'];

    /**
     * Get the users the team belongs to
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * Get the boards owned by the team
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function boards()
    {
        return $this->morphMany(Board::class, 'owner');
    }
}
