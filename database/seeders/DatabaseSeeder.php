<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;        
use App\Models\User;    
use App\Models\Page;
use App\Models\Category;
use App\Models\Service;
use App\Models\Setting;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            PageSeeder::class,
            CategorySeeder::class,
            ServiceSeeder::class,
            SettingSeeder::class,
        ]);
    }
}