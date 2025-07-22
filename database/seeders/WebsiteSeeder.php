<?php

namespace Database\Seeders;

use App\Models\Website;
use Illuminate\Database\Seeder;

class WebsiteSeeder extends Seeder
{
    public function run()
    {
        $websites = [
            ['name' => 'Increasing Happiness', 'url' => 'https://increasinghappiness.org/'],
            ['name' => 'Follow IT', 'url' => 'https://follow.it/'],
            ['name' => 'My Popups', 'url' => 'https://mypopups.com/'],
            ['name' => 'Inisev', 'url' => 'https://inisev.com/']
        ];

        foreach ($websites as $website) {
            Website::create($website);
        }
    }
}
