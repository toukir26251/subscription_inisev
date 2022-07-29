<?php

namespace App\Http\Controllers;

use App\MailSent;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class PostController extends Controller
{
    public function store(Request $request){
        $validated = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'website_id' => 'required',
        ]);

        // adding new post in the db
        $newPost = Post::create([
            "website_id"=>$request->website_id,
            "post_name"=>$request->name,
            "post_description"=>$request->description
        ]);

        // adding new mail sending details in db so that command can execute the rest.
        MailSent::create([
            "website_id"=>$request->website_id,
            "for_post"=>$newPost->id,
            "status"=>"not_sent"
        ]);

        // this command will send mails to the subscribers fo the website.
        Artisan::call('send:emails');

        return response()->json(["success"=>true,"date"=>$newPost],200);
    }
}
