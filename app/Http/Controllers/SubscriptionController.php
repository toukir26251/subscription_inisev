<?php

namespace App\Http\Controllers;

use App\Client;
use App\Subscription;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function store(Request $request){
        $validated = $request->validate([
            'client_id' => 'required',
            'website_id' => 'required',
            'client_key' => 'required', // individual key is stored in the table for individual client. this key must come form front end. this is the tiny validation.
        ]);

        // validatiting clients with the client_key. it must be same as the client record in client table.
        $client = Client::where(['id'=>$request->client_id,"client_key"=>$request->client_key])->first();

        if($client){
            $newSubs = Subscription::create([
                "client_id"=>$request->client_id,
                "website_id"=>$request->website_id
            ]);

            return response()->json(["success"=>true,"data"=>$newSubs],200);
        }
        else{
            return response()->json(["success"=>false,"message"=>"Client not found"],404);
        }
    }
}
