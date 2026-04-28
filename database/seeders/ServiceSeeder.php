<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Service;
use Illuminate\Support\Str;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

      $this->call(ServiceSeeder::class);
        Service::create([
            'title' => 'Web Development',
            'slug' => Str::slug('Web Development'),
            'short_description' => 'Jasa pembuatan website profesional',
            'description' => 'Kami menyediakan layanan pembuatan website dengan kualitas tinggi dan desain modern.',
            'is_active' => true,
        ]);

        Service::create([
            'title' => 'Mobile App Development',
            'slug' => Str::slug('Mobile App Development'),
            'short_description' => 'Jasa pembuatan aplikasi mobile',
            'description' => 'Kami mengembangkan aplikasi mobile Android & iOS sesuai kebutuhan bisnis Anda.',
            'is_active' => true,
        ]);
}
}