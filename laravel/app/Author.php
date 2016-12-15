<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
  //becuase each user moght have many quotes
  public function quotes(){
    return $this->hasMany('App\Quote');
  }
}
