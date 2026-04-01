<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\Contact;
use App\Models\Page;
use App\Models\Service;
use App\Models\Setting;

class ViewServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        // Share global site settings with every view
        View::composer('*', function ($view) {
            $view->with('siteSettings', [
                'name'      => Setting::get('site.name', 'CB Interiors'),
                'tagline'   => Setting::get('site.tagline', 'Crafting Spaces That Inspire'),
                'logo'      => Setting::get('site.logo'),
                'email'        => Setting::get('contact.email'),
                'phone'        => Setting::get('contact.phone'),
                'phone_label'  => Setting::get('contact.phone_label', 'Yonelle'),
                'phone2'       => Setting::get('contact.phone2'),
                'phone2_label' => Setting::get('contact.phone2_label', 'Karima'),
                'address'      => Setting::get('contact.address'),
                'instagram' => Setting::get('social.instagram'),
                'facebook'  => Setting::get('social.facebook'),
                'twitter'   => Setting::get('social.twitter'),
                'linkedin'  => Setting::get('social.linkedin'),
                'pinterest' => Setting::get('social.pinterest'),
            ]);
        });

        // Share footer services and legal pages with every public view
        View::composer(['layouts.app', 'footer'], function ($view) {
            try {
                $view->with('footerServices', Service::active()->ordered()->take(5)->get());
            } catch (\Exception) {
                $view->with('footerServices', collect());
            }
            try {
                $view->with('legalPages', Page::whereIn('slug', ['terms', 'privacy'])->where('active', true)->get(['slug', 'title'])->keyBy('slug'));
            } catch (\Exception) {
                $view->with('legalPages', collect());
            }
        });

        // Share unread inquiry count with all admin views
        View::composer('admin.*', function ($view) {
            try {
                $view->with('unreadInquiries', Contact::unread()->count());
            } catch (\Exception) {
                $view->with('unreadInquiries', 0);
            }
        });
    }
}