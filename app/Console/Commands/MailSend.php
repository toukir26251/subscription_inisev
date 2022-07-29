<?php

namespace App\Console\Commands;

use App\MailSent;
use Illuminate\Bus\Queueable;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class MailSend extends Command
{
    use Queueable;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:emails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Emails are being sent to the subscribers.';

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
        // when comman will run the mails will be sent
        $webs = MailSent::with('website.subscriber.client','post')->where("status","not_sent")->get();
        $emails = [];
        $posts = [];
        $ids = [];
        foreach ($webs as $web){
            $ids[]=$web->id;
            foreach ($web->website->subscriber as $subs){
                $emails[$web->post->id][] = $subs->client->email;
            }
            $posts[$web->post->id] = ["postName"=>$web->post->post_name,"description"=>$web->post->post_description];
        }

        foreach ($posts as $key=>$post){
            Mail::send('emails.mail', $post, function($message) use ($emails,$key)
            {
                $message->to($emails[$key])->subject('New Post Notification');
            });
        }
        MailSent::whereIn("id",$ids)->update(["status"=>"sent"]);

        return 0;
    }
}
