<?php

namespace App\Console\Commands;

use App\Jobs\SendSubscriptionEmail;
use App\Models\Post;
use App\Models\PostSendLog;
use Illuminate\Console\Command;

class SendSubscriptionEmails extends Command
{
    protected $signature = 'subscriptions:send-emails';
    protected $description = 'Send new posts to subscribers via email';

    public function handle()
    {
        // Get posts that haven't been sent to all subscribers
        $posts = Post::whereDoesntHave('sendLogs', function ($query) {
                $query->whereRaw('posts.website_id = post_send_logs.subscription->website_id');
            })
            ->with('website.subscriptions')
            ->get();

        foreach ($posts as $post) {
            $post->website->subscriptions->each(function ($subscription) use ($post) {
                // Check if email already sent
                $alreadySent = PostSendLog::where('post_id', $post->id)
                    ->where('subscription_id', $subscription->id)
                    ->exists();
                    
                if (!$alreadySent) {
                    SendSubscriptionEmail::dispatch($post, $subscription);
                }
            });
        }

        $this->info('Scheduled ' . $posts->count() . ' posts for email delivery');
    }
}