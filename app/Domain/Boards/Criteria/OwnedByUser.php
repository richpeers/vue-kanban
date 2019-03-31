<?php

namespace App\Domain\Boards\Criteria;

use App\Domain\Users\User;

class OwnedByUser
{
    /**
     * @var $userId
     */
    protected $userId;

    /**
     * EagerLoad constructor.
     * @param $userId
     */
    public function __construct($userId)
    {
        $this->userId = $userId;
    }

    /**
     * @param $entity
     * @return mixed
     */
    public function apply($entity)
    {
        return $entity->where('owner_id', $this->userId)->where('owner_type', User::class);
    }
}
