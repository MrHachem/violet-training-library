<?php

namespace Database\Seeders;

use App\Models\Author;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $authors = [
            [
                'first_name' => 'ابن',
                'last_name' => 'خلدون',
                'birth_date' => '1332-05-27',
                'death_date' => '1406-03-17',
            ],
            [
                'first_name' => 'جمال',
                'last_name' => 'حمدان',
                'birth_date' => '1928-02-04',
                'death_date' => '1993-04-17',
            ],
            [
                'first_name' => 'طه',
                'last_name' => 'حسين',
                'birth_date' => '1889-11-15',
                'death_date' => '1973-10-28',
            ],
            [
                'first_name' => 'علي',
                'last_name' => 'الوردي',
                'birth_date' => '1913-10-22',
                'death_date' => '1995-07-13',
            ],
            [
                'first_name' => 'مجدي',
                'last_name' => 'يعقوب',
                'birth_date' => '1935-11-16',
                'death_date' => null,
            ],
            [
                'first_name' => 'يورغن',
                'last_name' => 'كلوب',
                'birth_date' => '1967-06-16',
                'death_date' => null,
            ],
            [
                'first_name' => 'بيل',
                'last_name' => 'برايسون',
                'birth_date' => '1951-12-08',
                'death_date' => null,
            ],
            [
                'first_name' => 'مايكل',
                'last_name' => 'بولان', 
                'birth_date' => '1955-02-06',
                'death_date' => null,
            ],
        ];

        Author::insert($authors);
    }
}
