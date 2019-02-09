<?php

namespace App\Repositories;

interface CriterionInterface
{
    public function apply($entity);
}