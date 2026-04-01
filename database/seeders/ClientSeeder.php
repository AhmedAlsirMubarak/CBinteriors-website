<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Client;

class ClientSeeder extends Seeder
{
    public function run(): void
    {
        $clients = [
            ['name' => 'Amare Cafe',               'sort_order' => 1],
            ['name' => 'Jabal Faris Al Dakhiliyah', 'sort_order' => 2],
            ['name' => 'MB Holding Company LLC',    'sort_order' => 3],
            ['name' => 'Kempinski Hotel Muscat',    'sort_order' => 4],
            ['name' => 'AAW Gas',                   'sort_order' => 5],
            ['name' => 'The Sustainable City',      'sort_order' => 6],
            ['name' => 'Alessandro International',  'sort_order' => 7],
            ['name' => 'Al Raid',                   'sort_order' => 8],
        ];

        foreach ($clients as $data) {
            Client::firstOrCreate(['name' => $data['name']], array_merge($data, ['active' => true]));
        }
    }
}
