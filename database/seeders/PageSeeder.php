<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Page;

class PageSeeder extends Seeder
{
    public function run(): void
    {
        $pages = [
            [
                'slug'             => 'home',
                'title'            => 'Crafting Spaces That Inspire',
                'subtitle'         => 'Luxury interior design for discerning clients in Oman and beyond.',
                'body'             => null,
                'meta_title'       => 'CB Interiors — Luxury Interior Design in Oman',
                'meta_description' => 'CB Interiors delivers bespoke interior design services across Oman. Explore our portfolio of refined residential and commercial spaces.',
                'sort_order'       => 1,
            ],
            [
                'slug'             => 'about',
                'title'            => 'About CB Interiors',
                'subtitle'         => 'A story of craft, passion, and refined taste.',
                'body'             => '<p>Founded with a belief that great design transforms lives, CB Interiors has been creating bespoke spaces across Oman since its inception. Our team of designers brings together architecture, art, and craftsmanship to deliver environments that are both beautiful and deeply personal.</p>',
                'meta_title'       => 'About Us — CB Interiors',
                'meta_description' => 'Learn about CB Interiors, our design philosophy, and the team behind Oman\'s most refined interior design studio.',
                'sort_order'       => 2,
                'meta'             => ['stat1_value'=>'10+','stat1_label'=>'Years of Excellence','stat2_value'=>'250+','stat2_label'=>'Satisfied Clients','stat3_value'=>'500+','stat3_label'=>'Projects Completed','stat4_value'=>'15+','stat4_label'=>'Design Awards'],
            ],
            [
                'slug'             => 'services',
                'title'            => 'Our Services',
                'subtitle'         => 'From concept to completion — every detail considered.',
                'body'             => null,
                'meta_title'       => 'Interior Design Services — CB Interiors',
                'meta_description' => 'Explore CB Interiors\' full range of services including residential design, commercial interiors, space planning, and furniture curation.',
                'sort_order'       => 3,
            ],
            [
                'slug'             => 'products',
                'title'            => 'Our Products',
                'subtitle'         => 'Curated furniture and décor for exceptional living.',
                'body'             => null,
                'meta_title'       => 'Furniture & Décor — CB Interiors',
                'meta_description' => 'Shop CB Interiors\' curated collection of luxury furniture, lighting, and accessories for the home.',
                'sort_order'       => 4,
            ],
            [
                'slug'             => 'contact',
                'title'            => 'Get in Touch',
                'subtitle'         => 'We would love to hear about your project.',
                'body'             => null,
                'meta_title'       => 'Contact Us — CB Interiors',
                'meta_description' => 'Contact CB Interiors to discuss your interior design project. Our studio is based in Muscat, Oman.',
                'sort_order'       => 5,
            ],
            [
                'slug'             => 'partners',
                'title'            => 'Our Partners',
                'subtitle'         => 'We are proud to have collaborated with leading brands and organisations across the region.',
                'body'             => null,
                'meta_title'       => 'Our Partners — CB Interiors',
                'meta_description' => 'Discover the brands and clients CB Interiors has partnered with across Oman and the region.',
                'sort_order'       => 8,
            ],
            [
                'slug'             => 'terms',
                'title'            => 'Terms & Conditions',
                'subtitle'         => null,
                'body'             => '<p>These terms and conditions govern your use of the CB Interiors website and services. By accessing or using our services you agree to be bound by these terms.</p><h2>Use of Services</h2><p>Our services are provided for personal and commercial interior design purposes. Unauthorised reproduction of our designs or content is prohibited.</p><h2>Intellectual Property</h2><p>All designs, concepts, drawings, and documentation produced by CB Interiors remain the intellectual property of the studio unless otherwise agreed in writing.</p>',
                'meta_title'       => 'Terms & Conditions — CB Interiors',
                'meta_description' => 'Read the terms and conditions governing the use of CB Interiors services and website.',
                'sort_order'       => 6,
            ],
            [
                'slug'             => 'privacy',
                'title'            => 'Privacy Policy',
                'subtitle'         => null,
                'body'             => '<p>CB Interiors is committed to protecting your personal information. This policy explains how we collect, use, and safeguard your data.</p><h2>Information We Collect</h2><p>We collect information you provide directly when you contact us or use our services, including your name, email address, and phone number.</p><h2>How We Use Your Information</h2><p>We use your information to respond to enquiries, provide our services, and improve our website. We do not sell your data to third parties.</p>',
                'meta_title'       => 'Privacy Policy — CB Interiors',
                'meta_description' => 'Learn how CB Interiors collects, uses, and protects your personal information.',
                'sort_order'       => 7,
            ],
        ];

        foreach ($pages as $data) {
            Page::updateOrCreate(['slug' => $data['slug']], $data);
        }
    }
}