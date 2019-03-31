<?php

namespace App\App\Repositories\Criteria;

class ByUser
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
        return $entity->where('user_id', $this->userId);
    }
}
