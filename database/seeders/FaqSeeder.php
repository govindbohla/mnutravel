<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    public function run(): void
    {
        $faqs = [
            ['question' => 'How do I book a taxi with MNU Travels?', 'answer' => 'You can book a taxi directly from our website using the "Book Now" button, or call us on our contact number for immediate assistance.'],
            ['question' => 'Do you provide outstation taxi services?', 'answer' => 'Yes, we offer both one-way and round-trip outstation taxi services across major cities and destinations.'],
            ['question' => 'Are your drivers verified and experienced?', 'answer' => 'All our drivers are professionally trained, background-verified, and experienced in providing safe and comfortable rides.'],
            ['question' => 'Can I cancel or modify my booking?', 'answer' => 'Yes, you can contact our support team to cancel or modify your booking as per our terms and conditions.'],
            ['question' => 'What payment methods do you accept?', 'answer' => 'We accept cash payments directly to the driver. Please contact us for more details on available payment options.'],
        ];

        foreach ($faqs as $index => $faq) {
            Faq::query()->firstOrCreate(
                ['question' => $faq['question']],
                $faq + ['sort_order' => $index, 'status' => 'active']
            );
        }
    }
}
