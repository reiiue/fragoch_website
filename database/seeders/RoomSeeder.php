<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Room;
use App\Models\RoomImage;

class RoomSeeder extends Seeder
{
    public function run()
    {
        $rooms = [
            [
                'room_number' => 101,
                'room_type' => 'Standard Room',
                'capacity' => 2,
                'base_price' => 150,
                'description' => 'Perfect for solo travelers and couples, our Standard Rooms offer comfort and convenience with stunning city views.',
                'features' => json_encode([
                    ['title'=>'Capacity','value'=>'2 guests','icon'=>'bi-people-fill'],
                    ['title'=>'Room Size','value'=>'25 square meters','icon'=>'bi-rulers'],
                    ['title'=>'Bed Type','value'=>'King-size bed','icon'=>'bi-house'],
                    ['title'=>'Bathroom','value'=>'Private en-suite','icon'=>'bi-door-closed']
                ]),
                'amenities' => json_encode([
                    ['icon'=>'bi-window','name'=>'King-size bed','description'=>'Comfortable king-size bed with premium linens'],
                    ['icon'=>'bi-wind','name'=>'Air conditioning','description'=>'Climate control for year-round comfort'],
                    ['icon'=>'bi-tv','name'=>'LED Smart TV','description'=>'42-inch Smart TV with streaming services'],
                    ['icon'=>'bi-wifi','name'=>'High-speed WiFi','description'=>'Complimentary high-speed internet access'],
                    ['icon'=>'bi-cup-straw','name'=>'Mini bar','description'=>'Stocked with beverages and snacks']
                ]),
            ],
            [
                'room_number' => 201,
                'room_type' => 'Deluxe Room',
                'capacity' => 4,
                'base_price' => 250,
                'description' => 'Experience ultimate comfort in our Deluxe Rooms featuring spacious layouts and premium amenities.',
                'features' => json_encode([
                    ['title'=>'Capacity','value'=>'4 guests','icon'=>'bi-people-fill'],
                    ['title'=>'Room Size','value'=>'35 square meters','icon'=>'bi-rulers'],
                    ['title'=>'Bed Type','value'=>'Twin king-size beds','icon'=>'bi-house'],
                    ['title'=>'Bathroom','value'=>'Premium en-suite','icon'=>'bi-door-closed']
                ]),
                'amenities' => json_encode([
                    ['icon'=>'bi-window','name'=>'Twin king-size beds','description'=>'Two comfortable king-size beds'],
                    ['icon'=>'bi-chair','name'=>'Separate sitting area','description'=>'Spacious living room with seating'],
                    ['icon'=>'bi-tv','name'=>'Premium LED Smart TV','description'=>'55-inch Smart TV with premium channels'],
                    ['icon'=>'bi-wifi','name'=>'High-speed WiFi','description'=>'Unlimited high-speed internet'],
                    ['icon'=>'bi-cup-straw','name'=>'Full bar','description'=>'Fully stocked minibar and beverages']
                ]),
            ],
            [
                'room_number' => 301,
                'room_type' => 'Executive Suite',
                'capacity' => 6,
                'base_price' => 450,
                'description' => 'The Executive Suite offers unparalleled luxury with a separate bedroom, living room, and exclusive amenities.',
                'features' => json_encode([
                    ['title'=>'Capacity','value'=>'6 guests','icon'=>'bi-people-fill'],
                    ['title'=>'Room Size','value'=>'55 square meters','icon'=>'bi-rulers'],
                    ['title'=>'Bedrooms','value'=>'1 Master + 1 Guest','icon'=>'bi-house'],
                    ['title'=>'Bathrooms','value'=>'2 Premium bathrooms','icon'=>'bi-door-closed']
                ]),
                'amenities' => json_encode([
                    ['icon'=>'bi-window','name'=>'Master bedroom with king bed','description'=>'Luxurious master suite'],
                    ['icon'=>'bi-house','name'=>'Spacious living room','description'=>'Large living and entertaining area'],
                    ['icon'=>'bi-cup-straw','name'=>'Dining area','description'=>'Formal dining space with seating'],
                    ['icon'=>'bi-fire','name'=>'Full kitchen','description'=>'Fully equipped kitchen facilities'],
                    ['icon'=>'bi-spa','name'=>'Sauna and spa tub','description'=>'Private spa amenities']
                ]),
            ]
        ];

        foreach ($rooms as $roomData) {
            $room = Room::create($roomData);

            // Add sample images for each room
            for ($i = 1; $i <= 3; $i++) {
                RoomImage::create([
                    'room_id' => $room->id,
                    'image_url' => "rooms/{$room->room_type}_{$i}.jpg", // replace with actual images later
                    'alt_text' => "{$room->room_type} Image {$i}"
                ]);
            }
        }
    }
}
