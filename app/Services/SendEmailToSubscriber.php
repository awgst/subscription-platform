<?php

namespace App\Services;

use Illuminate\Support\Facades\Artisan;

class SendEmailToSubscriber
{
    private $post;
    public function __construct($post)
    {
        $this->post = $post;
    }

    public function send()
    {
        $post = $this->post;
        Artisan::call('send:email-subscriber', ['websiteId' => $post->website_id, 'postId' => $post->id]);
    }
}