<?php

namespace Database\Seeders;

use App\Models\Page;
use App\Models\PageLanguage;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $page = Page::create([
            'id'         => 100,
            'title'      => 'Privacy Policy',
            'content'    => 'Your privacy is important to us. It is our policy to respect your privacy regarding any information we may collect from you across our website, and other sites we own and operate.',
            'type'       => 'error_page_404',
            'link'       => '#',
            'meta_title' => 'Meta Title',
            'status'     => '1',
        ]);

        PageLanguage::create([
            'page_id'       => $page->id,
            'lang'          => 'en',
            'title'         => $page->title,
            'content'       => $page->content,
            'meta_title'    => $page->meta_title,
            'meta_keywords' => $page->meta_keywords,
        ]);

        $page = Page::create([
            'id'         => 101,
            'title'      => 'Terms And Conditions',
            'content'    => 'These terms and conditions outline the rules and regulations for the use of our Website. By accessing this website we assume you accept these terms and conditions.',
            'type'       => 'error_page_403',
            'link'       => '#',
            'meta_title' => 'Meta Title',
            'status'     => '1',
        ]);

        PageLanguage::create([
            'page_id'       => $page->id,
            'lang'          => 'en',
            'title'         => $page->title,
            'content'       => $page->content,
            'meta_title'    => $page->meta_title,
            'meta_keywords' => $page->meta_keywords,
        ]);

        $page = Page::create([
            'id'         => 102,
            'title'      => 'About Us',
            'content'    => 'We are a dedicated team of professionals providing top-tier educational content and resources to help you achieve your learning goals.',
            'type'       => 'error_page_500',
            'link'       => '#',
            'meta_title' => 'Meta Title',
            'status'     => '1',
        ]);

        PageLanguage::create([
            'page_id'       => $page->id,
            'lang'          => 'en',
            'title'         => $page->title,
            'content'       => $page->content,
            'meta_title'    => $page->meta_title,
            'meta_keywords' => $page->meta_keywords,
        ]);

        $page = Page::create([
            'id'         => 103,
            'title'      => 'Help And Support',
            'content'    => 'If you have any questions or need assistance, our support team is available 24/7 to help you resolve any issues you might encounter.',
            'type'       => 'error_page_500',
            'link'       => '#',
            'meta_title' => 'Meta Title',
            'status'     => '1',
        ]);

        PageLanguage::create([
            'page_id'       => $page->id,
            'lang'          => 'en',
            'title'         => $page->title,
            'content'       => $page->content,
            'meta_title'    => $page->meta_title,
            'meta_keywords' => $page->meta_keywords,
        ]);

    }
}
