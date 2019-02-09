<?php

namespace App\Repositories;

interface CriteriaInterface
{
    public function withCriteria(...$criteria);
}