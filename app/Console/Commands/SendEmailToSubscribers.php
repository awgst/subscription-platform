<?php

namespace App\Console\Commands;

use App\Jobs\SendingEmailJob;
use App\Models\Post;
use App\Models\Website;
use Illuminate\Console\Command;

class SendEmailToSubscribers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:email-subscriber {websiteId}{postId}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command for sending email new post to subscribers.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $websiteId = $this->arguments('websiteId')['websiteId'];
        $postId = $this->arguments('postId')['postId'];
        $website = Website::with(['subscribers'])->find($websiteId);
        $post = Post::select(['title', 'description'])->find($postId)->toArray();
        $subscribers = $website->subscribers;
        foreach ($subscribers ?? [] as $subscriber) {
            if ($subscriber->email) {
                SendingEmailJob::dispatch($subscriber->email, $post)->onQueue('sendEmail');
            }
        }
    }
}
