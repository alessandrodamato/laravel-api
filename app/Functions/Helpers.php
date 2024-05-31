<?php

namespace App\Functions;

use Illuminate\Support\Str;

class Helpers{

  public static function generateSlug($string, $model){

    $slug = Str::slug($string, '-');
    $original_slug = $slug;
    $c = 1;

    $exists = $model::where('slug', $slug)->first();

    while($exists){
        $slug = $original_slug . '-' . $c;
        $exists = $model::where('slug', $slug)->first();
        $c++;
    }

    return $slug;
  }

}
