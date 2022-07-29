<?php

use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $clients = [
            [
                "name"=>"Toukir",
                "email"=>"toukir.dev@gmail.com",
                "client_key"=>"c_123"
            ],
            [
                "name"=>"Nick",
                "email"=>"rerop74703@galotv.com",
                "client_key"=>"c_124"
            ]
        ];

        foreach ($clients as $client){
            \App\Client::create([
                "name"=>$client['name'],
                "email"=>$client['email'],
                "client_key"=>$client['client_key']
            ]);
        }


    }
}
