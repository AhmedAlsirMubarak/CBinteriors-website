<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            // General
            ['key' => 'site.name',        'value' => 'CB Interiors',               'group' => 'general', 'label' => 'Site Name',       'type' => 'text'],
            ['key' => 'site.tagline',      'value' => 'Crafting Spaces That Inspire','group' => 'general', 'label' => 'Tagline',          'type' => 'text'],
            ['key' => 'site.logo',         'value' => null,                          'group' => 'general', 'label' => 'Logo',             'type' => 'image'],
            ['key' => 'site.favicon',      'value' => null,                          'group' => 'general', 'label' => 'Favicon',          'type' => 'image'],

            // Contact
            ['key' => 'contact.email',    'value' => 'hello@cbinteriors.com',       'group' => 'contact', 'label' => 'Email Address',    'type' => 'text'],
            ['key' => 'contact.phone',    'value' => '+968 2400 0000',              'group' => 'contact', 'label' => 'Phone Number',     'type' => 'text'],
            ['key' => 'contact.address',  'value' => 'Muscat, Sultanate of Oman',   'group' => 'contact', 'label' => 'Address',          'type' => 'textarea'],
            ['key' => 'contact.maps_url', 'value' => null,                          'group' => 'contact', 'label' => 'Google Maps URL', 'type' => 'text'],

            // Social
            ['key' => 'social.instagram', 'value' => null, 'group' => 'social', 'label' => 'Instagram URL', 'type' => 'text'],
            ['key' => 'social.facebook',  'value' => null, 'group' => 'social', 'label' => 'Facebook URL',  'type' => 'text'],
            ['key' => 'social.twitter',   'value' => null, 'group' => 'social', 'label' => 'X / Twitter URL','type' => 'text'],
            ['key' => 'social.linkedin',  'value' => null, 'group' => 'social', 'label' => 'LinkedIn URL',  'type' => 'text'],
            ['key' => 'social.pinterest', 'value' => null, 'group' => 'social', 'label' => 'Pinterest URL', 'type' => 'text'],

            // SEO
            ['key' => 'seo.og_image',     'value' => null, 'group' => 'seo', 'label' => 'Default OG Image', 'type' => 'image'],
            ['key' => 'seo.google_analytics', 'value' => null, 'group' => 'seo', 'label' => 'Google Analytics ID', 'type' => 'text'],
        ];

        foreach ($settings as $data) {
            Setting::firstOrCreate(['key' => $data['key']], $data);
        }
    }
}