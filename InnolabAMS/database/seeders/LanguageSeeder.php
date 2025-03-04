<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Language;

class LanguageSeeder extends Seeder
{
    public function run()
    {
        Language::create([
            'name' => 'English',
            'code' => 'en',
            'is_default' => true
        ]);

        Language::create([
            'name' => 'Filipino',
            'code' => 'fil',
            'is_default' => false
        ]);
    }
}
