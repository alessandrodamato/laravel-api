<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Functions\Helpers;
use App\Models\Technology;

class TechnologiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      $technologies = ['HTML', 'CSS', 'SCSS', 'JS', 'VueJS', 'PHP', 'MySQL', 'Laravel', 'Bootstrap', 'phpMyAdmin'];

      foreach($technologies as $technology){
        $new_item = new Technology();
        $new_item->name = $technology;
        $new_item->slug = Helpers::generateSlug($new_item->name, new Technology());
        $new_item->save();
      }
    }
}
