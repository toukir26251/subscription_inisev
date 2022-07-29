<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $fillable = ["website_id","client_id","status"];

    public function client(){
        return $this->belongsTo(Client::class,"client_id","id");
    }
}
