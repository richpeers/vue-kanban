<?php

namespace App\App\Traits;

use Vinkla\Hashids\Facades\Hashids;

trait ModelHasHashIds
{
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
}