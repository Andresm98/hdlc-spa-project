<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Book::create([
            'name'  => 'LIBRO 1',
            'description' => 'Descrip.',
        ]);
        Book::create([
            'name'  => 'LIBRO 2',
            'description' => 'Descrip.',
        ]);
        Book::create([
            'name'  => 'LIBRO A.5.6',
            'description' => 'Descrip.',
        ]);
        Book::create([
            'name'  => 'LIBRO A.5.8',
            'description' => 'Descrip.',
        ]);
        Book::create([
            'name'  => 'LIBRO DE SALIDAS',
            'description' => 'Descrip.',
        ]);
        Book::create([
            'name'  => 'LIBRO SR',
            'description' => 'Descrip.',
        ]);
        Book::create([
            'name'  => 'LIBRO SR A.5.1',
            'description' => 'Descrip.',
        ]);
        Book::create([
            'name'  => 'LIBRO SR A.5.2',
            'description' => 'Descrip.',
        ]);
        Book::create([
            'name'  => 'LIBRO SR A.5.3',
            'description' => 'Descrip.',
        ]);
        Book::create([
            'name'  => 'LIBRO SR A.5.4',
            'description' => 'Descrip.',
        ]);
    }
}
