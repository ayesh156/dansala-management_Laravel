<?php

namespace Database\Seeders;

use App\Models\Item;
use App\Models\Pledge;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ── 1. Truncate all tables (disable FK checks first) ──────────
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Pledge::truncate();
        Item::truncate();
        User::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // ── 2. Admin user ─────────────────────────────────────────────
        User::create([
            'name'     => 'Admin',
            'email'    => 'admin@gmail.com',
            'password' => Hash::make('admin123'),
        ]);

        // ── 3. Official items ─────────────────────────────────────────
        $items = [
            ['name' => 'සයිකල් සම්බා (පුන්‍ය සම්බා)',          'required_quantity' => 500,   'unit' => 'kg'],
            ['name' => 'ඉන්දියන් ජම්බො කඩල',                   'required_quantity' => 200,   'unit' => 'kg'],
            ['name' => 'කාගිල්ස් අයිස්ක්‍රීම් (ලීටර් 4 කෑන්)', 'required_quantity' => 80,    'unit' => 'cans'],
            ['name' => 'අයිස් කෝන්',                            'required_quantity' => 6000,  'unit' => 'numbers'],
            ['name' => 'කප් පරිප්පු',                           'required_quantity' => 75,    'unit' => 'kg'],
            ['name' => 'අර්තාපල් අල',                           'required_quantity' => 175,   'unit' => 'kg'],
            ['name' => 'බල මාළු',                               'required_quantity' => 150,   'unit' => 'kg'],
            ['name' => 'පොල් ගෙඩි',                             'required_quantity' => 350,   'unit' => 'numbers'],
            ['name' => 'විජය පපඩම්',                            'required_quantity' => 15,    'unit' => 'kg'],
            ['name' => 'තක්කාලි',                               'required_quantity' => 10,    'unit' => 'kg'],
            ['name' => 'දෙහි',                                  'required_quantity' => 4,     'unit' => 'kg'],
            ['name' => 'ඇඹුල් දොඩම් හෝ ජපන් දෙහි',            'required_quantity' => 200,   'unit' => 'numbers'],
            ['name' => 'අමු මිරිස්',                            'required_quantity' => 5,     'unit' => 'kg'],
            ['name' => 'අමු ඉගුරු',                             'required_quantity' => 2,     'unit' => 'kg'],
            ['name' => 'සුදු ලූනු',                             'required_quantity' => 4,     'unit' => 'kg'],
            ['name' => 'ලොකු ලූනු',                             'required_quantity' => 100,   'unit' => 'kg'],
            ['name' => 'එළවළු තෙල්',                           'required_quantity' => 20,    'unit' => 'L'],
            ['name' => 'උම්බලකඩ කුඩු',                         'required_quantity' => 4,     'unit' => 'kg'],
            ['name' => 'ලුණු කුඩු',                             'required_quantity' => 20,    'unit' => 'kg'],
            ['name' => 'ලුණු කැට',                              'required_quantity' => 20,    'unit' => 'kg'],
            ['name' => 'පත්තර',                                 'required_quantity' => 2,     'unit' => 'kg'],
            ['name' => 'ස්ටොක් පවුඩර්',                        'required_quantity' => 502,   'unit' => 'g'],
            ['name' => 'මස්කරි',                                'required_quantity' => 3,     'unit' => 'kg'],
            ['name' => 'කෑලි මිරිස්',                           'required_quantity' => 6.5,   'unit' => 'kg'],
            ['name' => 'මිරිස් කුඩු',                           'required_quantity' => 3,     'unit' => 'kg'],
            ['name' => 'ගම්මිරිස් කුඩු',                       'required_quantity' => 4,     'unit' => 'kg'],
            ['name' => 'කහ කුඩු',                               'required_quantity' => 500,   'unit' => 'g'],
            ['name' => 'තුනපහ කුඩු',                            'required_quantity' => 1,     'unit' => 'kg'],
            ['name' => 'අබ කුඩු',                               'required_quantity' => 250,   'unit' => 'g'],
            ['name' => 'කුරුදු පොතු',                           'required_quantity' => 500,   'unit' => 'g'],
            ['name' => 'උලුහාල් කුඩු',                         'required_quantity' => 200,   'unit' => 'g'],
            ['name' => 'ගොරක අතු',                              'required_quantity' => 1,     'unit' => 'kg'],
            ['name' => 'කූනිස්සෝ',                              'required_quantity' => 1,     'unit' => 'kg'],
            ['name' => 'කෝල්මන්ස් (කිලෝ 4 කෑන්)',              'required_quantity' => 5,     'unit' => 'cans'],
            ['name' => 'ගෑස් සිලින්ඩර',                        'required_quantity' => 6,     'unit' => 'cylinders'],
        ];

        foreach ($items as $item) {
            Item::create($item);
        }

        $this->command->info('✅ Database seeded successfully!');
        $this->command->info('   Items   : ' . Item::count());
        $this->command->info('   Users   : ' . User::count());
        $this->command->info('   Admin   : admin@gmail.com / admin123');
    }
}
