<?php

namespace App\Domain\Comments\Repositories\Eloquent;

use App\App\Repositories\Eloquent\RepositoryAbstract;
use App\Domain\Comments\Repositories\CommentRepository as CommentRepositoryInterface;
use App\Domain\Comments\Comment;

class CommentRepository extends RepositoryAbstract implements CommentRepositoryInterface
{
    /**
     * @return string
     */
    public function entity(): string
    {
        return Comment::class;
    }
}