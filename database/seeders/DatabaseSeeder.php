<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Destination;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Trip;
use App\Models\TripItinerary;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Seeder User Admin
        User::updateOrCreate(
            ['email' => 'admin@wisatabudayalombok.id'],
            [
                'name' => 'Admin Wisata Budaya Lombok',
                'password' => bcrypt('password'),
                'role' => 'admin',
                'email_verified_at' => now(),
            ]
        );

        // Seeder Kategori Destinasi
        $categories = [
            ['name' => 'Rumah Adat', 'description' => 'Rumah tradisional Suku Sasak dengan arsitektur khas.'],
            ['name' => 'Situs Sejarah', 'description' => 'Makam dan peninggalan bersejarah kerajaan Lombok.'],
            ['name' => 'Desa Wisata', 'description' => 'Desa yang masih mempertahankan tradisi dan kesenian lokal.'],
            ['name' => 'Kerajinan Tradisional', 'description' => 'Sentra kerajinan tenun, gerabah, dan anyaman khas Lombok.'],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(
                ['slug' => Str::slug($category['name'])],
                ['name' => $category['name'], 'description' => $category['description']]
            );
        }

        // Seeder Destinasi Wisata
        $destinations = [
            [
                'category' => 'Desa Wisata',
                'name' => 'Desa Adat Sade',
                'description' => 'Desa Sade adalah perkampungan Suku Sasak yang mempertahankan bentuk rumah adat beratap alang-alang dan lantai dari campuran tanah liat serta kotoran kerbau.',
                'address' => 'Rembitan, Pujut, Lombok Tengah, NTB',
                'latitude' => -8.8845,
                'longitude' => 116.2799,
                'is_featured' => true,
            ],
            [
                'category' => 'Desa Wisata',
                'name' => 'Desa Adat Bayan',
                'description' => 'Bayan dikenal sebagai desa tertua di Lombok dan pusat penyebaran ajaran Islam Wetu Telu.',
                'address' => 'Bayan, Lombok Utara, NTB',
                'latitude' => -8.2333,
                'longitude' => 116.3667,
                'is_featured' => true,
            ],
            [
                'category' => 'Situs Sejarah',
                'name' => 'Makam Selaparang',
                'description' => 'Kompleks makam raja-raja Kerajaan Selaparang, kerajaan Islam tertua di Lombok.',
                'address' => 'Selaparang, Lombok Timur, NTB',
                'latitude' => -8.5722,
                'longitude' => 116.5083,
                'is_featured' => false,
            ],
            [
                'category' => 'Rumah Adat',
                'name' => 'Rumah Adat Segenter',
                'description' => 'Kampung tradisional dengan tata letak rumah yang tersusun rapi menghadap arah yang sama.',
                'address' => 'Segenter, Lombok Utara, NTB',
                'latitude' => -8.3167,
                'longitude' => 116.2,
                'is_featured' => true,
            ],
            [
                'category' => 'Kerajinan Tradisional',
                'name' => 'Sentra Tenun Sukarara',
                'description' => 'Desa penghasil kain tenun songket khas Lombok tempat menyaksikan langsung proses menenun.',
                'address' => 'Sukarara, Jonggat, Lombok Tengah, NTB',
                'latitude' => -8.7167,
                'longitude' => 116.2667,
                'is_featured' => false,
            ],
        ];

        foreach ($destinations as $item) {
            Destination::updateOrCreate(
                ['slug' => Str::slug($item['name'])],
                [
                    'category_id' => Category::where('name', $item['category'])->first()->id,
                    'name' => $item['name'],
                    'description' => $item['description'],
                    'address' => $item['address'],
                    'latitude' => $item['latitude'],
                    'longitude' => $item['longitude'],
                    'is_featured' => $item['is_featured'],
                ]
            );
        }

        // Seeder Paket Trip
        $trip = Trip::updateOrCreate(
            ['slug' => 'jelajah-budaya-sasak-2-hari'],
            [
                'name' => 'Jelajah Budaya Sasak 2 Hari',
                'description' => 'Paket 2 hari 1 malam menjelajahi desa adat, situs sejarah, dan sentra kerajinan khas Suku Sasak.',
                'price' => 850000,
                'duration_days' => 2,
                'duration_nights' => 1,
                'is_active' => true,
            ]
        );

        $trip->itineraries()->delete();

        $itineraryPlan = [
            ['title' => 'Kunjungan ke Desa Adat Sade', 'destination' => 'Desa Adat Sade'],
            ['title' => 'Belajar menenun di Sukarara', 'destination' => 'Sentra Tenun Sukarara'],
            ['title' => 'Ziarah dan wisata sejarah di Makam Selaparang', 'destination' => 'Makam Selaparang'],
        ];

        foreach ($itineraryPlan as $index => $plan) {
            TripItinerary::create([
                'trip_id' => $trip->id,
                'day_number' => $index + 1,
                'title' => $plan['title'],
                'destination_id' => Destination::where('name', $plan['destination'])->first()?->id,
            ]);
        }

        // --- TAMBAHAN BARU: Seeder Kategori Produk & Produk ---
        $productCategories = [
            ['name' => 'Minyak & Jamu Tradisional', 'description' => 'Minyak gosok dan ramuan herbal warisan leluhur Sasak.'],
            ['name' => 'Kerajinan & Cinderamata', 'description' => 'Produk kerajinan tangan, tenun, dan oleh-oleh khas Lombok.'],
        ];

        foreach ($productCategories as $cat) {
            ProductCategory::updateOrCreate(
                ['slug' => Str::slug($cat['name'])],
                ['name' => $cat['name'], 'description' => $cat['description']]
            );
        }

        $products = [
            [
                'category' => 'Minyak & Jamu Tradisional',
                'name' => 'Minyak Gosok Tradisional Sasak',
                'description' => 'Minyak herbal tradisional yang diracik dari rempah-rempah pilihan khas Lombok untuk meredakan pegal linu.',
                'price' => 45000,
                'is_featured' => true,
                'is_active' => true,
            ],
            [
                'category' => 'Kerajinan & Cinderamata',
                'name' => 'Kain Tenun Sasak Motif Lumbung',
                'description' => 'Kain tenun tangan asli buatan perajin lokal Sukarara dengan motif lumbung padi khas Lombok.',
                'price' => 250000,
                'is_featured' => true,
                'is_active' => true,
            ],
            [
                'category' => 'Kerajinan & Cinderamata',
                'name' => 'Souvenir Gerabah Hias',
                'description' => 'Kerajinan tanah liat hiasan meja dengan bentuk unik khas sentra gerabah Banyumulek.',
                'price' => 75000,
                'is_featured' => false,
                'is_active' => true,
            ],
        ];

        foreach ($products as $item) {
            $prodCategory = ProductCategory::where('name', $item['category'])->first();
            Product::updateOrCreate(
                ['slug' => Str::slug($item['name'])],
                [
                    'product_category_id' => $prodCategory?->id,
                    'name' => $item['name'],
                    'description' => $item['description'],
                    'price' => $item['price'],
                    'is_featured' => $item['is_featured'],
                    'is_active' => $item['is_active'],
                ]
            );
        }
    }
}