<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class HomeSettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            // Hero
            ['key' => 'home.studio_label',        'value' => 'Interior Design Studio · Muscat, Oman', 'group' => 'home', 'label' => 'Studio Label (hero)',          'type' => 'text'],

            // Counters
            ['key' => 'home.stat1_num',            'value' => '10',                  'group' => 'home', 'label' => 'Stat 1 — Number',            'type' => 'text'],
            ['key' => 'home.stat1_suffix',         'value' => '+',                   'group' => 'home', 'label' => 'Stat 1 — Suffix',            'type' => 'text'],
            ['key' => 'home.stat1_label',          'value' => 'Design Awards',       'group' => 'home', 'label' => 'Stat 1 — Label',             'type' => 'text'],
            ['key' => 'home.stat2_num',            'value' => '250',                 'group' => 'home', 'label' => 'Stat 2 — Number',            'type' => 'text'],
            ['key' => 'home.stat2_suffix',         'value' => '+',                   'group' => 'home', 'label' => 'Stat 2 — Suffix',            'type' => 'text'],
            ['key' => 'home.stat2_label',          'value' => 'Satisfied Clients',   'group' => 'home', 'label' => 'Stat 2 — Label',             'type' => 'text'],
            ['key' => 'home.stat3_num',            'value' => '500',                 'group' => 'home', 'label' => 'Stat 3 — Number',            'type' => 'text'],
            ['key' => 'home.stat3_suffix',         'value' => '+',                   'group' => 'home', 'label' => 'Stat 3 — Suffix',            'type' => 'text'],
            ['key' => 'home.stat3_label',          'value' => 'Projects Completed',  'group' => 'home', 'label' => 'Stat 3 — Label',             'type' => 'text'],
            ['key' => 'home.stat4_num',            'value' => '15',                  'group' => 'home', 'label' => 'Stat 4 — Number',            'type' => 'text'],
            ['key' => 'home.stat4_suffix',         'value' => '+',                   'group' => 'home', 'label' => 'Stat 4 — Suffix',            'type' => 'text'],
            ['key' => 'home.stat4_label',          'value' => 'Unique Concepts',     'group' => 'home', 'label' => 'Stat 4 — Label',             'type' => 'text'],

            // About section
            ['key' => 'home.bento_years',          'value' => '10+',                 'group' => 'home', 'label' => 'About — Years Badge',         'type' => 'text'],
            ['key' => 'home.about_heading',        'value' => 'Where Design',        'group' => 'home', 'label' => 'About — Heading (line 1)',    'type' => 'text'],
            ['key' => 'home.about_heading_em',     'value' => 'Meets Comfort',       'group' => 'home', 'label' => 'About — Heading (italic)',    'type' => 'text'],
            ['key' => 'home.about_body1',          'value' => 'CB Interiors is a testament to bespoke craftsmanship, where every project tells a story of innovation and elegance. Our passion lies in curating timeless interior designs that resonate with discerning tastes.', 'group' => 'home', 'label' => 'About — Paragraph 1', 'type' => 'textarea'],
            ['key' => 'home.about_body2',          'value' => 'With meticulous attention to detail, we craft spaces that transform homes into personalised sanctuaries of comfort and style.', 'group' => 'home', 'label' => 'About — Paragraph 2', 'type' => 'textarea'],

            // Marquee
            ['key' => 'home.marquee_items',        'value' => 'Residential Design,Commercial Interiors,Space Planning,Furniture Curation,Project Management,Bespoke Luxury,Muscat · Oman', 'group' => 'home', 'label' => 'Marquee Items (comma-separated)', 'type' => 'textarea'],

            // Section headings
            ['key' => 'home.services_heading',     'value' => "This Is What We're Best At", 'group' => 'home', 'label' => 'Services — Section Heading', 'type' => 'text'],
            ['key' => 'home.work_heading',         'value' => 'More of Our Work',     'group' => 'home', 'label' => 'Work — Section Heading',      'type' => 'text'],

            // Testimonial
            ['key' => 'home.testimonial_quote',    'value' => 'Working with CB Interiors was a revelation. They transformed our home into a sanctuary we never want to leave.', 'group' => 'home', 'label' => 'Testimonial — Quote',    'type' => 'textarea'],
            ['key' => 'home.testimonial_author',   'value' => 'A. Al-Rashid',         'group' => 'home', 'label' => 'Testimonial — Author Name',  'type' => 'text'],
            ['key' => 'home.testimonial_project',  'value' => 'Muscat Villa Project',  'group' => 'home', 'label' => 'Testimonial — Project',      'type' => 'text'],
            ['key' => 'home.testimonial_initials', 'value' => 'AR',                    'group' => 'home', 'label' => 'Testimonial — Initials',     'type' => 'text'],

            // FAQs
            ['key' => 'home.faq1_q', 'value' => 'Where are you located?',              'group' => 'home', 'label' => 'FAQ 1 — Question', 'type' => 'text'],
            ['key' => 'home.faq1_a', 'value' => 'Our studio is based in Muscat, Sultanate of Oman. We serve clients across Oman and take on select projects regionally.', 'group' => 'home', 'label' => 'FAQ 1 — Answer', 'type' => 'textarea'],
            ['key' => 'home.faq2_q', 'value' => 'Do you offer bespoke interior design?', 'group' => 'home', 'label' => 'FAQ 2 — Question', 'type' => 'text'],
            ['key' => 'home.faq2_a', 'value' => 'Yes — every project we undertake is custom. We do not work from pre-packaged templates. Our designs are created specifically for your space, lifestyle, and taste.', 'group' => 'home', 'label' => 'FAQ 2 — Answer', 'type' => 'textarea'],
            ['key' => 'home.faq3_q', 'value' => 'How long does a typical project take?', 'group' => 'home', 'label' => 'FAQ 3 — Question', 'type' => 'text'],
            ['key' => 'home.faq3_a', 'value' => 'Timelines vary by scope. A single-room project typically takes 6-10 weeks from consultation to completion. Full villa or commercial projects are scoped individually.', 'group' => 'home', 'label' => 'FAQ 3 — Answer', 'type' => 'textarea'],
            ['key' => 'home.faq4_q', 'value' => 'What is your design philosophy?',     'group' => 'home', 'label' => 'FAQ 4 — Question', 'type' => 'text'],
            ['key' => 'home.faq4_a', 'value' => 'We believe great design is timeless, not trendy. Every decision — from space planning to material selection — is made to serve both beauty and the way you actually live.', 'group' => 'home', 'label' => 'FAQ 4 — Answer', 'type' => 'textarea'],
            ['key' => 'home.faq5_q', 'value' => 'How do I get started?',               'group' => 'home', 'label' => 'FAQ 5 — Question', 'type' => 'text'],
            ['key' => 'home.faq5_a', 'value' => 'Simply fill in our contact form or call us. We will arrange a no-obligation consultation at your convenience.', 'group' => 'home', 'label' => 'FAQ 5 — Answer', 'type' => 'textarea'],

            // CTA
            ['key' => 'home.cta_heading',          'value' => "Let's Create",          'group' => 'home', 'label' => 'CTA — Heading',        'type' => 'text'],
            ['key' => 'home.cta_heading_em',       'value' => 'Something Beautiful',   'group' => 'home', 'label' => 'CTA — Heading (italic)', 'type' => 'text'],
        ];

        foreach ($settings as $data) {
            Setting::firstOrCreate(['key' => $data['key']], $data);
        }
    }
}
