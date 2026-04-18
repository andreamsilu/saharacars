<?php

namespace Database\Seeders;

use App\Models\Inquiry;
use Illuminate\Database\Seeder;

class InquirySeeder extends Seeder
{
    /**
     * Seed sample contact inquiries.
     */
    public function run(): void
    {
        $inquiries = [
            [
                'full_name' => 'Amina Suleiman',
                'email' => 'amina@example.com',
                'subject' => 'Request test drive',
                'message' => 'I would like to schedule a test drive for the Toyota Land Cruiser this weekend.',
                'ip_address' => '102.45.12.10',
                'user_agent' => 'Mozilla/5.0',
                'read_at' => null,
            ],
            [
                'full_name' => 'Joseph Mwita',
                'email' => 'joseph@example.com',
                'subject' => 'Financing options',
                'message' => 'Do you provide financing support for premium SUV purchases?',
                'ip_address' => '102.77.18.61',
                'user_agent' => 'Mozilla/5.0',
                'read_at' => now()->subDay(),
            ],
            [
                'full_name' => 'Neema Mushi',
                'email' => 'neema@example.com',
                'subject' => 'Availability in Arusha',
                'message' => 'Is the Porsche listing currently available in Arusha?',
                'ip_address' => '41.221.12.33',
                'user_agent' => 'Mozilla/5.0',
                'read_at' => null,
            ],
        ];

        foreach ($inquiries as $row) {
            Inquiry::updateOrCreate(
                ['email' => $row['email'], 'subject' => $row['subject']],
                $row
            );
        }

        // Add larger synthetic volume only for non-production data environments.
        if (app()->environment(['local', 'staging', 'testing'])) {
            $target = 150;
            $missing = max(0, $target - Inquiry::query()->count());
            if ($missing > 0) {
                Inquiry::factory($missing)->create();
            }
        }
    }
}
