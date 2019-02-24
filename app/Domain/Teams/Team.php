<?php

namespace App\Domain\Teams;

use App\Domain\Boards\Board;
use App\Domain\Users\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Vinkla\Hashids\Facades\Hashids;

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
     * @return mixed
     */
    public function getHashIdAttribute()
    {
        return Hashids::encode($this->id);
    }

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
