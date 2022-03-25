<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Website extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'websites_users', 'website_id', 'user_id');
    }

    public function posts()
    {
        return $this->hasMany(Post::class, 'website_id', 'id');
    }
}
