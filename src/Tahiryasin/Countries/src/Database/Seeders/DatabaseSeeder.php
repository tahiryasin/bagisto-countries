<?php

namespace Webkul\Admin\Database\Seeders;

use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CountryTranslationTableSeeder::class);
        $this->call(CountryStateTranslationTableSeeder::class);
    }
}
