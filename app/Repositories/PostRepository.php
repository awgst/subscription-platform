<?php

namespace App\Repositories;

use App\Contracts\WithSelect;
use App\Models\Post;
use App\Traits\WithSelect as TraitsWithSelect;
use Illuminate\Database\Eloquent\Model;

class PostRepository extends BaseRepository implements WithSelect
{
    use TraitsWithSelect;
    public function __construct(Post $post)
    {
        parent::__construct($post);
    }
}