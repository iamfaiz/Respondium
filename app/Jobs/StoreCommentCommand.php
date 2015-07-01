<?php

namespace App\Jobs;

use App\Comment;
use App\Jobs\Job;
use Illuminate\Contracts\Bus\SelfHandling;

class StoreCommentCommand extends Job implements SelfHandling
{

    public $body;

    public $userId;

    public function __construct($body, $userId, $postId)
    {
        $this->body = $body;
        $this->userId = $userId;
        $this->postId = $postId;
    }

    /**
     * Store a new comment.
     *
     * @return void
     */
    public function handle()
    {
        $comment = new Comment();

        $comment->body = $this->body;

        $comment->user_id = $this->userId;

        $comment->post_id = $this->postId;

        $comment->save();

        // TODO: Raise an event.

        return $comment;
    }
}