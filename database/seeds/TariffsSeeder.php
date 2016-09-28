<?php

use Illuminate\Database\Seeder;
use App\Tariff;

class TariffsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tariff::create([
            'id' => 1,
            'name' => 'Lite',
            'price' => 9,
            'days' => 30,
            'public' => 1,
            'mql_cme_oi_levels' => 1,
            'mql_cme_day_border' => 1,
            'mql_cme_first_levels' => 0,
            'mql_cme_second_levels' => 0,
            'mql_cme_cvs' => 0,
            'mql_cme_helper' => 0,
            'mql_day_history' => 92,
            'mql_history_option' => 1,
            'cp_level_graphics' => 0,
            'cp_filter' => 0,
            'cp_second_level' => 0,
            'cp_comment' => 0,
            'cp_history_option' => 0,
            'created_at' => time(),
            'updated_at' => time()
        ]);

        Tariff::create([
            'id' => 2,
            'name' => 'Professional',
            'price' => 17,
            'days' => 30,
            'public' => 1,
            'mql_cme_oi_levels' => 1,
            'mql_cme_day_border' => 1,
            'mql_cme_first_levels' => 1,
            'mql_cme_second_levels' => 1,
            'mql_cme_cvs' => 1,
            'mql_cme_helper' => 0,
            'mql_day_history' => 365,
            'mql_history_option' => 3,
            'cp_level_graphics' => 1,
            'cp_filter' => 1,
            'cp_second_level' => 0,
            'cp_comment' => 0,
            'cp_history_option' => 0,
            'created_at' => time(),
            'updated_at' => time()
        ]);

        Tariff::create([
            'id' => 3,
            'name' => 'VIP',
            'price' => 29,
            'days' => 30,
            'public' => 1,
            'mql_cme_oi_levels' => 1,
            'mql_cme_day_border' => 1,
            'mql_cme_first_levels' => 1,
            'mql_cme_second_levels' => 1,
            'mql_cme_cvs' => 1,
            'mql_cme_helper' => 1,
            'mql_day_history' => 0,
            'mql_history_option' => 0,
            'cp_level_graphics' => 1,
            'cp_filter' => 1,
            'cp_second_level' => 1,
            'cp_comment' => 1,
            'cp_history_option' => 0,
            'created_at' => time(),
            'updated_at' => time()
        ]);

        Tariff::create([
            'id' => 4,
            'name' => 'Lite',
            'price' => 23,
            'days' => 90,
            'public' => 1,
            'mql_cme_oi_levels' => 1,
            'mql_cme_day_border' => 1,
            'mql_cme_first_levels' => 0,
            'mql_cme_second_levels' => 0,
            'mql_cme_cvs' => 0,
            'mql_cme_helper' => 0,
            'mql_day_history' => 92,
            'mql_history_option' => 1,
            'cp_level_graphics' => 0,
            'cp_filter' => 0,
            'cp_second_level' => 0,
            'cp_comment' => 0,
            'cp_history_option' => 0,
            'created_at' => time(),
            'updated_at' => time()
        ]);

        Tariff::create([
            'id' => 5,
            'name' => 'Professional',
            'price' => 43,
            'days' => 90,
            'public' => 1,
            'mql_cme_oi_levels' => 1,
            'mql_cme_day_border' => 1,
            'mql_cme_first_levels' => 1,
            'mql_cme_second_levels' => 1,
            'mql_cme_cvs' => 1,
            'mql_cme_helper' => 0,
            'mql_day_history' => 365,
            'mql_history_option' => 3,
            'cp_level_graphics' => 1,
            'cp_filter' => 1,
            'cp_second_level' => 0,
            'cp_comment' => 0,
            'cp_history_option' => 0,
            'created_at' => time(),
            'updated_at' => time()
        ]);

        Tariff::create([
            'id' => 6,
            'name' => 'VIP',
            'price' => 73,
            'days' => 90,
            'public' => 1,
            'mql_cme_oi_levels' => 1,
            'mql_cme_day_border' => 1,
            'mql_cme_first_levels' => 1,
            'mql_cme_second_levels' => 1,
            'mql_cme_cvs' => 1,
            'mql_cme_helper' => 1,
            'mql_day_history' => 0,
            'mql_history_option' => 0,
            'cp_level_graphics' => 1,
            'cp_filter' => 1,
            'cp_second_level' => 1,
            'cp_comment' => 1,
            'cp_history_option' => 0,
            'created_at' => time(),
            'updated_at' => time()
        ]);

        Tariff::create([
            'id' => 7,
            'name' => 'Lite',
            'price' => 49,
            'days' => 365,
            'public' => 1,
            'mql_cme_oi_levels' => 1,
            'mql_cme_day_border' => 1,
            'mql_cme_first_levels' => 0,
            'mql_cme_second_levels' => 0,
            'mql_cme_cvs' => 0,
            'mql_cme_helper' => 0,
            'mql_day_history' => 92,
            'mql_history_option' => 1,
            'cp_level_graphics' => 0,
            'cp_filter' => 0,
            'cp_second_level' => 0,
            'cp_comment' => 0,
            'cp_history_option' => 0,
            'created_at' => time(),
            'updated_at' => time()
        ]);

        Tariff::create([
            'id' => 8,
            'name' => 'Professional',
            'price' => 97,
            'days' => 365,
            'public' => 1,
            'mql_cme_oi_levels' => 1,
            'mql_cme_day_border' => 1,
            'mql_cme_first_levels' => 1,
            'mql_cme_second_levels' => 1,
            'mql_cme_cvs' => 1,
            'mql_cme_helper' => 0,
            'mql_day_history' => 365,
            'mql_history_option' => 3,
            'cp_level_graphics' => 1,
            'cp_filter' => 1,
            'cp_second_level' => 0,
            'cp_comment' => 0,
            'cp_history_option' => 0,
            'created_at' => time(),
            'updated_at' => time()
        ]);

        Tariff::create([
            'id' => 9,
            'name' => 'VIP',
            'price' => 179,
            'days' => 365,
            'public' => 1,
            'mql_cme_oi_levels' => 1,
            'mql_cme_day_border' => 1,
            'mql_cme_first_levels' => 1,
            'mql_cme_second_levels' => 1,
            'mql_cme_cvs' => 1,
            'mql_cme_helper' => 1,
            'mql_day_history' => 0,
            'mql_history_option' => 0,
            'cp_level_graphics' => 1,
            'cp_filter' => 1,
            'cp_second_level' => 1,
            'cp_comment' => 1,
            'cp_history_option' => 0,
            'created_at' => time(),
            'updated_at' => time()
        ]);
    }
}
