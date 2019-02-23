<?php

namespace App\App\Repositories;

interface RepositoryInterface
{
    public function all();

    public function find($id);

    public function findByHashId($hashId);

    public function findWhere($column, $value);

    public function findWhereFirst($column, $value);

    public function paginate($perPage = 10);

    public function create(array $properties);

    public function update($id, array $properties);

    public function delete($id);
}