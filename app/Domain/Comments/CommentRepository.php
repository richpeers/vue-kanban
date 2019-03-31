<?php

namespace App\Domain\Comments;

use App\App\Repositories\RepositoryAbstract;

class CommentRepository extends RepositoryAbstract
{
    /**
     * @return string
     */
    public function entity(): string
    {
        return Comment::class;
    }
}
