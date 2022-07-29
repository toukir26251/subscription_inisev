<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Website extends Model
{
    protected $fillable = ["name","url","details"];

    public function subscriber(){
        return $this->hasMany(Subscription::class,"website_id","id");
    }
}
