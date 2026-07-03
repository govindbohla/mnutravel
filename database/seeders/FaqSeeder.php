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
            ['question' => 'Do you offer one-day pilgrimage trips like Khatu Shyam or Salasar Balaji?', 'answer' => 'Yes, we run dedicated one-day pilgrimage packages to Khatu Shyam, Salasar Balaji, and Ajmer-Pushkar with comfortable AC vehicles.'],
            ['question' => 'Can I book a tempo traveller for a group trip?', 'answer' => 'Yes, we have 12-seater and 17-seater tempo travellers available for group outings, weddings, and family trips.'],
            ['question' => 'Is airport pickup available at odd hours?', 'answer' => 'Yes, our airport transfer service operates round the clock, including early morning and late night flights.'],
            ['question' => 'Do you provide a driver for self-drive trips?', 'answer' => 'No, all our vehicles come with a professional driver included - we do not offer self-drive rentals.'],
            ['question' => 'How far in advance should I book a tour package?', 'answer' => 'We recommend booking at least 2-3 days in advance for tour packages, especially during peak travel seasons.'],
            ['question' => 'Do you offer corporate account billing?', 'answer' => 'Yes, we offer corporate taxi arrangements with monthly billing for businesses. Please contact us to set this up.'],
            ['question' => 'What areas do you cover for local taxi service?', 'answer' => 'Our local taxi service covers the entire city and nearby areas, available on an hourly or full-day rental basis.'],
            ['question' => 'Are decorated cars available for weddings?', 'answer' => 'Yes, our wedding car rental service includes tastefully decorated vehicles for the big day.'],
            ['question' => 'Can I request a specific vehicle type for my booking?', 'answer' => 'Yes, you can select your preferred vehicle type (Sedan, SUV, Luxury, or Tempo Traveller) while booking.'],
            ['question' => 'Do you provide railway station pickup and drop?', 'answer' => 'Yes, we offer timely railway station pickup and drop services with live train tracking where possible.'],
        ];

        foreach ($faqs as $index => $faq) {
            Faq::query()->firstOrCreate(
                ['question' => $faq['question']],
                $faq + ['sort_order' => $index, 'status' => 'active']
            );
        }
    }
}
