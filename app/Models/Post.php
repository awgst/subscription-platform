<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public $incrementing = true;

    public function website()
    {
        return $this->belongsTo(Website::class, 'website_id');
    }

    // I had a problem while get $model :(
    // protected static function boot()
    // {
    //     self::creating(function($model) {
    //         Artisan::call('send:email-subscriber', ['websiteId' => $model->website_id, 'postId' => $model->id]);
    //     });

    //     parent::boot();
    // }
}
