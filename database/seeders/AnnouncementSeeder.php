<?php

namespace Database\Seeders;

use App\Models\Announcement;
use Illuminate\Database\Seeder;

class AnnouncementSeeder extends Seeder
{
    public function run(): void
    {
        $rows = [
            [
                'title' => 'Import order support: Japan, Germany & Thailand',
                'summary' => 'Tell us your model and budget—we quote landed cost and timelines for your region.',
                'link_url' => route('order.request', [], false),
                'link_new_tab' => false,
                'kind' => Announcement::KIND_OFFER,
                'is_published' => true,
                'sort_order' => 0,
            ],
            [
                'title' => 'This week: browse foreign-used under 100M TZS',
                'summary' => 'Curated shortlist of value stock—filter by condition and source country on inventory.',
                // Same filter keys as `CarController` and homepage quick links (`PageController`).
                'link_url' => route('cars.index', [
                    'condition' => 'foreign_used',
                    'price_max' => 100000000,
                ], false),
                'link_new_tab' => false,
                'kind' => Announcement::KIND_DISCOUNT,
                'is_published' => true,
                'sort_order' => 1,
            ],
            [
                'title' => 'Showroom visit by appointment in Dar es Salaam',
                'summary' => 'Message us on WhatsApp to book a viewing for cars marked In Tanzania or Ready for Booking.',
                'link_url' => route('contact', [], false),
                'link_new_tab' => false,
                'kind' => Announcement::KIND_NEWS,
                'is_published' => true,
                'sort_order' => 2,
            ],
        ];

        foreach ($rows as $row) {
            Announcement::query()->updateOrCreate(
                ['title' => $row['title']],
                $row
            );
        }
    }
}
