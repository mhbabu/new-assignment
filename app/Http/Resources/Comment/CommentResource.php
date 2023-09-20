<?php

namespace App\Http\Resources\Comment;

use App\Http\Resources\Blog\BlogResource;
use App\Http\Resources\User\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    { //'blog_id', 'user_id', 'comment', 'created_by', 'updated_by'
        return [
            'id'         => $this->id,
            'comment'    => $this->comment,
            'created_at' => $this->updated_at,
            'updated_at' => $this->updated_at,
            'user'       => new UserResource($this->user),
            'post'       => [
                'id'      => $this->blog->id,
                'slug'    => $this->blog->slug,
                'title'   => $this->blog->title,
                'details' => $this->blog->details
            ]
        ];
    }
}
