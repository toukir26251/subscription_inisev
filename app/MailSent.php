<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MailSent extends Model
{
    protected $fillable = ["website_id","for_post","status"];

    public function website(){
        return $this->belongsTo(Website::class,"website_id","id");
    }

    public function post(){
        return $this->belongsTo(Post::class,"for_post","id");
    }
}
