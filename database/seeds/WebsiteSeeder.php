<?php

use Illuminate\Database\Seeder;

class WebsiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $websites = [
            [
                "name"=>"Toukir's Portfolio",
                "url"=>"https://toukirportfolio.web.app/",
                "details"=>""
            ],
            [
                "name"=>"Inisev",
                "url"=>"https://inisev.com/",
                "details"=>""
            ]
        ];

        foreach ($websites as $website){
            \App\Website::create([
                "name"=>$website['name'],
                "url"=>$website['url'],
                "details"=>$website['details']
            ]);
        }
    }
}
