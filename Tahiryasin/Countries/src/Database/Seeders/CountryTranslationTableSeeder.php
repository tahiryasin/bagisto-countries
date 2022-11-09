<?php

namespace Tahiryasin\Countries\Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/*
 * Category table seeder.
 *
 * Command: php artisan db:seed --class=Webkul\\Category\\Database\\Seeders\\CategoryTableSeeder
 */
class CountryTranslationTableSeeder extends Seeder
{
    public function run()
    {
        // English Translations
        DB::statement('INSERT INTO country_translations (`locale`, `name`, `country_id`)
            SELECT "en", `name`, `id`
            FROM countries');
        DB::statement('INSERT INTO country_state_translations (`locale`, `default_name`, `country_state_id`)
            SELECT "en", `default_name`, `id`
            FROM country_states;');

        // Arabic Translations
        DB::statement('INSERT INTO country_translations (`locale`, `name`, `country_id`)
            SELECT "ar", `name`, `id`
            FROM countries');
        DB::statement('INSERT INTO country_state_translations (`locale`, `default_name`, `country_state_id`)
            SELECT "ar", `default_name`, `id`
            FROM country_states;');

    }
}
