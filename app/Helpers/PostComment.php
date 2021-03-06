<?php

namespace Pibbble\Helpers;

use Pibbble\User;
use Pibbble\Project;
use Pibbble\Comment;
use Pibbble\Http\Requests\CommentRequest;
use Pibbble\Pibbble\Repository\CommentRepository;

class PostComment
{
    private $comment;

    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }

    /**
     * Saves the project comment to the database.
     */
    public function saveProjectComment($id, User $user, CommentRequest $request)
    {
        $this->comment->comment = $request->comment;
        $this->comment->user_id = $user->id;
        $this->comment->project_id = $id;

        $this->comment->save();

        $project = Project::find($id);
        $project->comment_count += 1;
        $project->save();

        $commentId = Comment::where('comment', $request->comment)->first()->id;
        $commentRepo = new CommentRepository;

        return [
                'avatar' => $user->avatar,
                'username' => $user->username,
                'user_id' => $user->id,
                'project_id' => $id,
                'comment' => $request->comment,
                'comment_id' => $commentId,
                'commentTime' => $commentRepo->getCommentTime($commentId),
                'commentCount' => $project->comment_count,
        ];
    }
}
