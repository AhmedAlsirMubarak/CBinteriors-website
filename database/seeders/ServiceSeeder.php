<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            [
                'title'       => 'Residential Design',
                'slug'        => 'residential-design',
                'short_desc'  => 'Bespoke interiors for the modern home.',
                'description' => '<p>We transform living spaces into personal sanctuaries. From initial concept through to final styling, our residential design service covers every detail of your home.</p>',
                'is_featured' => true,
                'sort_order'  => 1,
            ],
            [
                'title'       => 'Commercial Interiors',
                'slug'        => 'commercial-interiors',
                'short_desc'  => 'Workspaces and hospitality that leave an impression.',
                'description' => '<p>Great commercial design drives performance. We create offices, hotels, restaurants, and retail environments that reflect your brand and inspire your team.</p>',
                'is_featured' => true,
                'sort_order'  => 2,
            ],
            [
                'title'       => 'Space Planning',
                'slug'        => 'space-planning',
                'short_desc'  => 'Maximising flow, function, and beauty.',
                'description' => '<p>Before a single piece of furniture is placed, we study how you live and move. Our space planning service ensures every square metre serves a purpose.</p>',
                'is_featured' => true,
                'sort_order'  => 3,
            ],
            [
                'title'       => 'Furniture Curation',
                'slug'        => 'furniture-curation',
                'short_desc'  => 'Sourcing extraordinary pieces from around the world.',
                'description' => '<p>We have access to an exclusive network of international furniture makers and artisans. Let us curate a collection that is entirely unique to your space.</p>',
                'is_featured' => false,
                'sort_order'  => 4,
            ],
            [
                'title'       => 'Project Management',
                'slug'        => 'project-management',
                'short_desc'  => 'Seamless delivery from first sketch to final reveal.',
                'description' => '<p>We manage every contractor, supplier, and timeline so you do not have to. Our project management service ensures your interior is delivered on budget and on time.</p>',
                'is_featured' => false,
                'sort_order'  => 5,
            ],
        ];

        foreach ($services as $data) {
            Service::updateOrCreate(
                ['slug' => $data['slug']],
                array_merge($data, ['active' => true])
            );
        }
    }
}